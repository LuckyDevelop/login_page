<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function signIn() {
        return view('sign-in');
    }

    public function register(Request $request) {
        DB::beginTransaction();
        try {
            User::create([
                'name' => explode('@',request('email'))[0],
                'email' => request('email'),
                'password' => bcrypt(request('password')),
            ]);

            DB::commit();
            $message = 'Akun Berhasil didaftarkan!';
            return redirect()->route('login')->with('success', $message);
        } catch(Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return redirect()->route('login')->with('error', $message);
        }
    }
}
