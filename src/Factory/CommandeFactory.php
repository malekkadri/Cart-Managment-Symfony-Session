<?php 
declare(strict_types=1);

namespace App\Factory;

use App\Entity\Commande;
use App\Entity\CommandeItems;
use App\Entity\Produit;
use DateTime;

/**
 * Class CommandeFactory.
 */
class CommandeFactory
{
    /**
     * Creates a commande (order).
     */
    public function create(): Commande
    {
        $commande = new Commande();
        $commande
            ->setUserAddress(null)  // Assuming you might want to set this later
            ->setOrderDate(new DateTime())
            ->setDeliveryDate(null)  // Assuming you might want to set this later
            ->setTotalPrice(0);

        return $commande;
    }

    /**
     * Creates an item for a product.
     */
    public function createItem(Produit $product): CommandeItems
    {
        $item = new CommandeItems();
        $item->setProduct($product);
        $item->setQuantity(1);

        return $item;
    }
}
