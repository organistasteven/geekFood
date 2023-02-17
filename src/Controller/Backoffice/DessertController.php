<?php

namespace App\Controller\Backoffice;

use App\Entity\Dessert;
use App\Form\DessertType;
use App\Repository\DessertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dessert')]
class DessertController extends AbstractController
{
    #[Route('/dessert', name: 'app_dessert')]
    public function dessert(DessertRepository $dessertRepository): Response
    {
        return $this->render('front/dessert/dessert.html.twig', [
            'desserts' => $dessertRepository->findBy( 
                [],
                [
                    "type" => "ASC"
                ]
            ),
        ]);
    }

    #[Route('/dessert/index', name: 'app_dessert_index')]
    public function index(DessertRepository $dessertRepository): Response
    {
        return $this->render('backoffice/dessert/index.html.twig', [
            'desserts' => $dessertRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dessert_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DessertRepository $dessertRepository): Response
    {
        $dessert = new Dessert();
        $form = $this->createForm(DessertType::class, $dessert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dessertRepository->save($dessert, true);

            return $this->redirectToRoute('app_dessert_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/dessert/new.html.twig', [
            'dessert' => $dessert,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dessert_show', methods: ['GET'])]
    public function show(Dessert $dessert): Response
    {
        return $this->render('backoffice/dessert/show.html.twig', [
            'dessert' => $dessert,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dessert_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dessert $dessert, DessertRepository $dessertRepository): Response
    {
        $form = $this->createForm(DessertType::class, $dessert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dessertRepository->save($dessert, true);

            return $this->redirectToRoute('app_dessert_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/dessert/edit.html.twig', [
            'dessert' => $dessert,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dessert_delete', methods: ['POST'])]
    public function delete(Request $request, Dessert $dessert, DessertRepository $dessertRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dessert->getId(), $request->request->get('_token'))) {
            $dessertRepository->remove($dessert, true);
        }

        return $this->redirectToRoute('app_dessert_index', [], Response::HTTP_SEE_OTHER);
    }
}
