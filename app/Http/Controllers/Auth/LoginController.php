<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request; // Aggiungi questa riga in cima al file


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }


        /**
     * Handle an authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {

        if($user) {

            // var_dump($user);

            // die();

            $token = $user->createToken('api-token')->plainTextToken;
        
            // if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Login successful',
                    'api_token' => $token,
                    'user' => $user,
                ]);
            // }
        } else {

            // Se il login fallisce, restituisci una risposta di errore
            return response()->json([
                'message' => 'Invalid credentials.',
            ], 401); // 401 per indicare una richiesta non autorizzata

        }
    
        // return redirect()->intended($this->redirectPath());
    }
}
