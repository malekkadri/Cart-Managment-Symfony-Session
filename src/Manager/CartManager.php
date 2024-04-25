<?php
declare(strict_types=1);

namespace App\Manager;

use App\Entity\Commande;
use App\Factory\CommandeFactory;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;

class CartManager
{
    private CartSessionStorage $cartSessionStorage;
    private CommandeFactory $commandeFactory;
    private EntityManagerInterface $entityManager;

    public function __construct(CartSessionStorage $cartSessionStorage, CommandeFactory $commandeFactory, EntityManagerInterface $entityManager)
    {
        $this->cartSessionStorage = $cartSessionStorage;
        $this->commandeFactory = $commandeFactory;
        $this->entityManager = $entityManager;
    }

    public function getCurrentCart(): Commande
    {
        $cart = $this->cartSessionStorage->getCart() ?: $this->commandeFactory->create();
        return $cart;
    }

    public function save(Commande $cart): void
    {
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
        $this->cartSessionStorage->setCart($cart);
    }
}
