<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            //Redirect ke halaman dashboard
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user); // Set Session Aplikasi

            // Simpan pesan ke session
            session(['last_login' => now()]);

            //Panggil data warga
            // $warga = Warga::findOrFail(['user_id'=>$user->id]);

            // session(['rt' => $warga->rt]);
            // session(['rw' => $warga->rw]);
            // session(['warga_id' => $warga->warga_id]);


            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        } else {
            return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
        }
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();     // Hapus semua session
        $request->session()->regenerateToken(); // Cegah CSRF

        // Redirect ke halaman login
        return redirect()->route("auth");
    }
}
