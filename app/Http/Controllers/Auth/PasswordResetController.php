<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Terjemahan status broker ke Bahasa Indonesia.
     */
    private const PESAN = [
        'passwords.sent' => 'Link reset password sudah dikirim ke email Anda. Periksa kotak masuk (dan folder spam).',
        'passwords.throttled' => 'Terlalu banyak percobaan. Silakan tunggu sekitar satu menit lalu coba lagi.',
        'passwords.user' => 'Email tidak terdaftar sebagai akun admin.',
        'passwords.token' => 'Token reset tidak valid atau sudah kedaluwarsa. Silakan minta link baru.',
        'passwords.reset' => 'Password berhasil direset! Silakan masuk dengan password baru Anda.',
    ];

    public function showLupaPassword()
    {
        return view('auth.lupa-password');
    }

    public function kirimLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        try {
            $status = Password::sendResetLink($request->only('email'));
        } catch (\Exception $e) {
            // Kegagalan SMTP (server email down / salah konfigurasi)
            report($e);
            return back()->withErrors(['email' => 'Gagal mengirim email. Coba lagi beberapa saat, atau hubungi pengelola sistem.']);
        }

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', self::PESAN[$status])
            : back()->withErrors(['email' => self::PESAN[$status] ?? $status]);
    }

    public function showResetPassword(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => $password, // otomatis ter-hash (cast 'hashed')
                        'remember_token' => Str::random(60),
                    ])->save();
                }
            );
        } catch (\Exception $e) {
            report($e);
            return back()->withErrors(['email' => 'Terjadi kesalahan. Coba lagi beberapa saat.']);
        }

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('reset_success', self::PESAN[$status]);
        }

        return back()->withErrors(['email' => self::PESAN[$status] ?? $status]);
    }
}
