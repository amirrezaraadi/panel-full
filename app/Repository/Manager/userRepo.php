<?php

namespace App\Repository ;
use App\Models\User;
use App\Service\Token;
use Illuminate\Support\Facades\Hash;

class userRepo
{
    private $query ;
    public function __construct(){$this->query = User::query() ; }

    public function index()
    {

    }

    public function registerUser($data)
    {
        $user = $this->create($data);
        return  Token::generate($user);
    }

    public function create($data)
    {
        return  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function getFindId($id)
    {

    }

    public function show($id)
    {

    }

    public function update($data , $id )
    {

    }

    public function delete($id)
    {

    }

    public function status($id , $status )
    {

    }


}
