<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
  
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;
  
  
class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) { 
            return redirect()->route('home');
        }
        return view('pages.login');
    }
  
    public function login(Request $request)
    {
        $rules = [
            'username'              => 'required',
            'password'              => 'required|string'
        ];
  
        $messages = [
            'username.required'     => 'username wajib diisi',
            'password.required'     => 'Password wajib diisi'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
  
        $data = [
            'username'      => $request->input('username'),
            'password'      => $request->input('password'),
        ];
  
        Auth::attempt($data);
  
        if (Auth::check()) {
            if(Auth::user()->adminDetail) {
                return redirect()->route('dashboard');
            }else {
                return redirect()->route('home');
            }
        } else {
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('login');
    }
  
}
