<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LogModel;
use Config\Services;

class UserActionSaved implements FilterInterface
{
    protected $session;
    protected $config;
    public function __construct()
    {
        $this->session = Services::session();
        $this->config = config('Auth');
    }
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!isset($this->session->get('userData')['id'])){
            return redirect()->to(base_url('login_page/signin-1.html'));
        }

        $router = service('router');
        $controller_per = explode("\\", $router->controllerName());
        $controller_per = end($controller_per);
        $method_per = $router->methodName();

        $ip_address = $request->getIPAddress();
        $post_par['Get'] = $request->getGet();
        $post_par['Post'] = $request->getPost();
        $log = new LogModel();
        $log->save(array(
            'controller'=>$controller_per,
            'method'=>$method_per,
            'post'=>json_encode($post_par),
            'user'=>$this->session->get('userData')['id'],
            'ip'=>$ip_address
        ));


    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }


}