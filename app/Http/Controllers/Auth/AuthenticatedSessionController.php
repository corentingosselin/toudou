<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $password = $request->password;
        $username = $request->username; //the input field has name='username' in form
        if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
            //user sent their email 
            Auth::attempt(['email' => $username, 'password' => $password]);
        } else {
            //they sent their username instead 
            Auth::attempt(['username' => $username, 'password' => $password]);
        }
        
        //was any of those correct ?
        if ( Auth::check() ) {
            //send them where they are going 
            return redirect()->intended('home');
        }
        
        //Nope, something wrong during authentication 
        throw ValidationException::withMessages([
            'credentials' => [trans('auth.failed')],
        ]);
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
