<?php

namespace App\Controller\Backoffice;

use App\Entity\Start;
use App\Form\StartType;
use App\Repository\StartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/start')]
class StartController extends AbstractController
{
    #[Route('/', name: 'app_start')]
    public function start(StartRepository $startRepository): Response
    {
        return $this->render('front/start/start.html.twig', [
            'starts' => $startRepository->findAll(),
        ]);
    }

    #[Route('/index', name: 'app_start_index')]
    public function index(StartRepository $startRepository): Response
    {
        return $this->render('backoffice/start/index.html.twig', [
            'starts' => $startRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_start_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StartRepository $startRepository): Response
    {
        $start = new Start();
        $form = $this->createForm(StartType::class, $start);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $startRepository->save($start, true);

            return $this->redirectToRoute('app_start_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('backoffice/start/new.html.twig', [
            'start' => $start,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_start_show', methods: ['GET'])]
    public function show(Start $start): Response
    {
        return $this->render('backoffice/start/show.html.twig', [
            'start' => $start,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_start_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Start $start, StartRepository $startRepository): Response
    {
        $form = $this->createForm(StartType::class, $start);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $startRepository->save($start, true);

            return $this->redirectToRoute('app_start_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('backoffice/start/edit.html.twig', [
            'start' => $start,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_start_delete', methods: ['POST'])]
    public function delete(Request $request, Start $start, StartRepository $startRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$start->getId(), $request->request->get('_token'))) {
            $startRepository->remove($start, true);
        }

        return $this->redirectToRoute('app_start_index', [], Response::HTTP_SEE_OTHER);
    }
}
