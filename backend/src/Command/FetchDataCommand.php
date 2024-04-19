<?php

namespace App\Command;

use App\Entity\Genre;
use App\Entity\Platform;
use App\Entity\Theme;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:fetch-data',
    description: 'Fetch data needed to searching from API',
)]
class FetchDataCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $entityManager,
                                private readonly ContainerBagInterface  $params,
                                private readonly HttpClientInterface    $client)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $genres = $this->getDataFromAPI($this->params->get('get_genres_url'), "");
            $themes = $this->getDataFromAPI($this->params->get('get_themes_url'), "");
            $platforms = $this->getDataFromAPI($this->params->get('get_platforms_url'), "where id = (39, 34, 6, 3, 14, 163, 162, 11, 7, 41);");

            if(!$genres["status"] || !$themes["status"] || !$platforms["status"]){
                $io->success('Error occurred when downloading data.');
                return Command::FAILURE;
            }

            $this->saveItems($genres["data"], Genre::class);
            $this->saveItems($themes["data"],  Theme::class);
            $this->saveItems($platforms["data"], Platform::class);

            $io->success('Successfully downloaded and saved data.');
            return Command::SUCCESS;

        } catch (NotFoundExceptionInterface|ContainerExceptionInterface) {
            echo "Some error occurred while fetching data.\n";
            return Command::FAILURE;
        }
    }

    private function getDataFromAPI(string $url, string $filters): array
    {
        try {
            $response = $this->client->request('POST', $url, [
                'headers' => [
                    'Authorization: Bearer ' + "API_BEARER_HERE",
                    'Client-ID: ' + "API_CLIENT_ID_HERE"
                ],
                'body' => "fields name; limit 500; ".$filters,
            ]);
            $statusCode = $response->getStatusCode();
            if($statusCode === 200)
                return ["status" => true, "data" => $response->toArray()];
            else
                return ["status" => false, "data" => (string)$statusCode];
        } catch (TransportExceptionInterface|ClientExceptionInterface|DecodingExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface $e) {
            return ["status" => false, "data" => $e->getMessage()];
        }
    }

    private function saveItems($items,  $class) : void
    {
        foreach ($items as $item) {
            $newItem = new $class;
            $newItem->setName($item['name'])
                ->setApiId($item['id']);
            $this->entityManager->persist($newItem);
        }
        $this->entityManager->flush();
    }
}
