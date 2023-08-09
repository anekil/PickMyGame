<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;

#[ApiResource()]
class SearchRequestDto
{
    public ?string $mechanics = null;
    public ?string $categories = null;

    public bool $random = true;

    public ?int $min_players = null;

    public ?int $min_playtime = null;

    public ?int $min_age = null;
}