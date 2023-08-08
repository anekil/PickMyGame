<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\ApiResource\Game;

class GameDataProcessor implements ProcessorInterface
{
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): Game
    {
        $response = $this->getDataFromAPI($this->getURL($data));
        $answer = new Game();
        $answer->setGameData($this->encodeAnswer($response));
        return $answer;
    }

    private function getURL($toAPI) : string
    {
        $url = 'https://api.boardgameatlas.com/api/search?limit=1&pretty=true&client_id=86dlh7CuWH&fields=id,name,min_players,max_players,min_playtime,max_playtime,min_age,description,image_url,mechanics,categories,rules_url,average_user_rating,description_preview';
        foreach($toAPI as $key => $value){
            if($value !== null)
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

        if(!$response["games"]){
            return [];
        }

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
