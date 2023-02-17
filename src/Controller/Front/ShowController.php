<?php

namespace App\Controller\Front;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowController extends AbstractController
{
    #[Route('/about/us', name: 'app_about_us')]
    public function aboutUs(): Response
    {
        return $this->render('front/about_us/about_us.html.twig');
    }
    
    #[Route('/carte', name: 'app_carte')]
    public function carte(): Response
    {
        return $this->render('front/carte/carte.html.twig');
    }
    
    #[Route('/map', name: 'app_map')]
    public function map(): Response
    {
        
        return $this->render('front/map/map.html.twig');
    }

    #[Route('/home', name: 'app_home')]
    #[Route('/', name: 'app_default')]
    public function home(NewsRepository $newsRepository): Response
    {
        $newsStatusShow = $newsRepository->findBy(["status" => "show"],);
        return $this->render('front/home/home.html.twig',[
            "newsShow" => $newsStatusShow,
        ]);

    }

    #[Route('/mention', name: 'app_mention')]
    public function mention(): Response
    {
        return $this->render('front/mention/mention.html.twig');
    }
 
}