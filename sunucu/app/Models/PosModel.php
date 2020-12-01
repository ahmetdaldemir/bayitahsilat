<?php

namespace App\Models;
use CodeIgniter\Model;

class PosModel extends Model
{

    public function getSiteSetting(array $params=[])
    {
        $db = \Config\Database::connect();
        $response =   $db->query("select *from pos where key = params['key'] and saasid = 1")->getResult();
        if(count($response) > 0)
        {
            foreach($response as $val)
            {
                return $val["value"];
            }
        }
    }
}

