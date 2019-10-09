<?php

namespace App\Controller;

use App\Entity\Annulation;
use App\Entity\CategoryInfo;
use App\Entity\Cours;
use App\Entity\Evenement;
use App\Entity\Groupe;
use App\Entity\Informations;
use App\Entity\Stage;
use App\Entity\TypeEnv;
use App\Entity\User;
use App\Form\AddAnnulationType;
use App\Form\AddCategoryInfoType;
use App\Form\AddCoursType;
use App\Form\AddEvenementType;
use App\Form\AddGroupeType;
use App\Form\AddInformationType;
use App\Form\AddStageType;
use App\Form\AddTypeEnvType;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AdministrationController extends AbstractController
{
    public function index()
    {
        return $this->render('administration/index.html.twig');
    }

    public function adherent()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findAll();

        return $this->render('administration/adherent.html.twig', [
            'users' => $users
        ]);
    }

    public function toggleAdherent($adh)
    {
        $em = $this->getDoctrine()->getManager();
        $adh = $em->getRepository(User::class)->findOneBy(['email' => $adh]);

        if (null != $adh) {

            $adh->setAdherent(!($adh->getAdherent()));
            $em->persist($adh);
            $em->flush();

            return new JsonResponse('OK');
        }

        return new JsonResponse('NOK');
    }

    public function informations(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $category = new CategoryInfo();
        $formAddCategory = $this->createForm(AddCategoryInfoType::class, $category);
        $formAddCategory->handleRequest($request);

        $information = new Informations();
        $formAddInfo = $this->createForm(AddInformationType::class, $information);
        $formAddInfo->handleRequest($request);

        if ($formAddCategory->isSubmitted() && $formAddCategory->isValid()) {
            $em->persist($category);
            $em->flush();
            $category = new CategoryInfo();
            $formAddCategory = $this->createForm(AddCategoryInfoType::class, $category);
        }

        if ($formAddInfo->isSubmitted() && $formAddInfo->isValid()) {
            $em->persist($information);
            $em->flush();
            $information = new Informations();
            $formAddInfo = $this->createForm(AddInformationType::class, $information);
        }

        $listCategory = $em->getRepository('App\Entity\CategoryInfo')->findAll();
        $listInfo = $em->getRepository('App\Entity\Informations')->findAll();

        return $this->render('administration/informations.html.twig', [
            'listCategory' => $listCategory,
            'listInfo' => $listInfo,
            'formAddCategory' => $formAddCategory->createView(),
            'formAddInfo' => $formAddInfo->createView()
        ]);
    }

    public function deleteCategoryInfo($cat) {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('App\Entity\CategoryInfo')->findOneBy(['id' => $cat]);

        $em->remove($cat);
        $em->flush();

        return $this->redirectToRoute('administration_informations');
    }

    public function deleteInfo($info) {
        $em = $this->getDoctrine()->getManager();
        $info = $em->getRepository('App\Entity\Informations')->findOneBy(['id' => $info]);

        $em->remove($info);
        $em->flush();

        return $this->redirectToRoute('administration_informations');
    }

    public function stage(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $stage = new Stage();
        $form = $this->createForm(AddStageType::class, $stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($stage);
            $em->flush();

            $stage = new Stage();
            $form = $this->createForm(AddStageType::class, $stage);
        }

        $stages = $em->getRepository('App\Entity\Stage')->findAll();

        return $this->render('administration/stage.html.twig', [
            'form' => $form->createView(),
            'stages' => $stages
        ]);
    }

    public function deleteStage($stage) {
        $em = $this->getDoctrine()->getManager();
        $stage = $em->getRepository('App\Entity\Stage')->findOneBy(['id' => $stage]);

        $em->remove($stage);
        $em->flush();

        return $this->redirectToRoute('administration_stage');
    }

    public function cours(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $cour = new Cours();
        $formAddCours = $this->createForm(AddCoursType::class, $cour);
        $formAddCours->handleRequest($request);

        $groupe = new Groupe();
        $formAddGroupe = $this->createForm(AddGroupeType::class, $groupe);
        $formAddGroupe->handleRequest($request);

        $annulation = new Annulation();
        $formAddAnnulation = $this->createForm(AddAnnulationType::class, $annulation);
        $formAddAnnulation->handleRequest($request);

        if ($formAddCours->isSubmitted() && $formAddCours->isValid()) {
            $em->persist($cour);
            $em->flush();

            $cour = new Cours();
            $formAddCours = $this->createForm(AddCoursType::class, $cour);
        }

        if ($formAddGroupe->isSubmitted() && $formAddGroupe->isValid()) {
            $em->persist($groupe);
            $em->flush();

            $groupe = new Groupe();
            $formAddGroupe = $this->createForm(AddGroupeType::class, $groupe);
        }

        if ($formAddAnnulation->isSubmitted() && $formAddAnnulation->isValid()) {
            $em->persist($annulation);
            $em->flush();

            $annulation = new Annulation();
            $formAddAnnulation = $this->createForm(AddAnnulationType::class, $annulation);
        }

        $cours = $em->getRepository('App\Entity\Cours')->findAll();
        $groupes = $em->getRepository('App\Entity\Groupe')->findAll();
        $annulations = $em->getRepository('App\Entity\Annulation')->findAll();

        return $this->render('administration/cours.html.twig', [
            'formAddCours' => $formAddCours->createView(),
            'formAddGroupe' => $formAddGroupe->createView(),
            'formAddAnnulation' => $formAddAnnulation->createView(),
            'cours' => $cours,
            'groupes' => $groupes,
            'annulations' => $annulations
        ]);
    }

    public function deleteGroupe($groupe) {
        $em = $this->getDoctrine()->getManager();
        $groupe = $em->getRepository('App\Entity\Groupe')->findOneBy(['id' => $groupe]);

        $em->remove($groupe);
        $em->flush();

        return $this->redirectToRoute('administration_cours');
    }

    public function deleteCours($cours) {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository('App\Entity\Cours')->findOneBy(['id' => $cours]);

        $em->remove($cours);
        $em->flush();

        return $this->redirectToRoute('administration_cours');
    }

    public function deleteAnnulation($annulation) {
        $em = $this->getDoctrine()->getManager();
        $annulation = $em->getRepository('App\Entity\Annulation')->findOneBy(['id' => $annulation]);

        $em->remove($annulation);
        $em->flush();

        return $this->redirectToRoute('administration_cours');
    }

    public function evenement(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $typeEnv = new TypeEnv();
        $formAddTypeEnv = $this->createForm(AddTypeEnvType::class, $typeEnv);
        $formAddTypeEnv->handleRequest($request);

        $evenement = new Evenement();
        $formAddEvenement = $this->createForm(AddEvenementType::class, $evenement);
        $formAddEvenement->handleRequest($request);

        if ($formAddTypeEnv->isSubmitted() && $formAddTypeEnv->isValid()) {
            $em->persist($typeEnv);
            $em->flush();

            $typeEnv = new TypeEnv();
            $formAddTypeEnv = $this->createForm(AddTypeEnvType::class, $typeEnv);
        }

        if ($formAddEvenement->isSubmitted() && $formAddEvenement->isValid()) {
            $em->persist($evenement);
            $em->flush();

            $evenement = new Evenement();
            $formAddEvenement = $this->createForm(AddEvenementType::class, $evenement);
        }

        $typeEnvs = $em->getRepository('App\Entity\TypeEnv')->findAll();
        $evenements = $em->getRepository('App\Entity\Evenement')->findAll();

        return $this->render('administration/evenement.html.twig', [
            'formAddTypeEnv' => $formAddTypeEnv->createView(),
            'formAddEvenement' => $formAddEvenement->createView(),
            'evenements' => $evenements,
            'typeEnvs' => $typeEnvs
        ]);
    }

    public function deleteEvenement($env) {
        $em = $this->getDoctrine()->getManager();
        $env = $em->getRepository('App\Entity\Evenement')->findOneBy(['id' => $env]);

        $em->remove($env);
        $em->flush();

        return $this->redirectToRoute('administration_evenement');
    }

    public function deleteTypeEnv($type) {
        $em = $this->getDoctrine()->getManager();
        $type = $em->getRepository('App\Entity\TypeEnv')->findOneBy(['id' => $type]);

        $em->remove($type);
        $em->flush();

        return $this->redirectToRoute('administration_evenement');
    }
}
