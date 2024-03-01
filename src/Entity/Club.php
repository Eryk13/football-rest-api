<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
#[ApiResource(order: ['name' => 'ASC'])]
#[ApiFilter(OrderFilter::class, properties: ['name' => 'ASC'], arguments: ['orderParameterName' => 'order'])]
class Club
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['player:read', 'fixture:read'])]

    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['player:read', 'fixture:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $stadiumName = null;

    #[ORM\OneToMany(targetEntity: Player::class, mappedBy: 'club')]
    private Collection $players;

    #[ORM\ManyToMany(targetEntity: Tournament::class, mappedBy: 'clubs')]
    private Collection $tournaments;

    #[ORM\OneToMany(targetEntity: Fixture::class, mappedBy: 'homeClub')]
    private Collection $fixtures;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->tournaments = new ArrayCollection();
        $this->fixtures = new ArrayCollection();
    }
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

    public function getStadiumName(): ?string
    {
        return $this->stadiumName;
    }

    public function setStadiumName(string $stadiumName): static
    {
        $this->stadiumName = $stadiumName;

        return $this;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): static
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
            $player->setClub($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): static
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getClub() === $this) {
                $player->setClub(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tournament>
     */
    public function getTournaments(): Collection
    {
        return $this->tournaments;
    }

    public function addTournament(Tournament $tournament): static
    {
        if (!$this->tournaments->contains($tournament)) {
            $this->tournaments->add($tournament);
            $tournament->addClub($this);
        }

        return $this;
    }

    public function removeTournament(Tournament $tournament): static
    {
        if ($this->tournaments->removeElement($tournament)) {
            $tournament->removeClub($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Fixture>
     */
    public function getFixtures(): Collection
    {
        return $this->fixtures;
    }

    public function addFixture(Fixture $fixture): static
    {
        if (!$this->fixtures->contains($fixture)) {
            $this->fixtures->add($fixture);
            $fixture->setHomeClub($this);
        }

        return $this;
    }

    public function removeFixture(Fixture $fixture): static
    {
        if ($this->fixtures->removeElement($fixture)) {
            // set the owning side to null (unless already changed)
            if ($fixture->getHomeClub() === $this) {
                $fixture->setHomeClub(null);
            }
        }

        return $this;
    }
}
