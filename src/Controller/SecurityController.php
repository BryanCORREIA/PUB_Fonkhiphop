<?php

namespace App\Controller;

use App\Domain\mailAction;
use App\Entity\User;
use App\Form\RequestPasswordType;
use App\Form\ResetPasswordType;
use App\Form\SignupType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function login(AuthenticationUtils $authenticationUtils, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    public function signup(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(SignupType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uniqueMail = $this->getDoctrine()->getManager()->getRepository('App\Entity\User')->findOneBy(['email' => $form->getData()->getEmail()]);

            if (!is_null($uniqueMail)) {
                $this->addFlash(
                    'failure',
                    'L\'adresse e-mail saisie fait déjà partie de nos registres. Si vous possedez déjà un compte, une demande de réinitialisation de mot de passe est possible.'
                );

            } else {
                $password = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($password);

                $user->generateProcessKey();

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $action = mailAction::build(
                    'Création de votre compte',
                    $user->getEmail(),
                    'emails/new-account.html.twig',
                    $user
                );

                $this->sendMail($action);

                $this->addFlash(
                    'success',
                    'Votre compte à bien été créé, un e-mail de vérification a été envoyé à votre adresse e-mail. L\'envoie de cet e-mail peut prendre quelques minutes. '
                );
                return $this->redirectToRoute('security_login');
            }

        }

        return $this->render('security/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function requestPassword(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(RequestPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $em->getRepository('App\Entity\User')->findOneBy(['email' => $form->getData()['email']]);
            if (!is_null($user)) {
                try {
                    $user->generateProcessKey();
                } catch (\Exception $e) {
                }

                $em->persist($user);
                $em->flush();

                $action = mailAction::build(
                    'Réinitialisation de votre mot de passe',
                    $user->getEmail(),
                    'emails/request-password.html.twig',
                    $user
                );

                $this->sendMail($action);

                $this->addFlash(
                    'success',
                    'Votre demande de réinitialisation de mot de passe à bien été prise en compte. Un e-mail vous sera envoyé d\'ici quelques instants.'
                );

                return $this->redirectToRoute('security_login');
            } else {
                $this->addFlash(
                    'failure',
                    'L\'adresse e-mail saisi ne figure pas dans nos registres. Veuillez saisir une adresse e-mail d\'un compte éxistant.'
                );
            }
        }

        return $this->render('security/forgot-password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function resetPassword($processKey, Request $request, UserPasswordEncoderInterface $encoder) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App\Entity\User')->findOneBy(['processKey' => $processKey]);

        if (!is_null($user)) {
            if ($user->getDateExpirationKey() > new \DateTime()) {

                $form = $this->createForm(ResetPasswordType::class);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $password = $encoder->encodePassword($user, $form->getData()['password']);

                    $user->setPassword($password);
                    $user->setProcessKey(null);
                    $user->setLocked(false);
                    $user->resetAttempt();

                    $em->persist($user);
                    $em->flush();

                    $this->addFlash(
                        'success',
                        'Le changement de mot de passe à bien été éffectué, vous pouvez maintenant vous identifiez avec votre nouveau mot de passe.'
                    );

                    return $this->redirectToRoute('security_login');
                }

                return $this->render('security/reset-password.html.twig', [
                    'form' => $form->createView()
                ]);
            } else {
                $this->addFlash(
                    'failure',
                    'Le lien de réinitialisation de votre mot de passe à expiré. Afin de changer votre mot de passe, veuillez créer une nouvelle demande de réinitialisation.'
                );
            }
        } else {
            $this->addFlash(
                'failure',
                'Le lien de réinitialisation de votre mot de passe est incorrect. Afin de changer votre mot de passe, veuillez créer une nouvelle demande de réinitialisation.'
            );
        }

        return $this->redirectToRoute('security_login');
    }

    public function wantActivation($email) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App\Entity\User')->findOneBy(['email' => $email]);
        $user->generateProcessKey();

        $em->persist($user);
        $em->flush();

        $action = mailAction::build(
            'Activation de votre compte',
            $user->getEmail(),
            'emails/new-account.html.twig',
            $user
        );

        $this->sendMail($action);

        $this->addFlash(
            'success',
            'Le lien d\'activation de votre compte a été envoyé à votre adresse e-mail.'
        );

        return $this->redirectToRoute('security_login');
    }

    public function activation($processKey) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App\Entity\User')->findOneBy(['processKey' => $processKey]);

        if (!is_null($user)) {
            if ($user->getDateExpirationKey() > new \DateTime()) {
                $user->setValid(true);
                $user->setProcessKey(null);

                $em->persist($user);
                $em->flush();

                $this->addFlash(
                    'success',
                    'Votre compte est activé. Vous pouvez maintenant vous connecter ! <br> Bienvenue'
                );
            } else {
                $this->addFlash(
                    'failure',
                    'Le délai du lien d\'activation de votre compte est dépassé. Cliquez-ici pour recevoir un nouveau mail d\'activation'
                );
            }
        } else {
            $this->addFlash(
                'failure',
                'Le lien d\'activation de votre compte est incorrect. Cliquez-ici pour recevoir un nouveau mail d\'activation'
            );
        }
        return $this->redirectToRoute('security_login');
    }

    public function unlock($email) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App\Entity\User')->findOneBy(['email' => $email]);

        $user->generateProcessKey();

        $em->persist($user);
        $em->flush();

        $action = mailAction::build(
            'Déblocage de votre compte',
            $user->getEmail(),
            'emails/locked-account.html.twig',
            $user
        );

        $this->sendMail($action);

        $this->addFlash(
            'success',
            'Le lien de deblocage de votre compte a été envoyé à votre adresse e-mail.'
        );

        return $this->redirectToRoute('security_login');
    }

    public function confirmUnlock($processKey) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App\Entity\User')->findOneBy(['processKey' => $processKey]);

        if (!is_null($user)) {
            if ($user->getDateExpirationKey() > new \DateTime()) {

                $user->setLocked(false);
                $user->resetAttempt();
                $user->setProcessKey(null);

                $em->persist($user);
                $em->flush();

                $this->addFlash(
                    'success',
                    'Votre compte est débloqué. Vous pouvez maintenant vous connecter !'
                );
            } else {
                $this->addFlash(
                    'failure',
                    'Le délai du lien de déblocage de votre compte est dépassé. Cliquez-ici pour recevoir un nouveau mail de déblocage.'
                );
            }
        } else {
            $this->addFlash(
                'failure',
                'Le lien de déblocage de votre compte est incorrect. Cliquez-ici pour recevoir un nouveau mail de déblocage.'
            );
        }

        return $this->redirectToRoute('security_login');
    }

    public function sendMail(mailAction $action) {
        $message = (new \Swift_Message($action->subject))
            ->setFrom($action->from)
            ->setTo($action->to)
            ->setBody(
                $this->renderView(
                    $action->template,
                    ['title' => $action->subject, 'user' => $action->user]
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }
}
