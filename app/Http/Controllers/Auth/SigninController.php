<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SigninController extends Controller
{
    public function index(){
        return view('Pages/Auth/signin');
    }

    public function find(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']

        ]);

        if(Auth::attempt($credentials)){
            return redirect()->route('sales');
        }else{
            return redirect()->back()->with('error','Erro ao logar');
        } 
    }
}
