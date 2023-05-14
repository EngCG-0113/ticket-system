<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $user = Auth::user();

        $token = $user->createToken('web-token')->plainTextToken;
        \Cache::put('api-token-'.$user->id,$token);
        setcookie('api-token',$token);
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    /**
     * Handle an incoming authentication request.
     */
    public function getApiToken(LoginRequest $request)
    {
        $credential = $request->all();
        
        if(Auth::attempt($credential)){
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json(['token' => $token],200);
        }else{
            return response()->json(['error' => 'Crdential Error'],500);

        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        //remove token
        $user = Auth::user();
        $user->tokens()->where('name','web-token')->delete();
        \Cache::forget('api-token-'.$user->id);
        setcookie("api-token", "", time()-3600);

        Auth::guard('web')->logout();


        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
