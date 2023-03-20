<?php

namespace BuddieDJ\Oxxa;

use GuzzleHttp\Client;

class Oxxa
{
    public static function call(array $arguments)
    {
        $client = new Client([
            'base_uri' => "",
            'timeout'  => 10.0,
        ]);

        $query = [
            'apiuser' => config('oxxa.auth.username'),
            'apipassword' => config('oxxa.auth.password'),
        ];

        $query = array_merge($query, $arguments);

        $res = $client->get('command.php', [
            'query' => $query,
        ]);

        $xml = simplexml_load_string($res->getBody());
        $json = json_encode($xml);
        return json_decode($json, TRUE);
    }

    public static function domain_check($sld, $tld)
    {
        $order = self::call([
            "command" => "domain_check",
            "sld" => $sld,
            "tld" => $tld
        ]);

        return $order['order'];
    }
}
