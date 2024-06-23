<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User_loginController extends Controller
{
    public function showUsers_login() {
        return view('users_login');
    }
    
}
