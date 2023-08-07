<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\Mechanic;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
#[AsCommand(
    name: 'app:get-categories-and-mechanics',
    description: 'Add a short description for your command',
)]
class GetCategoriesAndMechanicsCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $categories = $this->getDataFromAPI('https://api.boardgameatlas.com/api/game/categories?client_id=86dlh7CuWH');
        $mechanics = $this->getDataFromAPI('https://api.boardgameatlas.com/api/game/mechanics?client_id=86dlh7CuWH');

        if($categories === false || $mechanics === false){
            $io->success('Error occurred when downloading data.');
            return Command::FAILURE;
        }

        $this->saveCategories($categories);
        $this->saveMechanics($mechanics);

        $io->success('Successfully downloaded and saved categories and mechanics.');
        return Command::SUCCESS;
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

    private function saveCategories($categories) : void
    {
        $categories = json_decode($categories, TRUE);
        $categories = $categories['categories'];

        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->setName($category['name'])
                ->setApiId($category['id']);
            $this->entityManager->persist($newCategory);
        }
        $this->entityManager->flush();
    }

    private function saveMechanics($mechanics) : void
    {
        $mechanics = json_decode($mechanics, TRUE);
        $mechanics = $mechanics['mechanics'];

        foreach ($mechanics as $mechanic) {
            $newMechanic = new Mechanic();
            $newMechanic->setName($mechanic['name'])
                ->setApiId($mechanic['id']);
            $this->entityManager->persist($newMechanic);
        }
        $this->entityManager->flush();
    }
}
