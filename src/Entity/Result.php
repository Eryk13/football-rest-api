<?php

namespace App\Entity;

use App\Repository\ResultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultRepository::class)]
class Result
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $homeClubScore = null;

    #[ORM\Column]
    private ?int $awayClubScore = null;

    #[ORM\OneToOne(mappedBy: 'result', cascade: ['persist', 'remove'])]
    private ?Fixture $fixture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHomeClubScore(): ?int
    {
        return $this->homeClubScore;
    }

    public function setHomeClubScore(int $homeClubScore): static
    {
        $this->homeClubScore = $homeClubScore;

        return $this;
    }

    public function getAwayClubScore(): ?int
    {
        return $this->awayClubScore;
    }

    public function setAwayClubScore(int $awayClubScore): static
    {
        $this->awayClubScore = $awayClubScore;

        return $this;
    }

    public function getFixture(): ?Fixture
    {
        return $this->fixture;
    }

    public function setFixture(?Fixture $fixture): static
    {
        // unset the owning side of the relation if necessary
        if ($fixture === null && $this->fixture !== null) {
            $this->fixture->setResult(null);
        }

        // set the owning side of the relation if necessary
        if ($fixture !== null && $fixture->getResult() !== $this) {
            $fixture->setResult($this);
        }

        $this->fixture = $fixture;

        return $this;
    }
}
