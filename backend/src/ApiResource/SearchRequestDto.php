<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource(operations: [])]
class SearchRequestDto
{
    /**
     * @var string|null
     */
    public ?string $mechanics = null;
    /**
     * @var string|null
     */
    public ?string $categories = null;
    /**
     * @var bool
     */
    public bool $random = false;
    /**
     * @var int|null
     */
    public ?int $min_players = null;
    /**
     * @var int|null
     */
    public ?int $min_playtime = null;
    /**
     * @var int|null
     */
    public ?int $min_age = null;

    #[ApiProperty(identifier: true)]
    private ?string $id = null;

    public function getId(): ?string
    {
        return $this->id;
    }
}