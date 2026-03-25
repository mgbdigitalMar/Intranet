<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordChangeController extends Controller
{
    public function showChange()
    {
        $user_id = session('user_id');
        if (!$user_id) return redirect('/login');
        
        $user = User::findOrFail($user_id);
        if (!$user->must_change_password) {
            return redirect('/dashboard');
        }
        
        return view('auth.password-change');
    }

    public function update(Request $request)
    {
        $user_id = session('user_id');
        if (!$user_id) return redirect('/login');
        
        $request->validate([
            'new_password' => 'required|min:6|confirmed',
        ], [
            'new_password.required' => 'Nueva contraseña obligatoria.',
            'new_password.min' => 'Mínimo 6 caracteres.',
            'new_password.confirmed' => 'Las contraseñas no coinciden.',
        ]);
        
        $user = User::findOrFail($user_id);
        if (!$user->must_change_password) {
            return redirect('/dashboard');
        }
        
        $user->update([
            'password' => Hash::make($request->new_password),
            'must_change_password' => false,
        ]);
        
        return redirect('/dashboard')->with('success', 'Contraseña cambiada correctamente. Bienvenido!');
    }
}

