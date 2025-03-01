<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\alert;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        // Verificar si el usuario ya está autenticado
        if (Auth::check()) {
            return redirect()->route('home'); // Redirigir a la página principal si ya está autenticado
        }

        // Si no está autenticado, mostrar el formulario de inicio de sesión
        return view('auth.login');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|min:4',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Asigna el rol de 'user' por defecto
        $user->assignRole('cashier');

        return redirect()->route('login')->with('success', 'Registro exitoso.');
    }

    // Inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            // Regenerar sesión para evitar ataques de fijación de sesión
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors(['username' => 'Las credenciales no son correctas.']);
    }

    // Cierre de sesión
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    // Función para actualizar la información del usuario
    public function update(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255|min:4',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:6|confirmed', // Validación solo si se quiere cambiar la contraseña
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        $user = User::findOrFail($user->id);


        // Actualizar los campos que se hayan enviado en la solicitud
        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('username')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        // Si se envió una nueva contraseña, la actualizamos
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        
        // Actualiza otros campos según sea necesario
        // Guardar los cambios en la base de datos
        $user->save();


        // Redirigir o devolver una respuesta
        return redirect()->route('profile')->with('success', 'Información actualizada correctamente.');
    }
    
    
}

