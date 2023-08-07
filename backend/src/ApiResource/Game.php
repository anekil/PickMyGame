<?php

namespace App\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\State\GameDataProvider;

#[ApiResource(
    operations: [new Get(
        uriTemplate: '/search',
        defaults: ['id' => 0],
        input: SearchRequestDto::class,
        provider: GameDataProvider::class,
        )])]
class Game
{
    #[ApiProperty(identifier: true)]
    private ?string $id = null;

    private ?array $gameData = null;

    /*private ?string $name;
    private ?string $description;
    private ?string $image_url;
    private ?string $rules_url;

    private ?int $min_players;
    private ?int $max_players;
    private ?int $min_playtime;
    private ?int $max_playtime;
    private ?int $min_age;
    private Collection $categories;
    private Collection $mechanics;
    private ?float $average_user_rating;*/

    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return array|null
     */
    public function getGameData(): ?array
    {
        return $this->gameData;
    }

    /**
     * @param array|null $gameData
     */
    public function setGameData(?array $gameData): void
    {
        $this->gameData = $gameData;
    }
}