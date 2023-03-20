<?php

namespace App\Integrations\Functions;

use App\Integrations\Exceptions\OxxaApiException;
use App\Integrations\Oxxa;

class Domain extends Oxxa
{
    public function check(string $sld, string $tld)
    {
        return $this->call([
            "command" => "domain_check",
            "sld" => $sld,
            "tld" => $tld
        ]);
    }

    public function delete($sld, $tld)
    {
        return $this->call([
            "command" => "domain_del",
            "sld" => $sld,
            "tld" => $tld
        ]);
    }

    public function list(int $start = 0, int $records = null, array $args = [])
    {
        $query = [
            "command" => "domain_list",
            "start" => $start,
            "records" => $records
        ];

        $query = array_merge($query, $args);

        return $this->call($query);
    }

    public function epp($sld, $tld)
    {
        return $this->call([
            "command" => "domain_epp",
            "sld" => $sld,
            "tld" => $tld
        ]);
    }

    public function info($sld, $tld)
    {
        return $this->call([
            "command" => "domain_inf",
            "sld" => $sld,
            "tld" => $tld
        ]);
    }

    public function ns_upd(string $sld, string $tld, array $args = [])
    {
        $query = [
            "command" => "domain_ns_upd",
            "sld" => $sld,
            "tld" => $tld,
        ];

        $query = array_merge($query, $args);

        return $this->call($query);
    }

    public function push(string $sld, string $tld, string $username)
    {
        return $this->call([
            "command" => "domain_push",
            "sld" => $sld,
            "tld" => $tld,
            "username" => $username,
        ]);
    }

    public function restore(string $sld, string $tld)
    {
        return $this->call([
            "command" => "domain_push",
            "sld" => $sld,
            "tld" => $tld,
        ]);
    }

    /**
     * @throws OxxaApiException
     */
    public function upd(string $sld, string $tld, string $epp = null, array $args = [])
    {
        if($tld == "be" && !$epp) {
            throw new OxxaApiException("Verifying a .BE domain requires an EPP code");
        }

        $query = [
            "command" => "domain_upd",
            "sld" => $sld,
            "tld" => $tld
        ];

        $query = array_merge($query, $args);

        return $this->call($query);
    }
}
