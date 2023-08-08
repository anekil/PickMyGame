<?php

namespace App\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\State\GameDataProcessor;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/search/',
            description: 'Search games by parameters',
            input: SearchRequestDto::class,
            output: Game::class,
            processor: GameDataProcessor::class),
       // new Post(
       //     uriTemplate: '/search/{name}',
       //     description: 'Search games by name')
    ]
)]
class Game
{
    #[ApiProperty(identifier: true)]
    private ?string $id = null;

    private ?string $apiId;
    private string $name;
    private ?string $description;
    private ?string $image_url;
    private ?string $rules_url;

    private ?int $min_players;
    private ?int $max_players;
    private ?int $min_playtime;
    private ?int $max_playtime;
    private ?int $min_age;
    private ?string $categories;
    private ?string $mechanics;
    private ?float $average_user_rating;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setGameData($data)
    {
        $this->name = json_encode($data);
    }
}