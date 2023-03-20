<?php

namespace BuddieDJ\Oxxa\Functions;

use BuddieDJ\Oxxa\Exceptions\OxxaApiException;
use BuddieDJ\Oxxa\Oxxa;

class DnsRecord extends Oxxa
{
    /**
     * @throws OxxaApiException
     */
    public function add(string $sld, string $tld, string $value, string $type, string $data, string $priority = null)
    {
        if (!in_array($type, ["MX", "A", "AAAA", "CNAME", "TXT"])) {
            throw new OxxaApiException("The selected record type is not valid, choose from MX, A, AAAA, CNAME or TXT");
        }

        return $this->call([
            "command" => "dnsrecord_add",
            "sld" => $sld,
            "tld" => $tld,
            "value" => $value,
            "type" => $type,
            "data" => $data,
            "priority" => $priority
        ]);
    }

    /**
     * @throws OxxaApiException
     */
    public function delete(string $sld, string $tld, string $value, string $type, string $data, string $ttl, string $priority = null)
    {
        if (!in_array($type, ["MX", "A", "AAAA", "CNAME", "TXT"])) {
            throw new OxxaApiException("The selected record type is not valid, choose from MX, A, AAAA, CNAME or TXT");
        }

        return $this->call([
            "command" => "dnsrecord_del",
            "sld" => $sld,
            "tld" => $tld,
            "value" => $value,
            "type" => $type,
            "data" => $data,
            "ttl" => $ttl,
            "priority" => $priority
        ]);
    }

    public function list(string $sld, string $tld, int $start = 0, int $records = null, array $args = [])
    {
        $query = [
            "command" => "dnsrecord_list",
            "sld" => $sld,
            "tld" => $tld,
            "start" => $start,
            "records" => $records
        ];

        $query = array_merge($query, $args);

        return $this->call($query);
    }
}
