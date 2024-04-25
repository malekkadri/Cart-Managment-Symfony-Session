<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\CommandeItemsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommandeItemsRepository::class)]
class CommandeItems
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Produit::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $product = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\GreaterThanOrEqual(1)]
    private ?int $quantity = null;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $orderRef = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getProduct(): ?Produit
    {
        return $this->product;
    }

    public function setProduct(?Produit $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getOrderRef(): ?Commande
    {
        return $this->orderRef;
    }

    public function setOrderRef(?Commande $orderRef): self
    {
        $this->orderRef = $orderRef;
        return $this;
    }
}
