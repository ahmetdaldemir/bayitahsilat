<?php namespace App\Controllers;

use App\Models\HomeModel;

class User extends BaseController
{

	public function index()
    {
        $data = [
            'page_title' => 'Your title'
        ];
        return $this->render('user/index',$data);
    }

	public function get_user()
    {
        $db = \Config\Database::connect();
        $query = $db->query('select *from users')->getResult();
        echo json_encode($query);
    }

    
	public function add_user()
    {
        $email = $this->request->getPost('email');
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $query = $db->query("select *from users where email = ".$email." ")->getResult();
       
        if(count($query) == 0)
        {

            $array = [
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'password' => md5($this->request->getPost('password')),
                'status' => 1,
                'saasid' => 1
            ];
             $builder->set($array);
             $builder->insert();
        }else{
            $this->session->setTempdata('user', 'Eposta adresi daha önce kayıtedilmiştir.',300);
        }
        return redirect()->to('index');
    }
    

    public function user_change_status($id,$status)
    {
        if($status == 1)
        {
            $change = 0;
        }else{
            $change = 1;
        }

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->set('status', $change, FALSE);
        $builder->where('id', $id);
        $builder->where('saasid', 1);
        $builder->update();
    }


    public function getProfil($id)
    {
        $db = \Config\Database::connect();
        $query = $db->query('select *from seller where id = ' . $id . ' ')->getResult();
        echo json_encode($query);
    }
}