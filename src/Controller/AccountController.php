<?php

namespace App\Controller;

use App\Entity\Informations;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $nbrInfos = $em->getRepository(Informations::class)->findAll();
        $infos = $em->getRepository('App\Entity\Informations')->findBy([], ['date_public' => 'DESC'], 3);

        $nextStage = $em->getRepository('App\Entity\Stage')->getNextStage();

        return $this->render('account/index.html.twig', [
            'nbrInfos' => count($nbrInfos),
            'infos' => $infos,
            'stage' => $nextStage
        ]);
    }
}
