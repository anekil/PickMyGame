<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\GameSearchController;
use Symfony\Component\Serializer\Annotation\SerializedName;

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
    private string  $name = "";
    private ?string $summary = null;
    private ?string $url = null;
    private ?float  $total_rating = null;
    private ?array  $genres = null;
    private ?array  $themes = null;
    private ?array  $keywords = null;
    private ?array  $multiplayer_modes = null;
    private ?array  $platforms = null;
    private ?array  $cover = null;
    private ?array  $screenshots = null;

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
        return round($this->total_rating);
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

    /**
     * @return array|null
     */
    public function getCover(): ?array
    {
        if($this->cover == null)
            return $this->cover;
        if(is_array($this->cover) && isset($this->cover["url"]))
            $this->cover["url"] = ltrim($this->cover["url"], '/');
        return $this->cover;
    }

    /**
     * @param array|null $cover
     */
    public function setCover(?array $cover): void
    {
        $this->cover = $cover;
    }

    /**
     * @return array|null
     */
    public function getScreenshots(): ?array
    {
        if($this->screenshots == null)
            return $this->screenshots;
        foreach ($this->screenshots as &$item){
            if(is_array($item) && isset($item["url"]))
                $item["url"] = ltrim($item["url"], '/');
        }
        return $this->screenshots;
    }

    /**
     * @param array|null $screenshots
     */
    public function setScreenshots(?array $screenshots): void
    {
        $this->screenshots = $screenshots;
    }
}