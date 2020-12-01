<?php namespace App\Controllers;


class Seller extends BaseController
{

    public function get_filter()
    {
        $sql = "select *from seller_payment where  1 = 1 ";
        $id_seller = $this->request->getPost("id_seller");
        $date1 = $this->request->getPost("date1");
        $date2 = $this->request->getPost("date2");

        if($id_seller != "")
        {
          $sql .= "and id_seller = ".$id_seller."";
        }

        if($id_seller == "" && $date1 != "")
        {
            $sql .= "and date_add  => ".$date1."";
        }

        if($id_seller == "" && $date1 != "" && $date2 != "")
        {
            $sql .= "and date_add BETWEEN ".$date1."  AND ".$date2."";
        }

        if($id_seller != "" && $date1 != "" && $date2 == "")
        {
            $sql .= "and and id_seller = ".$id_seller." and  date_add  => ".$date1."";
        }

        if($id_seller != "" && $date1 == "" && $date2 != "")
        {
            $sql .= "and  id_seller = ".$id_seller." and  date_add  =< ".$date2."";
        }

        if($id_seller == "" && $date1 == "" && $date2 != "")
        {
            $sql .= "and  date_add  =< ".$date2."";
        }

        if($id_seller != "" && $date1 != "" && $date2 != "")
        {
            $sql .= "and and id_seller = ".$id_seller." and  date_add BETWEEN ".$date1."  AND ".$date2."";
        }

        $db = \Config\Database::connect();
        $query = $db->query($sql)->getResult();
        foreach ($query as $val)
        {
            $data[]  =array(
                'id' =>  $val->id,
                'seller' =>  $this->getSeller($val->id_seller),
                'id_order' =>  $val->id_order,
                'amount' =>  $val->amount,
                'date_add' =>  date("d-m-Y",strtotime($val->date_add)),
                'status' =>  $val->status,
                'card_mask' =>  $val->card_mask,
            );
        }
        echo json_encode($data);
    }

    public function get_all_filter()
    {
        $db = \Config\Database::connect();
        $query = $db->query('select *from seller_payment order by id desc')->getResult();
        foreach ($query as $val)
        {
            $data[]  = array(
                'seller' =>  $this->getSeller($val->id_seller),
                'amount' =>  $val->amount,
                'id_order' =>  $val->id_order,
                'id' =>  $val->id,
                'date_add' =>  date("d-m-Y",strtotime($val->date_add)),
                'status' =>  $val->status,
                'card_mask' =>  $val->card_mask,
            );
        }
        echo json_encode($data);
    }

    public function getSeller($id)
    {
        $db = \Config\Database::connect();
        $query = $db->query("select *from seller where id = ".$id." ");
        return $query->getRow()->firstname." ".$query->getRow()->lastname;
    }

    public function add_refund()
    {
        $db = \Config\Database::connect();
        $query = $db->query("select *from seller_payment where id = ".$this->request->getPost("id")." ");
        $data  =  [
            'amount' => $this->request->getPost("amount"),
            'type' => "expense",
            'status' => "İade",
            'id_seller' => $query->getRow()->id_seller,
            'id_order' => $this->request->getPost("code"),
            'card_number' => $query->getRow()->card_number,
         ];

        $builder = $db->table('seller_payment');
         $builder->set($data);
        $builder->insert();

        $builder = $db->table('log');
        $data = [ 'message' => $this->request->getPost("id")." id'li ödeme için iade işlemi yapıldı", ];
        $builder->set($data);
        $builder->insert();
    }





}