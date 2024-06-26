<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function home(): Response {
        return $this->json([
            'message' => 'Welcome to homepage!',
            'path' => 'src/Controller/HomeController.php',
        ]);
    }
}
