<?php

namespace BuddieDJ\Oxxa\Functions;

use BuddieDJ\Oxxa\Exceptions\OxxaApiException;
use BuddieDJ\Oxxa\Oxxa;

class Cart extends Oxxa
{
    /**
     * @throws OxxaApiException
     */
    public function add(string $sld, string $tld, string $type, string $endUserIp, array $args = [])
    {
        if(!in_array($type, ["RENEW", "REGISTER", "TRANSFER"])) {
            throw new OxxaApiException("The selected product type is not valid, choose from RENEW, TRANSFER or REGISTER");
        }

        $query = [
            "command" => "cart_add",
            "sld" => $sld,
            "tld" => $tld,
            "producttype" => $type,
            "enduserip" => $endUserIp
        ];

        $query = array_merge($query, $args);
        return $this->call($query);
    }

    public function delete(string $endUserIp, string $itemId, bool $emptyCart = false)
    {
        $emptyCart = $emptyCart ? "Y" : "N";

        return $this->call([
            "command" => "cart_del",
            "enduserip" => $endUserIp,
            "itemid" => $itemId,
            "emptycart" => $emptyCart
        ]);
    }

    public function get(int $cartId)
    {
        return $this->call([
            "command" => "cart_get",
            "cart_id" => $cartId,
        ]);
    }

    public function list(int $start = 0, int $records = null)
    {
        return $this->call([
            "command" => "cart_list",
            "start" => $start,
            "records" => $records
        ]);
    }

    public function purchase(string $cartId = "ALL")
    {
        return $this->call([
            "command" => "cart_purchase",
            "cart_id" => $cartId
        ]);
    }

    public function upd(string $endUserIp, int $itemId, array $args)
    {
        $query = [
            "command" => "cart_upd",
            "enduserip" => $endUserIp,
            "itemid" => $itemId,
        ];

        $query = array_merge($query, $args);

        return $this->call($query);
    }
}
