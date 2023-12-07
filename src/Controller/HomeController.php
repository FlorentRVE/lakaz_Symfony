<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lakaz')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, CategorieRepository $categorieRepository): Response
    {
        // Récupération de la valeur de la recherche
        $searchTerm = $request->query->get('search');

        // On récupére les données de la base en fonction de la recherche
        $data = $categorieRepository->getRecettesFromSearch($searchTerm);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'data' => $data,
            'searchTerm' => $searchTerm,
        ]);
    }

    #[Route('/{id}', name: 'app_home_show', methods: ['GET'])]
    public function show(Recette $recette): Response
    {
        return $this->render('home/show.html.twig', [
            'recette' => $recette,
        ]);
    }
}
