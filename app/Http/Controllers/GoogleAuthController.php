<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Cek apakah user sudah ada berdasarkan google_id
        $existingUser = User::where('google_id', $googleUser->id)->first();

        if ($existingUser) {
            // User sudah ada, login langsung
            Auth::login($existingUser);
            return redirect(route('user.dashboard', absolute: false));
        }

        $emailUsed = User::where('email', $googleUser->email)->whereNull('google_id')->first();

        if ($emailUsed) {
            return redirect('/login')->with('error', $googleUser->email . ' is already registered.');
        }

        if (!$emailUsed) {
            // User baru, perlu membuat user baru
            $userData = [
                'name' => $googleUser->name,
                'username' => 'user_' . Str::lower(Str::random(8)),
                'email' => $googleUser->email,
                'password' => Str::password(12),
                'email_verified_at' => now(),
                'google_id' => $googleUser->id,
            ];

            // Cek apakah Google menyediakan avatar
            if ($googleUser->getAvatar()) {
                // Jika Google menyediakan avatar, download dan simpan
                $userData['avatar'] = $this->downloadAndSaveGoogleAvatar($googleUser->getAvatar(), $googleUser->id);
            }

            $user = User::create($userData);

            // Jika tidak ada avatar dari Google, generateAvatar akan dipanggil otomatis 
            // melalui boot method yang sudah ada di model User

            event(new Registered($user));
            Auth::login($user);

            return redirect(route('user.dashboard', absolute: false));
        }
    }

    private function downloadAndSaveGoogleAvatar($avatarUrl, $googleId)
    {
        try {
            // Download avatar dari Google
            $avatarContent = file_get_contents($avatarUrl);

            if ($avatarContent === false) {
                return null; // Gagal download, biarkan generateAvatar() yang handle
            }

            // Generate filename unik
            $filename = 'avatars/google_' . $googleId . '_' . time() . '.png';

            // Simpan ke storage
            Storage::disk('public')->put($filename, $avatarContent);

            return $filename;
        } catch (Exception $e) {
            // Jika terjadi error, return null agar generateAvatar() yang handle
            Log::error('Failed to download Google avatar: ' . $e->getMessage());
            return null;
        }
    }
}