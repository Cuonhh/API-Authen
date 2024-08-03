<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class AuthenController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /**
             * @var User $user
             */
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended('member.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function handleLoginApi(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
    
        // Thực hiện xác thực
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $request->session()->put('user', $user);
            return response()->json([
                'message' => 'Dang nhap thanh cong',
                'user' => $user,
            ], 200);
        }
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function handleRegister(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('member.dashboard');
    }

    public function handleRegisterApi(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return response()->json(['message' => 'Dang ky thanh cong'], 201);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function logoutApi(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
