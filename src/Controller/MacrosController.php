<?php

namespace App\Controller;

use App\Entity\Macros;
use App\Form\MacrosType;
use App\Repository\MacrosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/macros')]
class MacrosController extends AbstractController
{
    #[Route('/', name: 'app_macros_index', methods: ['GET'])]
    public function index(MacrosRepository $macrosRepository): Response
    {
        return $this->render('macros/index.html.twig', [
            'macros' => $macrosRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_macros_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $macro = new Macros();
        $form = $this->createForm(MacrosType::class, $macro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($macro);
            $entityManager->flush();

            return $this->redirectToRoute('app_macros_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('macros/new.html.twig', [
            'macro' => $macro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_macros_show', methods: ['GET'])]
    public function show(Macros $macro): Response
    {
        return $this->render('macros/show.html.twig', [
            'macro' => $macro,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_macros_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Macros $macro, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MacrosType::class, $macro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_macros_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('macros/edit.html.twig', [
            'macro' => $macro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_macros_delete', methods: ['POST'])]
    public function delete(Request $request, Macros $macro, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$macro->getId(), $request->request->get('_token'))) {
            $entityManager->remove($macro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_macros_index', [], Response::HTTP_SEE_OTHER);
    }
}
