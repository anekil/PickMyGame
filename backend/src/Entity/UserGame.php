<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserGameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserGameRepository::class)]
#[ApiResource(
    security: "is_granted('ROLE_ADMIN') or object.owner == user"
)]
class UserGame
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $IdUser = null;

    #[ORM\Column(length: 255)]
    private ?string $IdGame = null;

    #[ORM\Column(length: 255)]
    private ?string $OwningState = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?string
    {
        return $this->IdUser;
    }

    public function setIdUser(string $IdUser): static
    {
        $this->IdUser = $IdUser;

        return $this;
    }

    public function getIdGame(): ?string
    {
        return $this->IdGame;
    }

    public function setIdGame(string $IdGame): static
    {
        $this->IdGame = $IdGame;

        return $this;
    }

    public function getOwningState(): ?string
    {
        return $this->OwningState;
    }

    public function setOwningState(string $OwningState): static
    {
        $this->OwningState = $OwningState;

        return $this;
    }
}
