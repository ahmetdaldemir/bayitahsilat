<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		 $this->session = \Config\Services::session();
         $request = \Config\Services::request();
    }

    function render(string $name, array $data = [], array $options = [])
    {
        $this->sessionControl();
        $authInfo["is_login"] = $this->sessionControlAuth("isLoggedIn");
        $authInfo["firstname"] = $this->sessionControlAuth("firstname");
        $authInfo["lastname"] = $this->sessionControlAuth("lastname");
        $data["flashdata"] = $this->sessionGetFlashdata();
        
        return view(
            'welcome_message',
            [
                'header'=>view("shared/header"),
                'content' => view($name, $data, $options),
                'footer' => view("shared/footer"),
            ],
            $options
        );
    }

    protected  function sessionControl()
     {
        $this->session = \Config\Services::session();
        if ($this->session->get("login")["isLoggedIn"] != 1){
            return redirect()->to(base_url("login"));
        }
     }
    

    function sessionControlAuth($data)
    {
        return $this->session->get("login")[$data];
    }


    function sessionGetFlashdata()
    {
        return $this->session->getTempdata("user");
    }

 }
