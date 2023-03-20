<?php

namespace BuddieDJ\Oxxa;

use BuddieDJ\Oxxa\Functions\Cart;
use BuddieDJ\Oxxa\Functions\DnsRecord;
use BuddieDJ\Oxxa\Functions\Domain;
use BuddieDJ\Oxxa\Functions\Fund;
use GuzzleHttp\Client;

class Oxxa
{
    protected static function call(array $arguments)
    {
        $client = new Client([
            'base_uri' => "https://api.oxxa.com/command.php",
            'timeout'  => 10.0,
        ]);

        $query = [
            'apiuser' => config('integrations.oxxa.auth.username'),
            'apipassword' => config('integrations.oxxa.auth.password'),
        ];

        $query = array_merge($query, $arguments);

        $res = $client->get('command.php', [
            'query' => $query,
        ]);

        $xml = simplexml_load_string($res->getBody());
        $json = json_encode($xml);
        return json_decode($json, TRUE);
    }

    public static function domain(): Domain
    {
        return new Domain();
    }

    public static function cart(): Cart
    {
        return new Cart();
    }

    public static function dns_record(): DnsRecord
    {
        return new DnsRecord();
    }

    public static function fund(): Fund
    {
        return new Fund();
    }
}
