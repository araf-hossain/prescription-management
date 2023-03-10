<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class PatientLoginController extends Controller
{
  public function __construct(){
    $this->middleware('guest:patient', ['except' => ['logout']]);
  }
  public function showLoginForm(){
    return view('auth.patients-login');
  }
  public function login(){
    $data = request()->validate([
      'email' => 'required|email',
      'password' => 'required'
    ]);
    if(Auth::guard('patient')->attempt(['email' => request()->email, 'password' => request()->password], request()->remember)){

        if( Auth::guard('patient')->user()->status == '0') {
            Auth::logout();
            request()->session()->flush();
            request()->session()->regenerate();
            return redirect()->route('patients.login')->withErrors(['Your account is not active yet!']);
        }

      return redirect()->route('patients.index');
    }
    else{
      return redirect()->back()->withErrors(['Incorrect Email Or Password']);
    }
  }
  public function logout(){
    Auth::logout();
    request()->session()->flush();
    request()->session()->regenerate();
    return redirect()->route('patients.login');
  }

  public function showRegistrationForm(){
    return view('auth.patients-register');
  }

  public function register(){
    $data = request()->validate([
      'name' => 'required',
      'age' => 'required',
      'email' => 'required|regex:/(.*)@(.*)\.(.{2,})/i',
      'password' => 'required|confirmed|min:8',
      'contact' => 'digits:11',
    ]);
    $data['history_of_illness'] = request()->illnesses;
    $data['history_of_surgery'] = request()->surgeries;
    $data['password'] = Hash::make($data['password']);
    $patient = Patient::create($data);

    return redirect()->route('patients.login')->with('custommsg', 'Registration Successful')->with('classes', 'green darken-1');
  }

}
