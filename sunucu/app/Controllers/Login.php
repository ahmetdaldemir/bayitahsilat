<?php namespace App\Controllers;

header('Access-Control-Allow-Origin: *');

use App\Models\LoginModel;

class Login extends BaseController
{

    public function index()
    {
        if ($this->session->get("login")["isLoggedIn"] == 1){
            return redirect()->to(base_url("home"));
        }else{
            $data["login"] = $this->session->get("login");
            return view('login',$data);
        }
    }

    public function process()
    {
        $LoginModel = new LoginModel();
        $query = $LoginModel->where('email', $this->request->getPost('email'))->where('password', md5($this->request->getPost('password')))->findAll();
        if (count($query) == 1) {
            $db = \Config\Database::connect();
            $builder = $db->table('log');
            $data = [ 'message' => $query[0]["email"]." Eposta adresli kullanıcı giriş yaptı", ];
            $builder->set($data);
            $builder->insert();

                 $data = array(
                    'firstname' => $query[0]["firstname"],
                    'lastname' => $query[0]["lastname"],
                    'email' => $query[0]["email"],
                    'isLoggedIn' => TRUE
                 );
                $this->session->set("login",$data);
                return redirect()->to(base_url('home'));
        }else{

            $db = \Config\Database::connect();
            $builder = $db->table('log');
            $data = [ 'message' => $this->request->getPost('email')." Eposta adresli kullanıcı başarısız giriş yaptı", ];
            $builder->set($data);
            $builder->insert();

            return redirect()->to('index');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to("index");
    }

    public function seller_process()
    {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $db = \Config\Database::connect();
        $builder = $db->table('log');
        $query = $db->query("select *from seller where email = '".$request->email."' and password = '".md5($request->password)."' ");
        
         if (count($query->getResult()) == 1) {

             $data = [ 'message' => $query->getRow()->id." Nolu Bayi Başarılı Giriş Yaptı", ];
             $builder->set($data);
             $builder->insert();

            $data = array(
                'firstname' => $query->getRow()->firstname,
                'lastname' => $query->getRow()->lastname,
                'email' => $query->getRow()->email,
                'id' => $query->getRow()->id,
                'isLoggedIn' => TRUE
            );
            echo json_encode($data);
        }else{

             $data = [ 'message' => $request->email." Eposta adresli bayi hatalı giriş yaptı", ];
             $builder->set($data);
             $builder->insert();

            echo 0;
        }
    }



}

