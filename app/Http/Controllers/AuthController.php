<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function authenticate(Request $request)
	{
		$credentials = $request->validate([
			'email' => ['required', 'email'],
			'password' => ['required'],
		]);

		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();
			// return redirect()->intended('dashboard');
			
			return Response([
				'message' => 'Successful login!'
			], 200);
		}

		return Response([
			'message' => 'The provided credentials do not match our records.'
		], 401);
	}

	public function deauthenticate(Request $request)
	{
		Auth::guard('web')->logout();
		
		return Response([
			'message' => 'Successful logout!'
		], 200);
	}
}
