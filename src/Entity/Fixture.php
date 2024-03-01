<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FixtureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FixtureRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => [
        'fixture:read'
    ]]
)]
class Fixture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['fixture:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fixtures')]
    #[Groups(['fixture:read'])]
    private ?Club $homeClub = null;

    #[ORM\ManyToOne(inversedBy: 'fixtures')]
    #[Groups(['fixture:read'])]
    private ?Club $awayClub = null;

    #[ORM\OneToOne(inversedBy: 'fixture', cascade: ['persist', 'remove'])]
    #[Groups(['fixture:read'])]
    private ?Result $result = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['fixture:read'])]
    private ?\DateTimeInterface $date = null;

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

    public function getResult(): ?Result
    {
        return $this->result;
    }

    public function setResult(?Result $result): static
    {
        $this->result = $result;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {

        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }
}
