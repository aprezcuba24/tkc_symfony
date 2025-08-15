<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
class Place
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'place')]
    private Collection $orders;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'destination')]
    private Collection $ordersDestinations;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->ordersDestinations = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setPlace($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getPlace() === $this) {
                $order->setPlace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrdersDestinations(): Collection
    {
        return $this->ordersDestinations;
    }

    public function addOrdersDestination(Order $ordersDestination): static
    {
        if (!$this->ordersDestinations->contains($ordersDestination)) {
            $this->ordersDestinations->add($ordersDestination);
            $ordersDestination->setDestination($this);
        }

        return $this;
    }

    public function removeOrdersDestination(Order $ordersDestination): static
    {
        if ($this->ordersDestinations->removeElement($ordersDestination)) {
            // set the owning side to null (unless already changed)
            if ($ordersDestination->getDestination() === $this) {
                $ordersDestination->setDestination(null);
            }
        }

        return $this;
    }
}
