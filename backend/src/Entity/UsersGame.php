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
    #[Groups(['game:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['game:write', 'game:read', 'user:read'])]
    private ?string $id_game = null;

    #[ORM\Column]
    #[Groups(['game:write', 'game:read', 'user:read'])]
    private ?int $state = null;

    #[ORM\ManyToOne(inversedBy: 'usersGames')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['game:write', 'game:read'])]
    private ?AppUser $owner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdGame(): ?string
    {
        return $this->id_game;
    }

    public function setIdGame(string $id_game): static
    {
        $this->id_game = $id_game;

        return $this;
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
}
