<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\MechanicRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class GameController extends AbstractController
{
    /**
     * @param RequestStack $requestStack
     * @param MechanicRepository $mechanicRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(private readonly RequestStack $requestStack,
                                private readonly MechanicRepository $mechanicRepository,
                                private readonly CategoryRepository $categoryRepository)
    {}

    /**
     * @throws Exception
     */
    public function __invoke(): JsonResponse
    {
        $request = $this->requestStack->getMainRequest();
        if ($request) {
            $data = json_decode($request->getContent(), true);
            $response = $this->getDataFromAPI($this->getURL($data));
            if($response === false)
                return new JsonResponse([]);
            return new JsonResponse($this->processResponse($response));
        }
        throw new Exception('No parameters');
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

    private function processResponse($data)
    {
        $data = json_decode($data, true);
        $data = $data["games"][0];

        $mechanics = array();
        foreach ($data["mechanics"] as $mechanic){
            $temp = $this->mechanicRepository->find($mechanic["id"]);
            $mechanics[] = $temp->getName();
        }
        $data["mechanics"] = $mechanics;

        $categories = array();
        foreach ($data["categories"] as $category){
            $temp = $this->categoryRepository->find($category["id"]);
            $categories[] = $temp->getName();
        }
        $data["categories"] = $categories;

        return $data;
    }
}