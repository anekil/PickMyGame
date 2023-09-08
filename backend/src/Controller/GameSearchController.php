<?php

namespace App\Controller;

use App\ApiResource\GameData;
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
                                )
    {}

    /**
     * @throws Exception
     * @throws TransportExceptionInterface
     */
    public function __invoke(): JsonResponse
    {
        $request = $this->requestStack->getMainRequest();
        if ($request) {
            try {
                $params = json_decode($request->getContent(), true);
                $response = $this->getDataFromAPI($this->getParameter('search_game_url'), $this->getFilters($params));
                $response = $this->processResponse($response);
                return new JsonResponse($this->serializer->serialize($response, 'json'), 200, [], true);
            } catch (ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|TransportExceptionInterface) {
                throw new Exception('Problem with connection');
            }
        }
        throw new Exception('No parameters');
    }

    private function getFilters($params): string
    {
        $filters = [];
        if($params["title"] != null)
            $filters[] = ' name ~ *"' . $params["title"] . '"* ';
        if($params["genres"] != null){
            $filters[] = " genres = [" . implode(",", $params["genres"]) . "]";
        }
        if($params["platforms"] != null){
            $filters[] = " platforms = [" . implode(",", $params["platforms"]) . "]";
        }
        if($params["themes"] != null){
            $filters[] = " themes = [" . implode(",", $params["themes"]) . "]";
        }
        $filters = "where " . implode("&", $filters) . ";";
        $fields = 'fields name, total_rating, genres.name, keywords.name, multiplayer_modes.*, platforms.name, summary, themes.name, url, cover.url, screenshots.url; limit 1; ';
        return $fields.$filters;
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
        $data->setGenres($this->setToNames($data->getGenres(), "name"));
        $data->setThemes($this->setToNames($data->getThemes(), "name"));
        $data->setKeywords($this->setToNames($data->getKeywords(), "name"));
        $data->setPlatforms($this->setToNames($data->getPlatforms(), "name"));
        $data->setScreenshots($this->setToNames($data->getScreenshots(), "url"));
        return $data;
    }

    private function setToNames($items, $field): ?array
    {
        if($items == null)
            return $items;
        $names = [];
        foreach ($items as $item){
            $names[] = $item[$field];
        }
        return $names;
    }
}