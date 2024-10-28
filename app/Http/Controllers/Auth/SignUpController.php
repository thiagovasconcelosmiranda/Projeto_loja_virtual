<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helper\helper;
use Session;

class SignUpController extends Controller
{
    public function index(){
        return view('Pages/Auth/signup');
    }

    public function create(Request $request){
        $userData = $request->only('name', 'email', 'password', '_token');
        $userData['password'] = bcrypt($userData['password']);
    
        $u = new User;
        $u->name = $userData['name'];
        $u->email = $userData['email'];
        $u->password = $userData['password'];

        if($u->save()){
          return redirect()->route('buy.index');
        }else{
            return redirect()->back()->with('error','Erro ao cadastrar!');
        }
       
    }
    
  public function logout(){
        Session::flush();
        return redirect()->to('/auth/signin');
    
  }
        
}
