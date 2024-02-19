<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
class Player
{
    private int $id;
    public string $name;
    public int $number;
    public ?Club $club = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}