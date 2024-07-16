<?php

namespace App\Entity;

use App\Repository\DrinkRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;

#[ORM\Entity(repositoryClass: DrinkRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['drink:read']],
    denormalizationContext: ['groups' => ['drink:write']],
    operations: [
        new GetCollection(),
        new Post(),
        new Get(),
        new Put(),
        new Patch(),
        new Delete(),
    ],
)]
#[Post(security: "is_granted('ROLE_BARMAN') or is_granted('ROLE_BOSS')")]
#[Get(security: "is_granted('ROLE_BARMAN') or is_granted('ROLE_BOSS')")]
#[Put(security: "is_granted('ROLE_BARMAN') or is_granted('ROLE_BOSS')")]
#[Patch(security: "is_granted('ROLE_BOSS')")]
#[Delete(security: "is_granted('ROLE_BARMAN') or is_granted('ROLE_BOSS')")]
class Drink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Media $picture = null;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPicture(): ?Media
    {
        return $this->picture;
    }

    public function setPicture(?Media $picture): static
    {
        $this->picture = $picture;

        return $this;
    }
}
