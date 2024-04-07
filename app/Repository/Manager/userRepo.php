<?php

namespace App\Repository\Manager ;
use App\Models\User;
use App\Service\Token;
use Illuminate\Support\Facades\Hash;

class userRepo
{
    private $query ;
    public function __construct(){$this->query = User::query() ; }

    public function index()
    {
        return $this->query->orderByDesc('created_at')->paginate();
    }

    public function registerUser($data)
    {
        $user = $this->create($data);
        return  Token::generate($user);
    }

    public function create($data)
    {
        return  User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id);
    }

    public function update($data , $id )
    {
        $userId = $this->getFindId($id);
        return $this->query->where('id' , $id)->update([
            'name' => $data['name'] ?? $userId->name,
            'email' => $data['email'] ?? $userId->email,
            'password' => Hash::make($data['password']
                ?? $userId->email ),
        ]);
    }

    public function delete($id)
    {
        return $this->query->where('id' , $id)->delete();
    }

    public function status($id , $status )
    {
        $userId = $this->getFindId($id);
        return $this->query->where('id' , $id)->update([
           'status' => $status
        ]);
    }

    public function userLogin($data)
    {
        $user = $this->query->where('email' , $data['email'])->first();
        $password = $this->checkPassword($data['password'] , $user->password) ;
        if($password === false) return false ;
        return Token::generate($user);
    }

    private function checkPassword($password ,  $user)
    {
            return Hash::check($password , $user);
    }

    public function getFindEmail($email)
    {
        return $this->query->where('email' , $email)->first();
    }
}
