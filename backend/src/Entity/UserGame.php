<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\UserGameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserGameRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(security: "is_granted('ROLE_USER') and object.getOwner() == user"),
        new Post(security: "is_granted('ROLE_USER')"),
        new Delete(security: "is_granted('ROLE_USER') and object.getOwner() == user"),
        new Put(security: "is_granted('ROLE_USER') and object.getOwner() == user",
                securityPostDenormalize: 'object.getOwner() == user'),
        new Patch(security: "is_granted('ROLE_USER') and object.getOwner() == user",
                securityPostDenormalize: 'object.getOwner() == user'),
    ],
    openapiContext: ['security' => [['JWT' => []]]],

)]
class UserGame
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idGame = null;

    #[ORM\Column(length: 255)]
    private ?string $owningState = null;

    #[ORM\ManyToOne(inversedBy: 'userGames')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdGame(): ?string
    {
        return $this->idGame;
    }

    public function setIdGame(string $idGame): static
    {
        $this->idGame = $idGame;

        return $this;
    }

    public function getOwningState(): ?string
    {
        return $this->owningState;
    }

    public function setOwningState(string $owningState): static
    {
        $this->owningState = $owningState;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }
}
