<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class AuthController extends BaseController
{
    use ResponseTrait;
    public function index()
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
                return $this->respond(['error' => 'Invalid email or password.'], 401);
            }
       
            $pwd_verify = password_verify($password, $user['password']);
       
            if(!$pwd_verify) {
                return $this->respond(['error' => 'Invalid email or password.'], 401);
            }
      
            $key = getenv('JWT_SECRET') ?? "secret";
            if($key == null || $key == "") {
                $key = "secret";
            }
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
              
            return $this->respond($response, 200);
        } catch (\Exception $e) {
            return $this->respond(['error' => $e->getMessage()], 500);
        }
    }

    public function Check()
    {
        $key = getenv('JWT_SECRET') ?? "secret";
        if($key == null || $key == "") {
            $key = "secret";
        }
        $token = session()->get('auth_token');

        $userModel = new UsersModel();
        
        try {
            $data = [];
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            if(!empty($decoded)) {
                $data = $userModel->select("id,email,username")->where("email", $decoded->email)->asObject()->first();
            }
            return $data;
        } catch (\Exception $ex) {

        }
    }
}
