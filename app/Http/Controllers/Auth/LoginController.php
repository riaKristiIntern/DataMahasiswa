<?php

// namespace App\Http\Controllers\Auth;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

// class LoginController extends Controller
// {

//     public function index()
//     {
//         return view('auth.login');
//     }

//     public function login_process(Request $request)
//     {
//         // Validasi input
//         $request->validate([
//             'email' => 'required|string',
//             'password' => 'required|string',
//         ], [
//             'email.required' => 'Email tidak boleh kosong',
//             'password.required' => 'Password tidak boleh kosong',
//         ]);

//         $user = User::where('email', $request->input('email'))->first();

//         if ($user && $user->password === $request->input('password')) {
//             Auth::login($user);
//             dd(Auth::user());
//             switch ($user->role) {
//                 case 'kaprodi':
//                     return redirect()->route('dashboard');
//                 case 'dosen wali':
//                     return redirect()->route('dashboard');
//                 case 'dosen':
//                     return redirect()->route('dashboard');
//                 case 'mahasiswa':
//                     return redirect()->route('dashboard');
//                 default:
//                     return redirect()->route('login')->withErrors('Role tidak dikenali');
//             }
//         } else {
//             return redirect()->route('login')->withErrors('Email atau password salah')->withInput();
//         }
//     }

//     public function logout(Request $request)
//     {
//         Log::info('User logged out: ' . Auth::user()->email); // Pastikan log ini muncul

//         Auth::logout();
//         return redirect()->route('login');
//     }
// }

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_process(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        // Proses autentikasi
        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            $user = Auth::user();
            switch ($user->role) {
                case 'kaprodi':
                case 'dosen wali':
                case 'dosen':
                case 'mahasiswa':
                    return redirect()->route('dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors('Role tidak dikenali');
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Log aktivitas logout
        Log::info('User logged out: ' . Auth::user()->email);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
