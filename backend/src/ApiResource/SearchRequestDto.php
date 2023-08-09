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
            description: 'Search games by parameters')
    ]
)]
class SearchRequestDto
{
    public ?string $mechanics = null;
    public ?string $categories = null;

    public bool $random = true;

    public ?int $min_players = null;

    public ?int $min_playtime = null;

    public ?int $min_age = null;
}