<?php
declare(strict_types=1);

namespace App\Storage;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartSessionStorage
{
    private RequestStack $requestStack;
    private CommandeRepository $commandeRepository;

    public const CART_KEY_NAME = 'cart_id';

    public function __construct(RequestStack $requestStack, CommandeRepository $commandeRepository)
    {
        $this->requestStack = $requestStack;
        $this->commandeRepository = $commandeRepository;
    }

    public function getCart(): ?Commande
    {
        $cartId = $this->getCartId();
        return $this->commandeRepository->findOneBy(['id' => $cartId, 'status' => Commande::STATUS_CART]);
    }

    public function setCart(Commande $cart): void
    {
        $this->getSession()->set(self::CART_KEY_NAME, $cart->getId());
    }

    private function getCartId(): ?int
    {
        return $this->getSession()->get(self::CART_KEY_NAME);
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
}
