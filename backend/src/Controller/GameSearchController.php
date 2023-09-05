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

class GameSearchController extends AbstractController
{
    /**
     * @param RequestStack $requestStack
     * @param HttpClientInterface $client
     * @param SerializerInterface $serializer
     */
    public function __construct(private readonly RequestStack        $requestStack,
                                private readonly HttpClientInterface $client,
                                private readonly SerializerInterface $serializer,
                                //private readonly MechanicRepository  $mechanicRepository,
                                //private readonly CategoryRepository  $categoryRepository)
                                )
    {}

    /**
     * @throws Exception
     */
    public function __invoke(): JsonResponse
    {
        $request = $this->requestStack->getMainRequest();
        if ($request) {
            //$params = json_decode($request->getContent(), true);
            $params = 'fields name, total_rating, genres.name, keywords.name, multiplayer_modes.*, platforms.name, summary, themes.name, url; limit 1;' . 'where genres.name = ("Adventure");';

            try {
                $response = $this->getDataFromAPI($this->getParameter('search_game_url'), $params);
                $response = $this->processResponse($response);
                return new JsonResponse($this->serializer->serialize($response, 'json'), 200, [], true);
            } catch (ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|TransportExceptionInterface $e) {
                throw new Exception('Problem with connection');
            }
        }
        throw new Exception('No parameters');
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    private function getDataFromAPI(string $url, string $params): GameData | array
    {
        $response = $this->client->request('POST', $url, [
            'headers' => [
                'Authorization: Bearer owwipoumkigqgzhrkjd4evg8v720cp',
                'Client-ID: t6vglpbbejgf6vm4ptt5q5lsrlros2'
            ],
            'body' => $params,
        ]);
        $data = json_decode($response->getContent(), true);
        $data = $data[0];
        $data = json_encode($data, true);
        return $this->serializer->deserialize($data, GameData::class, 'json');
    }

    private function processResponse(GameData $data): GameData
    {
        //$data->setMechanics($this->changeIdToName($data->getMechanics(), $this->mechanicRepository));
        //$data->setCategories($this->changeIdToName($data->getCategories(), $this->categoryRepository));
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