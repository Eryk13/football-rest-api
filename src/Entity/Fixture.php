<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FixtureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FixtureRepository::class)]
#[ApiResource]
class Fixture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fixtures')]
    private ?Club $homeClub = null;

    #[ORM\ManyToOne(inversedBy: 'fixtures')]
    private ?Club $awayClub = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHomeClub(): ?Club
    {
        return $this->homeClub;
    }

    public function setHomeClub(?Club $homeClub): static
    {
        $this->homeClub = $homeClub;

        return $this;
    }

    public function getAwayClub(): ?Club
    {
        return $this->awayClub;
    }

    public function setAwayClub(?Club $awayClub): static
    {
        $this->awayClub = $awayClub;

        return $this;
    }
}
