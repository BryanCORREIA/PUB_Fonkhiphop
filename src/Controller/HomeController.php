<?php

namespace App\Controller;

use App\Entity\Annulation;
use App\Form\DiscoverType;
use App\Form\FormContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    public function index(Request $request)
    {
        $formDiscover = $this->createForm(DiscoverType::class);
        $formDiscover->handleRequest($request);

        $formContact = $this->createForm(FormContactType::class);
        $formContact->handleRequest($request);

        return $this->render('home/index.html.twig', [
            'formDiscover' => $formDiscover->createView(),
            'formContact' => $formContact->createView()
        ]);
    }

    public function calendrier($month, $year)
    {
        $em = $this->getDoctrine()->getManager();

        $firstDay = strtotime($year. "-" .$month. "-" . "01");
        $nbrJours = date('t', $firstDay);
        $lastDay = strtotime($year. "-" .$month. "-" . $nbrJours);

        $weekFirst = date('W', $firstDay);
        $weekLast = date('W', $lastDay);

        $numfirstDay = date('N', $firstDay);
        $numberLines = $weekLast - $weekFirst + 1;

        $month_alt = date('n', $firstDay) - 1;
        $prevMonth = $month - 1;
        $nextMonth = $month + 1;
        $prevYear = $year;
        $nextYear = $year;

        if ($prevMonth == 0) {
            $prevMonth = 12;
            $prevYear = $year -1;
        }

        if ($nextMonth == 13) {
            $nextMonth = 01;
            $nextYear = $year +1;
        }

        $dateNow = date("d-m-Y");

        $cours = $em->getRepository('App\Entity\Cours')->findAll();
        $events = $em->getRepository('App\Entity\Evenement')->findAllEventsInMonth($month, $year);
        $annulations = $em->getRepository('App\Entity\Annulation')->findAllAnnulsInMonth($month, $year);
        $stages = $em->getRepository('App\Entity\Stage')->findAllStageInMonth($month, $year, false);

        return $this->render('home/calendrier.html.twig', [
            'jours' => $nbrJours,
            'lines' => $numberLines,
            'first' => $numfirstDay,
            'month' => $month,
            'month_alt' => $month_alt,
            'year' => $year,
            'prevMonth' => $prevMonth,
            'nextMonth' => $nextMonth,
            'prevYear' => $prevYear,
            'nextYear' => $nextYear,
            'now' => $dateNow,
            'cours' => $cours,
            'events' => $events,
            'annulations' => $annulations,
            'stages' => $stages
        ]);
    }

    public function cours() {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository('App\Entity\Cours')->findAll();


        return $this->render('home/cours.html.twig', [
            'cours' => $cours
        ]);
    }

    public function stages() {
        $em = $this->getDoctrine()->getManager();
        $stages = $em->getRepository('App\Entity\Stage')->findAll();

        return $this->render('home/stages.html.twig', [
            'stages' => $stages
        ]);
    }
}
