<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;

#[ApiResource(operations: [])]
class SearchRequestDto
{
    public ?string $title = null;
    public ?array $genres = null;
    public ?array $platforms = null;
    public ?array $themes = null;
}