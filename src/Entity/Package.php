<?php

namespace App\Entity;

use App\Entity\Enums\PackageType;
use App\Repository\PackageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackageRepository::class)]
class Package
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?float $weight = null;

    #[ORM\Column(nullable: true)]
    private ?float $volumen = null;

    #[ORM\Column(enumType: PackageType::class)]
    private ?PackageType $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getVolumen(): ?float
    {
        return $this->volumen;
    }

    public function setVolumen(?float $volumen): static
    {
        $this->volumen = $volumen;

        return $this;
    }

    public function getType(): ?PackageType
    {
        return $this->type;
    }

    public function setType(PackageType $type): static
    {
        $this->type = $type;

        return $this;
    }
}
