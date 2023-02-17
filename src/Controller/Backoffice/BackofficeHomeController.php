<?php

namespace App\Controller\Backoffice;

use App\Repository\NoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BackofficeHomeController extends AbstractController
{
    #[Route('/backhome', name: 'app_backhome')]
    public function index(NoteRepository $noteRepository): Response
    {
        
        $notesPlaceReservation = $noteRepository->findBy(["place" => "reservation"],);
        $notesPlaceMain = $noteRepository->findBy(["place" => "main"],);
        $notesPlaceStart = $noteRepository->findBy(["place" => "start"],);
        $notesPlacePlat = $noteRepository->findBy(["place" => "plat"],);
        $notesPlaceDessert = $noteRepository->findBy(["place" => "dessert"],);
        $notesPlaceDrink = $noteRepository->findBy(["place" => "drink"],);
        $notesPlaceMenu = $noteRepository->findBy(["place" => "menu"],);
        $notesPlaceUser = $noteRepository->findBy(["place" => "user"],);
        $notesPlaceService = $noteRepository->findBy(["place" => "service"],);
        $notesPlaceNews = $noteRepository->findBy(["place" => "news"],);
        $notesPlaceMessage = $noteRepository->findBy(["place" => "message"],);
        return $this->render('backoffice/home/backhome.html.twig', [
             // liste des notes pour la place = resservation
            "notesReservation" => $notesPlaceReservation,
             // liste des notes pour la place = main
             "notesMain" => $notesPlaceMain,
             // liste des notes pour la place = start
             "notesStart" => $notesPlaceStart,
             // liste des notes pour la place = plat
             "notesPlat" => $notesPlacePlat,
             // liste des notes pour la place = dessert
             "notesDessert" => $notesPlaceDessert,
             // liste des notes pour la place = drink
             "notesDrink" => $notesPlaceDrink,
             // liste des notes pour la place = menu
             "notesMenu" => $notesPlaceMenu,
             // liste des notes pour la place = user
             "notesUser" => $notesPlaceUser,
             // liste des notes pour la place = service
             "notesService" => $notesPlaceService,
             // liste des notes pour la place = news
             "notesNews" => $notesPlaceNews,
             // liste des notes pour la place = news
             "notesMessage" => $notesPlaceMessage,
        ]);

    
        
    }

    
}

