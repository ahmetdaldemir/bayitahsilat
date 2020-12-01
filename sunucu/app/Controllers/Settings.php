<?php namespace App\Controllers;

use App\Models\HomeModel;
use App\Models\PosModel;

class Settings extends BaseController
{

	public function iyzico()
    {
        $data = [ 'page_title' => 'Your title' ];
        return $this->render('settings/iyzico',$data);
    }

    public function pos()
    {
        $data = [ 'page_title' => 'Your title',
        'finansbank' => $this->posData(1,'status'), 
        'garanti' => $this->posData(2,'status'), 
    ];
        return $this->render('settings/pos',$data);
    }

    public function posDetail($id)
    {
        $db = \Config\Database::connect();
         $data = [ 
             'page_title' => 'Your title',
             'id'=>$id,
             'store_number'=> $this->posData($id,'store_number'),
             'username'=>  $this->posData($id,'username'), 
             'password'=>  $this->posData($id,'password'),
             'three_d_status'=>  $this->posData($id,'three_d_status'), 
             'three_d_secure_key'=>  $this->posData($id,'three_d_secure_key'), 
             'authorization_type'=>  $this->posData($id,'authorization_type'), 
             'minimum_installment_amount'=>  $this->posData($id,'minimum_installment_amount'),
             'installment'=>  $this->posData($id,'installment'),
            ];
        return $this->render('settings/pos_detail',$data);
    }

    public function pos_add()
    {
        $data = $this->request->getPost('data');
        $db = \Config\Database::connect();
        $builder = $db->table('pos');
        $query = $db->query("select *from pos where `key` = 'id' and saasid = 1 and id_pos = ".$data["id"]." ")->getResult();
       
        if(count($query) == 0)
        {
            foreach ($data as $key => $value)
            {
                $array = [
                    'key' => $key,
                    'value' => $value,
                    'id_pos' => $data["id"],
                    'saasid' => 1,
                ];
                 $builder->set($array);
                 $builder->insert();
            }
        }else{
            foreach ($data as $key => $value)
            {
             
                 $builder->where("saasid",1)->where("key",$key)->set("value",$value);
                 $builder->update();
            }
        }
        return redirect()->to('posDetail/'.$data["id"].'');
    }

    public function posData($id,$key)
    {
         $db = \Config\Database::connect();
         $query =  $db->query("select *from pos where `key` =  '$key' AND `id_pos` = $id AND `saasid` = 1 ");
            if(count($query->getResult()) > 0)
            {
                return $query->getRow()->value;
            }else{
                return 0;
            }
    }

    public function change_pos_status($id,$status)
    {
        if($status == 1)
        {
            $change = 0;
        }else{
            $change = 1;
        }

        $db = \Config\Database::connect();
        $builder = $db->table('pos');
        $builder->set('value', $change, FALSE);
        $builder->where('key', "status");
        $builder->where('id_pos', $id);
        $builder->where('saasid', 1);
        $builder->update();
    }


}