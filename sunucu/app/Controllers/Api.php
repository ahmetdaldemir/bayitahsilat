<?php namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
use App\Models\PaymentModel;

class Api extends BaseController
{

    public function getProfil($id)
    {
        $db = \Config\Database::connect();
        $query = $db->query('select *from seller where id = ' . $id . ' ')->getResult();
        echo json_encode($query);
    }

    public function getHistory($id)
    {

        $db = \Config\Database::connect();
        $query = $db->query('select *from seller_payment where id_seller = ' . $id . ' ')->getResult();
        echo json_encode($query);
    }

    public function updateSeller()
    {
         $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $db = \Config\Database::connect();
        $builder = $db->table('seller');
        if($request->password == "")
        {
            $password = $request->passwordold;
        }else{
            $password = md5($request->password);
        }
        $data = [
            'firstname' => $request->firstname,
            'lastname' =>  $request->lastname,
            'email' =>  $request->email,
            'password' => $password,
            'company' => $request->company,
            'address' =>  $request->address,
            'taxNumber' =>  $request->taxNumber,
            'taxOffice' =>  $request->taxOffice,
            'saasid' => 1,
            'add_user' => 1,
        ];
        $builder->where("id", $request->id);
        $builder->set($data);
        $builder->update();
    }


    public function getBin($bin)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($ch);
        curl_close($ch);
        $arr = json_decode($curl_response,true);
        echo json_encode($arr["bank"]["name"]);
    }

    public function getPaymentDetail($id)
    {
        $db = \Config\Database::connect();
        $query = $db->query('select *from seller_payment where id_order = ' . $id . ' ')->getResult();
        echo json_encode($query);
    }

}