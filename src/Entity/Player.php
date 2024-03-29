<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlayerRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['player:read']
    ]
)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['player:read'])]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['player:read'])]
    private ?int $number = null;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'players')]
    #[Groups(['player:read'])]
    private ?Club $club = null;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'players')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['player:read'])]
    private ?Nationality $nationality = null;

    #[Groups(['player:read'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): static
    {
        $this->club = $club;

        return $this;
    }

    public function getNationality(): ?Nationality
    {
        return $this->nationality;
    }

    public function setNationality(?Nationality $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }
}
