<?php
namespace Auth\Controllers;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use Auth\Models\UserModel;
use Auth\Models\userBlockModel;

class LoginController extends Controller
{
	/**
	 * Access to current session.
	 *
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

	/**
	 * Authentication settings.
	 */
	protected $config;


    //--------------------------------------------------------------------

	public function __construct()
	{
		// start session
		$this->session = Services::session();

		// load auth settings
		$this->config = config('Auth');
	}

    //--------------------------------------------------------------------

	/**
	 * Displays login form or redirects if user is already logged in.
	 */
	public function login()
	{
		if ($this->session->isLoggedIn) {
			return redirect()->to(base_url());
		}

		return view($this->config->views['login'], ['config' => $this->config]);
	}

    //--------------------------------------------------------------------

	/**
	 * Attempts to verify user's credentials through POST request.
	 */
	public function attemptLogin()
	{
		try {
			$db = \Config\Database::connect();
			
			// Get detailed connection info
			$dbConfig = config('Database');
			$encryptConfig = $dbConfig->default['encrypt'] ?? 'not set';
			
			echo "SSL Config: ";
			var_dump($encryptConfig);
			echo "<br><br>";
			
			// Try to connect and get detailed error info
			$db->connect(); // محاولة اتصال
	
			if ($db->connID) {
				echo "Database Connected ✔️<br>";
				echo "Connection ID: " . ($db->connID ? 'Yes' : 'No') . "<br>";
			} else {
				echo "Database NOT Connected ❌<br>";
				
				// Get detailed error information
				$error = $db->error();
				if ($error) {
					echo "Error Code: " . ($error['code'] ?? 'N/A') . "<br>";
					echo "Error Message: " . ($error['message'] ?? 'No error message') . "<br>";
				}
				
				// Try to get mysqli error if available
				if (method_exists($db, 'mysqli') && $db->mysqli()) {
					$mysqli = $db->mysqli();
					if ($mysqli && $mysqli->connect_error) {
						echo "MySQLi Error: " . $mysqli->connect_error . "<br>";
						echo "MySQLi Error No: " . $mysqli->connect_errno . "<br>";
					}
				}
			}
	
		} catch (\Exception $e) {
			echo "Exception: " . $e->getMessage() . "<br>";
			echo "Error Code: " . $e->getCode() . "<br>";
			echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "<br>";
			if ($e->getPrevious()) {
				echo "Previous: " . $e->getPrevious()->getMessage() . "<br>";
			}
			echo "Stack Trace: <pre>" . $e->getTraceAsString() . "</pre>";
		}
        
		exit;

// 		$host = 'db-mysql-sfo3-22518-do-user-28239552-0.f.db.ondigitalocean.com';
// 		$user = 'doadmin';
// 		$pass = 'AVNS_grgEur-BkgLiRlRqB7O';
// 		$db   = 'defaultdb';
// 		$port = 25060;

// 		$mysqli = new \mysqli($host, $user, $pass, $db, $port);

// 		if ($mysqli->connect_error) {
// 			echo "Connect Error ({$mysqli->connect_errno}): {$mysqli->connect_error}";
// 		} else {
// 			echo "Connected OK - server_info: " . $mysqli->server_info;
// 		}
// //
// 		exit;
		// validate request
		$rules = [
			'email'		=> 'required|valid_email',
			'password' 	=> 'required|min_length[5]',
		];

		if (! $this->validate($rules)) {
			return redirect()->to('login')
				->withInput()
				->with('errors', $this->validator->getErrors());
		}

		// check credentials
		$users = new UserModel();
		$user = $users->where('email', $this->request->getPost('email'))->first();
		if (
			is_null($user) ||
			! password_verify($this->request->getPost('password'), $user['password_hash'])
		) {
			return redirect()->to('login')->withInput()->with('error', lang('Auth.wrongCredentials'));
		}

		// check activation
		if (!$user['active']) {
			return redirect()->to('login')->withInput()->with('error', lang('Auth.notActivated'));
		}

		$user_block = new userBlockModel();
		$block = $user_block->where('user_id',$user['id'])->findAll();
        $block_data = array();
        foreach ($block as $item) {
            $block_data[] = $item['block_id'];
		}
        // login OK, save user data to session
		$this->session->set('isLoggedIn', true);
		$this->session->set('userData', [
		    'id' 			=> $user['id'],
		    'name' 			=> $user['name'],
		    'email' 		=> $user['email'],
		    'new_email' 	=> $user['new_email'],
		    'permissions' 	=> $user['permissions'],
		    'block_id' 	=> $block_data
		]);

        return redirect()->to(base_url());
	}

    //--------------------------------------------------------------------

	/**
	 * Log the user out.
	 */
	public function logout()
	{
		$this->session->remove(['isLoggedIn', 'userData']);

		return redirect()->to('login');
	}

}
