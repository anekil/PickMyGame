<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\MechanicRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GameController extends AbstractController
{
    /**
     * @param RequestStack $requestStack
     * @param MechanicRepository $mechanicRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(private readonly RequestStack        $requestStack,
                                private readonly HttpClientInterface $client,
                                private readonly MechanicRepository  $mechanicRepository,
                                private readonly CategoryRepository  $categoryRepository)
    {}

    // TODO: work on error handling
    /**
     * @throws Exception
     */
    public function __invoke(): JsonResponse
    {
        $request = $this->requestStack->getMainRequest();
        if ($request) {
            $data = json_decode($request->getContent(), true);

            $response = $this->getDataFromAPI($this->getURL($data));
            if(!$response["status"]){
                return new JsonResponse($response);
            }

            return new JsonResponse(["status" => true, "data" => $this->processResponse($response["data"])]);
        }
        throw new Exception('No parameters');
    }

    private function getURL($toAPI) : string
    {
        $url = $this->getParameter('search_game_url');
        foreach($toAPI as $key => $value){
            if($value !== null)
                $url .= '&'.$key.'='.$value;
        }
        return $url;
    }

    private function getDataFromAPI(string $url): array
    {
        try {
            $response = $this->client->request('GET', $url);
            $statusCode = $response->getStatusCode();
            if($statusCode === 200)
                return ["status" => true, "data" => $response->toArray()];
            else
                return ["status" => false, "data" => (string)$statusCode];
        } catch (TransportExceptionInterface|ClientExceptionInterface|DecodingExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface $e) {
            return ["status" => false, "data" => $e->getMessage()];
        }
    }

    private function processResponse($data)
    {
        $data = $data["games"][0];
        $data["mechanics"] = $this->changeIdToName($data["mechanics"], $this->mechanicRepository);
        $data["categories"] = $this->changeIdToName($data["categories"], $this->categoryRepository);
        return $data;
    }

    private function changeIdToName($ids, $repository): array
    {
        $names = [];
        foreach ($ids as $id){
            $temp = $repository->find($id["id"]);
            $names[] = $temp->getName();
        }
        return $names;
    }
}