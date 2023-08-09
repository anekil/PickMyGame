<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\Mechanic;
use Doctrine\ORM\EntityManagerInterface;
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
    name: 'app:get-categories-and-mechanics',
    description: 'Add a short description for your command',
)]
class GetCategoriesAndMechanicsCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $entityManager,
                                private ContainerBagInterface $params,
                                private readonly HttpClientInterface $client)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $categories = $this->getDataFromAPI($this->params->get('get_categories_url'));
            $mechanics = $this->getDataFromAPI($this->params->get('get_mechanics_url'));

            if(!$categories["status"] || !$mechanics["status"] ){
                $io->success('Error occurred when downloading data.');
                return Command::FAILURE;
            }

            $this->saveItems($categories["data"]["categories"], Category::class);
            $this->saveItems($mechanics["data"]["mechanics"],  Mechanic::class);

            $io->success('Successfully downloaded and saved categories and mechanics.');
            return Command::SUCCESS;

        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return Command::FAILURE;
        }
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
