<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Game;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class GameDataProvider implements ProviderInterface
{
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|null|object
    {
        return $context;
        //$request = $context;
        /*$jsonData = json_decode($request->getContent(), true);
        $toAPI = $this->decodeRequest($jsonData);
        $response = $this->getDataFromAPI($this->getURL($toAPI));
        $answer = new Game();
        $answer->setGameData($this->encodeAnswer($response));
        return $answer;*/
    }
    private function decodeRequest(string $json): array
    {
        $fromFront = json_decode($json, TRUE);
        $toAPI = array();

        $toAPI["mechanics"] = implode(',', $fromFront["mechanics"]);
        unset($fromFront["mechanics"]);

        $toAPI["categories"] = implode(',', $fromFront["categories"]);
        unset($fromFront["categories"]);

        foreach ($fromFront as $key => $value) {
            $toAPI[$key] = $value;
        }
        return $toAPI;
    }

    private function getURL(array $toAPI) : string
    {
        $url = 'https://api.boardgameatlas.com/api/search?limit=1&pretty=true&client_id=86dlh7CuWH&fields=id,name,min_players,max_players,min_playtime,max_playtime,min_age,description,image_url,mechanics,categories,rules_url,average_user_rating,description_preview';
        foreach($toAPI as $key => $value){
            $url .= '&'.$key.'='.$value;
        }
        return $url;
    }

    private function getDataFromAPI(string $url): bool|string
    {
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
        curl_close($curl);
        return $response;
    }

    private function encodeAnswer($response): array
    {
        if($response === false){
            return [];
        }

        $response = json_decode($response, TRUE);

        $fromAPI = $response["games"][0];
        $toFront = array();

        $temp = array();
        foreach ($fromAPI["mechanics"] as $mechanic){
            $temp[] = $mechanic["id"];
        }
        $toFront["mechanics"] = $temp;
        unset($fromAPI["mechanics"]);

        $temp = array();
        foreach ($fromAPI["categories"] as $category){
            $temp[] = $category["id"];
        }
        $toFront["categories"] = $temp;
        unset($fromAPI["categories"]);

        foreach ($fromAPI as $key => $value) {
            $toFront[$key] = $value;
        }

        return $toFront;
    }
}
