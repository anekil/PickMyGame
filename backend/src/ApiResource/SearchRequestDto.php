<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;

#[ApiResource()]
class SearchRequestDto
{
    public array $mechanics = [];
    public array $categories = [];
    public bool $random = false;
    public int $players = 1;
    public int $playtime = 0;
    public int $min_age = 0;
}