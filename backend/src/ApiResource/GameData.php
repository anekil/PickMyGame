<?php

namespace App\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\GameController;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/search/',
            defaults: ['_api_persist' => false],
            controller: GameController::class,
            description: 'Search games by parameters',
            input: SearchRequestDto::class)
    ]
)]
class GameData
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setGameData($data): GameData
    {
        $this->name = $data;
        return $this;
    }
}