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
            // session()->flash('success', 'success');
            // session()->flash('title', 'Berhasil');
            // session()->flash('message', 'Selamat Datang Kembali');
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
  
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('home');
  
        } else { // false
  
            //Login Fail
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }
  
    }

  
    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
  
  
}
