<?php

namespace App\Controller;

use App\ApiResource\GameData;
use App\Repository\CategoryRepository;
use App\Repository\MechanicRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GameController extends AbstractController
{
    /**
     * @param RequestStack $requestStack
     * @param HttpClientInterface $client
     * @param SerializerInterface $serializer
     * @param MechanicRepository $mechanicRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(private readonly RequestStack        $requestStack,
                                private readonly HttpClientInterface $client,
                                private readonly SerializerInterface $serializer,
                                private readonly MechanicRepository  $mechanicRepository,
                                private readonly CategoryRepository  $categoryRepository)
    {}

    /**
     * @throws Exception
     */
    public function __invoke(): JsonResponse
    {
        $request = $this->requestStack->getMainRequest();
        if ($request) {
            $data = json_decode($request->getContent(), true);

            try {
                $response = $this->getDataFromAPI($this->getURL($data));
                $response = $this->processResponse($response);
                return new JsonResponse($this->serializer->serialize($response, 'json'), 200, [], true);
            } catch (ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|TransportExceptionInterface $e) {
                throw new Exception('Problem with connection');
            }
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

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    private function getDataFromAPI(string $url): GameData
    {
        $response = $this->client->request('GET', $url);
        $data = json_decode($response->getContent(), true);
        $data = $data['games'][0];
        $data = json_encode($data, true);
        return $this->serializer->deserialize($data, GameData::class, 'json');
    }

    private function processResponse(GameData $data): GameData
    {
        $data->setMechanics($this->changeIdToName($data->getMechanics(), $this->mechanicRepository));
        $data->setCategories($this->changeIdToName($data->getCategories(), $this->categoryRepository));
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