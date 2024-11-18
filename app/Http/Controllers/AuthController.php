<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan ini untuk mengakses model User
use Illuminate\Support\Facades\Auth; // Untuk autentikasi
use Illuminate\Support\Facades\Hash; // Untuk hashing password
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,owner,admin',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        return redirect()->route('mainpage'); // Atur rute sesuai kebutuhan setelah login
    }

        // Menampilkan form login
        public function showLoginForm()
        {
            return view('auth.login');
        }
    
        // Proses login
        public function login(Request $request)
        {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
    
            if (Auth::attempt($request->only('email', 'password'))) {
                $request->session()->regenerate();
                return redirect()->route('mainpage'); // Sesuaikan rute setelah login berhasil
            }

            
    
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        }

            // Proses logout
            public function logout(Request $request)
            {
                Auth::logout();
            
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            
                return redirect()->route('login');
            }
           
}

