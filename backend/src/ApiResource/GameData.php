<?php

namespace App\ApiResource;

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
    private string $id;
    private string $name;

    private ?int $min_players;
    private ?int $max_players;
    private ?int $min_playtime;
    private ?int $max_playtime;
    private ?int $min_age;

    private ?string $image_url;
    private ?string $description;
    private ?string $description_preview;
    private ?string $rules_url;

    private ?float $average_user_rating;

    private array $mechanics;
    private array $categories;


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getMinPlayers(): ?int
    {
        return $this->min_players;
    }

    /**
     * @param int|null $min_players
     */
    public function setMinPlayers(?int $min_players): void
    {
        $this->min_players = $min_players;
    }

    /**
     * @return int|null
     */
    public function getMaxPlayers(): ?int
    {
        return $this->max_players;
    }

    /**
     * @param int|null $max_players
     */
    public function setMaxPlayers(?int $max_players): void
    {
        $this->max_players = $max_players;
    }

    /**
     * @return int|null
     */
    public function getMinPlaytime(): ?int
    {
        return $this->min_playtime;
    }

    /**
     * @param int|null $min_playtime
     */
    public function setMinPlaytime(?int $min_playtime): void
    {
        $this->min_playtime = $min_playtime;
    }

    /**
     * @return int|null
     */
    public function getMaxPlaytime(): ?int
    {
        return $this->max_playtime;
    }

    /**
     * @param int|null $max_playtime
     */
    public function setMaxPlaytime(?int $max_playtime): void
    {
        $this->max_playtime = $max_playtime;
    }

    /**
     * @return int|null
     */
    public function getMinAge(): ?int
    {
        return $this->min_age;
    }

    /**
     * @param int|null $min_age
     */
    public function setMinAge(?int $min_age): void
    {
        $this->min_age = $min_age;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    /**
     * @param string|null $image_url
     */
    public function setImageUrl(?string $image_url): void
    {
        $this->image_url = $image_url;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getDescriptionPreview(): ?string
    {
        return $this->description_preview;
    }

    /**
     * @param string|null $description_preview
     */
    public function setDescriptionPreview(?string $description_preview): void
    {
        $this->description_preview = $description_preview;
    }

    /**
     * @return string|null
     */
    public function getRulesUrl(): ?string
    {
        return $this->rules_url;
    }

    /**
     * @param string|null $rules_url
     */
    public function setRulesUrl(?string $rules_url): void
    {
        $this->rules_url = $rules_url;
    }

    /**
     * @return float|null
     */
    public function getAverageUserRating(): ?float
    {
        return $this->average_user_rating;
    }

    /**
     * @param float|null $average_user_rating
     */
    public function setAverageUserRating(?float $average_user_rating): void
    {
        $this->average_user_rating = $average_user_rating;
    }

    /**
     * @return array
     */
    public function getMechanics(): array
    {
        return $this->mechanics;
    }

    /**
     * @param array $mechanics
     */
    public function setMechanics(array $mechanics): void
    {
        $this->mechanics = $mechanics;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     */
    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }
}