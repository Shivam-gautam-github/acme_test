<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('manager')->attempt($credentials)) {
            return redirect()->intended('manager/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function index()
    {
        return view('manager.dashboard');
    }
}

