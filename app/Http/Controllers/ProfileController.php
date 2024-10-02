<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Mostrar el formulario de perfil del usuario.
     * 
     * @param Request $request - La solicitud HTTP entrante.
     * 
     * @return View - Retorna la vista del formulario de edición del perfil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(), // Se pasa el usuario autenticado a la vista.
        ]);
    }

    /**
     * Actualizar la información del perfil del usuario.
     * 
     * @param ProfileUpdateRequest $request - La solicitud de actualización del perfil, que valida los datos.
     * 
     * @return RedirectResponse - Redirige a la vista de edición de perfil con un mensaje de estado.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Se rellenan los atributos del usuario con los datos validados de la solicitud.
        $request->user()->fill($request->validated());

        // Si el correo electrónico ha cambiado, se establece la verificación del correo electrónico en nulo.
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Se guarda el usuario actualizado en la base de datos.
        $request->user()->save();

        // Redirige de nuevo al formulario de perfil con un mensaje de estado de actualización.
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Eliminar la cuenta del usuario.
     * 
     * @param Request $request - La solicitud HTTP entrante que contiene el contexto del usuario.
     * 
     * @return RedirectResponse - Redirige a la ruta principal después de la eliminación de la cuenta.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Valida que el usuario haya proporcionado la contraseña actual para la eliminación.
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        // Obtiene el usuario autenticado.
        $user = $request->user();

        // Cierra la sesión del usuario.
        Auth::logout();

        // Elimina la cuenta del usuario de la base de datos.
        $user->delete();

        // Invalida la sesión actual y regenera el token CSRF.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirige al usuario a la página de inicio.
        return Redirect::to('/');
    }
}
