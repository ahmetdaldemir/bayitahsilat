<?php namespace App\Controllers;

use App\Models\HomeModel;

class Home extends BaseController
{

    public function index()
    {
        $data = [
            'page_title' => 'Your title',
            'total_payment_item' => $this->totalPaymetItem(),
            'total_seller' => $this->totalSeller(),
            'total_payment' => $this->totalPayment(),
            'today_payment' => $this->todayPayment(),
            'today_seller_process' => $this->todaySellerProcess(),
        ];
        return $this->render('index', $data);
    }

    public function seller()
    {
        $HomeModel = new HomeModel();
        $data = [
            'page_title' => 'Your title',
        ];
        return $this->render('seller', $data);
    }

    public function sellerPaymentList()
    {
        $HomeModel = new HomeModel();
        $data = [
            'page_title' => 'Your title',
        ];
        return $this->render('seller_payment_list', $data);
    }


    //--------------------------------------------------------------------


    public function get_log()
    {
        $db = \Config\Database::connect();
        $query = $db->query('select *from log order by id desc limit 10')->getResult();
        echo json_encode($query);
    }

    public function selleradd()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('seller');
        $query = $db->query('select *from seller where email = ' . $this->request->getPost('email') . ' ')->getResult();
        if (count($query) == 0) {
            try {
                $data = [
                    'firstname' => $this->request->getPost('firstname'),
                    'lastname' => $this->request->getPost('lastname'),
                    'email' => $this->request->getPost('email'),
                    'password' => md5($this->request->getPost('password')),
                    'company' => $this->request->getPost('company'),
                    'address' => $this->request->getPost('address'),
                    'taxNumber' => $this->request->getPost('taxNumber'),
                    'taxOffice' => $this->request->getPost('taxOffice'),
                    'saasid' => 1,
                    'add_user' => 1,
                ];
                if($this->request->getPost('id') == "")
                {
                    $builder->set($data);
                    $builder->insert();
                }else{
                    $builder->where("id",$this->request->getPost('id'));
                    $builder->set($data);
                    $builder->update();
                }
            } catch (\Exception $e) {
                print_r($e->getMessage());
            }


            $this->session->setFlashdata('messages', 'Üyeliğiniz Yapılmıştır.Üye girişi yapabilirsiniz.');
        } else {
            $this->session->setFlashdata('messages', 'Üyeliğiniz mevcuttur. Şifre sıfırlama işlemi yapabilirsiniz.');
        }
       return redirect()->to('seller');
    }

    public function sellerdelete($id)
    {
        $HomeModel = new HomeModel();
        $HomeModel->where('id', $id)->delete();
        return redirect()->to('seller');
    }

    public function edit_seller($id)
    {
        $db = \Config\Database::connect();
        $query = $db->query('select *from seller where id = ' . $id . ' ')->getResult();
        echo json_encode($query);
    }

    public function get_seller_balance($id)
    {
        $db = \Config\Database::connect();
        $query = $db->query('select *from seller_balance where id_seller = ' . $id . ' ')->getResult();
        echo json_encode($query);
    }

    public function add_seller_balance()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('seller_balance');

        $data = [
            'id_seller' => $this->request->getPost('id'),
            'voucher' => $this->request->getPost('voucher'),
            'price' => $this->request->getPost('price'),
        ];
        $builder->set($data);
        $builder->insert();
        return redirect()->to('seller');

    }

    public function delete_seller_balance($id, $id_seller)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('seller_balance');
        $builder->where("id", $id);
        $builder->delete();

        $query = $db->query('select *from seller_balance where id_seller = ' . $id_seller . ' ')->getResult();
        echo json_encode($query);
    }

    public function get_seller()
    {
        $HomeModel = new HomeModel();
        $query = $HomeModel->where("saasid","1")->findAll();
        echo json_encode($query);
    }

    public function get_total_balance($id_seller)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('seller_balance');
        $query = $db->query('select *from SUM(price) as total seller_balance where id_seller = ' . $id_seller . ' ')->getRow()->total;
        echo json_encode($query);
    }

    //***------- Dashboard Data -----****//

    public function totalPaymetItem()
    {
        $db = \Config\Database::connect();
        $query = $db->query("select *from seller_payment where type='income' ");
        return count($query->getResult());
    }

    public function totalSeller()
    {
        $db = \Config\Database::connect();
        $query = $db->query("select *from seller");
        return count($query->getResult());
    }

    public function totalPayment()
    {
        $db = \Config\Database::connect();
        $query = $db->query("select SUM(amount) as total_payment from seller_payment where type = 'income' and paymentStatus = '00' ");
        if($query->getRow()->total_payment > 0){
            return $query->getRow()->total_payment;
        }else{
            return 0;
        }
    }

    public function todayPayment()
    {
        $db = \Config\Database::connect();
        $query = $db->query("select SUM(amount) as total_payment from seller_payment where type='income' and date_add = CURDATE() ");
        if($query->getRow()->total_payment > 0){
            return $query->getRow()->total_payment;
        }else{
            return 0;
        }
    }

    public function todaySellerProcess()
    {
        $db = \Config\Database::connect();
        $query = $db->query("select *from seller_payment ")->getResult();
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
        return $data;
    }

    public function getSeller($id)
    {
        $db = \Config\Database::connect();
        $query = $db->query("select *from seller where id = ".$id." ");
        return $query->getRow()->firstname." ".$query->getRow()->lastname;
    }




}
