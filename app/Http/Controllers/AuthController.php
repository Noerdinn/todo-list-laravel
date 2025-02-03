<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
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

        //logika untuk tugas selesai atau belum
        // $completeTask = Task::where('user_id', $user->id)->where('is_complete', true)->count();
        $completeTask = $user->tasks()->where('is_complete', true)->count();
        $incompleteTasks = $user->tasks()->where('is_complete', false)->count();

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
            'password' => 'required|min:4',
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


        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = bcrypt($request->password);
        // $user->save();
        // return redirect()->route('login');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function autenticate(Request $request): RedirectResponse
    {

        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            return redirect()->route('home.page');
        } else {
            return redirect()->back()->with(
                'email',
                'Email atau password salah.',
            );
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('welcome.page');
    }
}
