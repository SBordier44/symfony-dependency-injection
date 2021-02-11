<?php

declare(strict_types=1);

namespace App\Database;

use App\Model\Order;

class Database
{
    public function insertOrder(Order $order): void
    {
        var_dump("REQUETE DATABASE POUR INSERER LA COMMANDE");
    }
}
