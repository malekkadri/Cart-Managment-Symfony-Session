<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $userAddress = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $orderDate = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $deliveryDate = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $totalPrice = null;

    #[ORM\OneToMany(mappedBy: 'orderRef', targetEntity: CommandeItems::class)]
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserAddress(): ?string
    {
        return $this->userAddress;
    }

    public function setUserAddress(?string $userAddress): self
    {
        $this->userAddress = $userAddress;
        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(?\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(?\DateTimeInterface $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(?int $totalPrice): self
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(CommandeItems $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setOrderRef($this);
        }
        return $this;
    }

    public function removeItem(CommandeItems $item): self
    {
        if ($this->items->removeElement($item)) {
            // Set the owning side to null (unless already changed)
            if ($item->getOrderRef() === $this) {
                $item->setOrderRef(null);
            }
        }
        return $this;
    }
}
