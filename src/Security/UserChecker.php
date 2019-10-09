<?php


namespace App\Security;

use App\Entity\User as AppUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker extends AbstractController implements UserCheckerInterface
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(
        UserPasswordEncoderInterface $encoder
    )
    {
        $this->encoder = $encoder;
    }

    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        $this->checkPassword($user);
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // Vérifie si le compte est bloqué
        if (!$user->getLocked()) {

            // Vérifie si le compte est validé
            if ($user->getValid()) {

                $user->resetAttempt();
                $user->setLastConnect(new \DateTime());

                $this->getDoctrine()->getManager()->persist($user);
                $this->getDoctrine()->getManager()->flush();

            } else {
                $user->generateProcessKey();

                $this->getDoctrine()->getManager()->persist($user);
                $this->getDoctrine()->getManager()->flush();

                $this->addFlash(
                    'failure',
                    'Compte non validé. <br> <a href="/activation/'. $user->getEmail() .'">Cliquez ici</a> pour recevoir un nouveau lien d\'activation.'
                );
                throw new AccountExpiredException();
            }
        } else {
            $this->addFlash(
                'failure',
                'Compte bloqué. <br> <a href="/deblocage/'. $user->getEmail() .'">Cliquez ici</a> pour débloquer votre compte.'
            );
            throw new AccountExpiredException();
        }
    }

    public function checkPassword(UserInterface $user) {
        if (!$user instanceof AppUser) {
            return;
        }

        if (!$this->encoder->isPasswordValid($user, $_POST['_password'])) {
            $user->addAttempt();

            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
        }
    }
}