<?php

namespace BuddieDJ\Oxxa\Functions;

use BuddieDJ\Oxxa\Oxxa;
use Illuminate\Support\Facades\Date;

class Fund extends Oxxa
{
    public function get()
    {
        return $this->call([
            "command" => "funds_get",
        ]);
    }

    public function list(Date $begin = null, Date $end = null, array $args = [])
    {
        $query = [
            "command" => "funds_list",
            "begin" => $begin,
            "end" => $end,
        ];

        $query = array_merge($query, $args);

        return $this->call($query);
    }
}
