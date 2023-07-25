<?php

namespace App\Entity;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Tests\Fixtures\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\UsersGameRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UsersGameRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            normalizationContext: [
                'groups' => ['game:read', 'game:item:get'],
            ],
        ),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
    ],
    normalizationContext: [
        'groups' => ['game:read', 'game:item:get'],
    ],
    denormalizationContext: [
        'groups' => ['game:write'],
    ]
)]
class UsersGame
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['game:write', 'game:read', 'user:read'])]
    private ?int $state = null;

    #[ORM\ManyToOne(inversedBy: 'usersGames')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['game:write', 'game:read'])]
    private ?AppUser $owner = null;

    #[ORM\Column(length: 11)]
    #[Assert\NotBlank]
    #[Groups(['game:write', 'game:read', 'user:read'])]
    private ?string $game = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(int $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getOwner(): ?AppUser
    {
        return $this->owner;
    }

    public function setOwner(?AppUser $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getGame(): ?string
    {
        return $this->game;
    }

    public function setGame(string $game): static
    {
        $this->game = $game;

        return $this;
    }
}
