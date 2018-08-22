<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function newUser( Request $request, User $user )
    {
        $data = [];

        $data['name'] = $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['email'] = $request->input('email');
        
        return view('user/form', $data);
    }
}
