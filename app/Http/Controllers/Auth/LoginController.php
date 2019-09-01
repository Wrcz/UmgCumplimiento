<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public $redirectTo = 'bienvenido';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('guest')->except('logout');
       $this->middleware('guest', ['only' => 'showLoginForm']);
    }

     // retorna a vista login
     public function showLoginForm(){

        return view('auth.login');
    }

    // funcion para inciar sesion
    public function login(){

     
        $datos  = $this->validate(request(), [
            'correoelectronico' => 'email|required|string',
            'password'=> 'required|string'
        ]);
            
        if (Auth::attempt(['correoelectronico'=> $datos['correoelectronico'] , 'password' => $datos['password'] ] )) 
        if (Auth::attempt($datos)) {

           // dd($datos);
            return   redirect('bienvenido');
        }

        // si son incorrectos devuelve un mensaje
        return back()
            ->withErrors([$this->username() =>  trans('auth.failed')])
            ->withInput(request([$this->username()]));

            //return $this->getAuthPassword();
    }

    // funcion para cerrar sesion
    public function logout(){
        // cierra sesion y devuelve al login 
        Auth::logout();
        return redirect('login');
    }


    public function username()
    {
        return 'correoelectronico';
    }

    public function getAuthPassword()
    {
        return   'password'; //$this->password;
    }

    public function getAuthIdentifier()
	{
		return $this->getKey();
	}

  

}
