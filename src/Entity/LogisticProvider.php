<?php

namespace App\Entity;

use App\Entity\Enums\LogisticProviderType;
use App\Repository\LogisticProviderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogisticProviderRepository::class)]
class LogisticProvider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(enumType: LogisticProviderType::class)]
    private ?LogisticProviderType $type = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?LogisticProviderType
    {
        return $this->type;
    }

    public function setType(LogisticProviderType $type): static
    {
        $this->type = $type;

        return $this;
    }
}
