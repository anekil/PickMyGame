<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;

#[ApiResource(operations: [])]
class SearchRequestDto
{
    public ?string $genres = null;
}