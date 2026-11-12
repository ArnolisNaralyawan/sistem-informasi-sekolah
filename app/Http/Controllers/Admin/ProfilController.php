<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ProfilController extends Controller
{
    /**
     * Halaman profil admin (fokus: ganti password).
     */
    public function edit()
    {
        return view('admin.profil.index');
    }

    /**
     * Ganti password admin — verifikasi password saat ini terlebih dahulu.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();


        $validated = $request->validate([
            'password_saat_ini' => ['required', 'current_password'],
            'password' => ['required', Password::min(8), 'confirmed'],
        ]);

        $user->update([
            'password' => $validated['password'], // otomatis ter-hash (cast 'hashed')
        ]);

        // Regenerasi session sebagai langkah keamanan setelah ganti password.
        $request->session()->regenerate();

        return back()->with('success', 'Password berhasil diganti.');
    }

    /**
     * Ganti email admin.
     */
    public function updateEmail(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'email' => $validated['email'],
        ]);

        return back()->with('success', 'Email berhasil diganti.');
    }
}
