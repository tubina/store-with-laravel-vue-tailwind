<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function edit(Request $request): Response
    {

        $photo_user = $request->user()->profile_photo
        ? asset('storage/'. $request->user()->profile_photo)
        : "data:image/png;base64,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";

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'profile_photo' => $photo_user
        ]);
    }
/*************************************************************************************/
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }
/*************************************************************************************/
    public function editPhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|max:2048', // valida imagem até 2MB
        ]);

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');

            // Salva a imagem na pasta storage/app/public/profile_photos
            // Garanta que você tenha rodado: php artisan storage:link

            if ($request->user()->profile_photo && \Storage::disk('public')->exists($request->user()->profile_photo)) {
                \Storage::disk('public')->delete($request->user()->profile_photo);
            }

            $path = $file->store('profile_photos', 'public');

            // Atualiza o caminho da foto no usuário logado
            $user = $request->user();
            $user->profile_photo = $path;
            $user->save();

            return back()->with('success', 'Foto atualizada com sucesso!');
        }
    }
/*************************************************************************************/
    public function deletePhoto(Request $request)
    {
        $user = $request->user();

        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
            $user->profile_photo = null;
            $user->save();
        }
        $user->profile_photo = null;
        $user->save();

        return back();
    }
/*************************************************************************************/
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
