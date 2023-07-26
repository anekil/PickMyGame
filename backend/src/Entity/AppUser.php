<?php

namespace App\Entity;

use App\Repository\AppUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Serializer\Filter\PropertyFilter;

#[ORM\Entity(repositoryClass: AppUserRepository::class)]
#[ApiResource(
    shortName: 'Users',
    normalizationContext: [
        'groups' => ['user:read'],
    ],
    denormalizationContext: [
        'groups' => ['user:write'],
    ]
)]
#[UniqueEntity(fields: ['username'], message: 'This username is taken.')]
#[ApiFilter(PropertyFilter::class)]
class AppUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank]
    #[Groups(['user:write', 'user:read', 'game:read', 'game:item:get'])]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\NotBlank]
    #[Groups(['user:write'])]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: UsersGame::class, orphanRemoval: true)]
    #[Groups(['user:read'])]
    private Collection $usersGames;

    public function __construct()
    {
        $this->usersGames = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, UsersGame>
     */
    public function getUsersGames(): Collection
    {
        return $this->usersGames;
    }

    public function addUsersGame(UsersGame $usersGame): static
    {
        if (!$this->usersGames->contains($usersGame)) {
            $this->usersGames->add($usersGame);
            $usersGame->setOwner($this);
        }

        return $this;
    }

    public function removeUsersGame(UsersGame $usersGame): static
    {
        if ($this->usersGames->removeElement($usersGame)) {
            // set the owning side to null (unless already changed)
            if ($usersGame->getOwner() === $this) {
                $usersGame->setOwner(null);
            }
        }

        return $this;
    }
}
