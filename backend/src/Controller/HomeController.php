<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response {
        return $this->json([
            'message' => 'Welcome to homepage!',
            'path' => 'src/Controller/HomeController.php',
        ]);
    }

    #[Route('/game_{name}', name: 'app_game_details')]
    public function getGame($name): JsonResponse {
        $message = u($name)->title(true);

        return $this->json([
            'message' => $message.' is an awesome game!',
            'path' => 'src/Controller/HomeController.php',
        ]);
    }

    #[Route('/test', name: 'app_test')]
    public function testAPI() : JsonResponse {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.boardgameatlas.com/api/search?limit=3&order_by=rank&ascending=false&pretty=true&client_id=86dlh7CuWH',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $this->json($response);
    }
}
