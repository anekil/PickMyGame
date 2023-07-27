<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GamesAPIController extends AbstractController
{
    #[Route('/get', name: 'app_get_api')]
    public function askAPI() : JsonResponse {
        $fromFront = json_decode('{
            "mechanics": [
                "fBOTEBUAmV"        
              ],
            "categories": [
                "7rV11PKqME",
                "nuHYRFmMjU"
              ],
            "min_players": 2
            }', TRUE);
        $toAPI = array();

        dump($fromFront);

        $toAPI["mechanics"] = implode(',', $fromFront["mechanics"]);
        unset($fromFront["mechanics"]);

        $toAPI["categories"] = implode(',', $fromFront["categories"]);
        unset($fromFront["categories"]);

        foreach ($fromFront as $key => $value) {
            $toAPI[$key] = $value;
        }

        dump($toAPI);

        $url = 'https://api.boardgameatlas.com/api/search?limit=1&pretty=true&client_id=86dlh7CuWH&fields=id,name,min_players,max_players,min_playtime,max_playtime,min_age,description,image_url,mechanics,categories,rules_url,average_user_rating,description_preview';
        foreach($toAPI as $key => $value){
            $url .= '&'.$key.'='.$value;
        }
        dump($url);
        # $url = 'https://api.boardgameatlas.com/api/search?limit=1&pretty=true&client_id=86dlh7CuWH&random=true&fields=id%2Cname%2Cmin_players%2Cmax_players%2Cmin_playtime%2Cmax_playtime%2Cmin_age%2Cdescription%2Cimage_url%2Cmechanics%2Ccategories%2Crules_url%2Caverage_user_rating%2Cdescription_preview';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        if($response !== false)
            $response = json_decode($response);
        curl_close($curl);
        return $this->json($response);
    }

    #[Route('/games-api', name: 'app_games_api')]
    public function index(): Response
    {
        return $this->render('games_api/index.html.twig', [
            'controller_name' => 'GamesAPIController',
        ]);
    }
}
