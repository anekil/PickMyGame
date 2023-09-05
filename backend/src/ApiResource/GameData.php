<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\GameSearchController;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/search',
            defaults: ['_api_persist' => false],
            controller: GameSearchController::class,
            description: 'Search games by parameters',
            input: SearchRequestDto::class)
    ]
)]
class GameData
{
    private int     $id = 0;
    private string  $name;
    private ?string $summary;
    private ?string $url;
    private ?float  $total_rating;
    private ?array  $genres;
    private ?array  $themes;
    private ?array  $keywords;
    private ?array  $multiplayer_modes;
    private ?array  $platforms;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
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
     * @return string|null
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * @param string|null $summary
     */
    public function setSummary(?string $summary): void
    {
        $this->summary = $summary;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return float|null
     */
    public function getTotalRating(): ?float
    {
        return $this->total_rating;
    }

    /**
     * @param float|null $total_rating
     */
    public function setTotalRating(?float $total_rating): void
    {
        $this->total_rating = $total_rating;
    }

    /**
     * @return array|null
     */
    public function getGenres(): ?array
    {
        return $this->genres;
    }

    /**
     * @param array|null $genres
     */
    public function setGenres(?array $genres): void
    {
        $this->genres = $genres;
    }

    /**
     * @return array|null
     */
    public function getThemes(): ?array
    {
        return $this->themes;
    }

    /**
     * @param array|null $themes
     */
    public function setThemes(?array $themes): void
    {
        $this->themes = $themes;
    }

    /**
     * @return array|null
     */
    public function getKeywords(): ?array
    {
        return $this->keywords;
    }

    /**
     * @param array|null $keywords
     */
    public function setKeywords(?array $keywords): void
    {
        $this->keywords = $keywords;
    }

    /**
     * @return array|null
     */
    public function getMultiplayerModes(): ?array
    {
        return $this->multiplayer_modes;
    }

    /**
     * @param array|null $multiplayer_modes
     */
    public function setMultiplayerModes(?array $multiplayer_modes): void
    {
        $this->multiplayer_modes = $multiplayer_modes;
    }

    /**
     * @return array|null
     */
    public function getPlatforms(): ?array
    {
        return $this->platforms;
    }

    /**
     * @param array|null $platforms
     */
    public function setPlatforms(?array $platforms): void
    {
        $this->platforms = $platforms;
    }


}