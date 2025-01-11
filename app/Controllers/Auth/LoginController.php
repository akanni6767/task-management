<?php

namespace App\Controllers\Auth;

use App\Controllers\Api\AuthController;
use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Cookie;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;

class LoginController extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        return view("components/auth/login");
    }
    
    public function auth()
    {
        $userModel = new UsersModel();
        try {
            $rules = [
                'email'    => 'required|valid_email',
                'password' => 'required|min_length[6]',
            ];
            if (!$this->validate($rules)) {
                return $this->failValidationErrors($this->validator->getErrors());
            }
       
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            
            $user = $userModel->where('email', $email)->first();
       
            if(is_null($user)) {
                return redirect()->back()->with("message",'Invalid email or password.' );
                return $this->respond(['error' => 'Invalid email or password.'], 401);
            }
       
            $pwd_verify = password_verify($password, $user['password']);
       
            if(!$pwd_verify) {
                return redirect()->back()->with("message",'Invalid email or password.' );
                return $this->respond(['error' => 'Invalid email or password.'], 401);
            }
      
            $key = getenv('JWT_SECRET') ?? "secret";
            $iat = time();
            $exp = $iat + 3600;
      
            $payload = array(
                "sub" => $user['id'],
                "iat" => $iat,
                "exp" => $exp,
                "email" => $user['email'],
            );
              
            $token = JWT::encode($payload, $key, 'HS256');
      
            $response = [
                'message' => 'Login Succesful',
                'token' => $token
            ];

            session()->set('auth_token', $token);

            return redirect()->to('/');

        } catch (\Exception $e) {
            return $this->respond(['error' => $e->getMessage()], 500);
        }
    }
}
