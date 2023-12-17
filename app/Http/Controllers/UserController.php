<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    //
    function login(Request $req)
    {
        $user= User::where(['email'=>$req->email])->first();
        // Assuming $req->password is the plain text password
        $hashedPassword = password_hash($req->password, PASSWORD_BCRYPT);

        // if(!$user || !Hash::check($req->password,$user->password))
        // if (!$user || !password_verify($req->password, $user->password)) 
        if (!$user || !password_verify($req->password, $hashedPassword))
        {
            return "Username or password is not matched";
        }
        else{
            $req->session()->put('user',$user);
            return redirect('/');
        }
    }


    function register(Request $req)
    {
        // Validate the incoming request
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user in the database
        $user = User::create([
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'password' => Hash::make($req->input('password')),
        ]);

        $req->session()->put('user',$user);

        // Redirect or perform any other action after registration
        return redirect('/');
    }



    function showRegistrationForm(){
        return view('/register');
    }

}
