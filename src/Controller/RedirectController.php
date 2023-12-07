<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedirectController extends AbstractController
{
    #[Route('/', name: 'app_redirect')]
    public function index()
    {
        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}
