<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Flash-message when user has log in and redicrect
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('user.index')
            ->with('success', 'Вы успешно вошли в личный кабинет');
    }

    /**
     * Flash-message when user has log out and redicrect
     */
    protected function loggedOut($user)
    {
        // return redirect()->route('user.login')->with('success', 'Вы успешно вышли из личного кабинета');
        $route = 'user.index';
        $message = 'Вы успешно вошли в личный кабинет';
        if ($user->admin) {
            $route = 'admin.index';
            $message = 'Вы успешно вошли в панель управления';
        }
        return redirect()->route($route)->with('success', $message);
    }
}
