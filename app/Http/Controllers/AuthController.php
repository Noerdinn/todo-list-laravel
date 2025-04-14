<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // halaman home
    public function showHome()
    {
        date_default_timezone_set('Asia/Jakarta');
        $hour = date('H'); //ngambil jam, format 24j
        $greeting = '';

        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Good Morning';
        } elseif ($hour >= 12 && $hour < 17) {
            $greeting = 'Good Afternoon';
        } elseif ($hour >= 17 && $hour < 21) {
            $greeting = 'Good Evening';
        } else {
            $greeting = 'Good Night';
        }

        $user = Auth::user();

        //logika untuk menghitung tugas yang sudah selesai
        $completeTask = $user->tasks()->where('is_complete', true)->count();
        // logika untuk menghitung total jumlah task
        $incompleteTasks = $user->tasks()->count();

        $date = date('l, d F Y'); // Format tanggal: Senin, 01 Januari 2025

        return view('home', compact('user', 'greeting', 'date', 'completeTask', 'incompleteTasks'));
    }
    public function showRegistration()
    {
        return view('registration');
    }
    public function submitRegistration(Request $request)
    {
        // validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);
        // jika tidak valid tampilkan error
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat.');
    }
    public function showLogin()
    {
        return view('login');
    }
    // validasi login
    public function autenticate(Request $request): RedirectResponse
    {

        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('home.page')->with('success', 'Berhasil login!');
        }

        // jika tidak ada
        $userExist = User::where('email', $request->email)->exists();

        return back()->withInput()->with([
            $userExist ? 'password' : 'email' => $userExist
                ? 'Password yang anda masukkan salah.'
                : 'Email yang anda masukkan salah.'
        ]);
    }
    // untuk logout
    function logout()
    {
        Auth::logout();
        return redirect()->route('welcome.page');
    }
}
