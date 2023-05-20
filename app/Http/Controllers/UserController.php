<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    /**
     * Store a newly users resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $user = new User();
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->remember_token = $request->remember_token;

            $userExists = DB::table('users')
                ->where('email', $user->email)
                ->exists();

            if ($userExists) {

                //en vez de devolver el cliente en sí, creo un nuevo array con un status de ok y el contenido del cliente creado
                $data = [
                    'status' => 'Este mail ya está registrado'
                ];
            } else {
                $user->save();
                //en vez de devolver el cliente en sí, creo un nuevo array con un status de ok y el contenido del cliente creado
                $data = [
                    'status' => 'Usuario creado con éxito',
                    'data' => $user
                ];
            }

            return response()->json($data);
        } catch (\Exception $e) {
            // Capturar la excepción y devolver una respuesta de error
            $errorData = [
                'status' => 'Error al crear el usuario',
                'message' => $e->getMessage()
            ];
            return response()->json($errorData, 500);
        }
    }


    /**
     * Login users (received username or mail and password)
     */
    public function login(Request $request)
    {
        try {

            $email =  $request->email;
            $password = $request->password;

            $user = User::where('email', $email)->first();

            if ($user != null && Hash::check($password, $user->password)) {

                // Autenticar al usuario
                Auth::login($user);
                // Respuesta de éxito
                $data = [
                    'status' => 'Autenticación con exito',
                    'code' => 'ok',
                    'user' => $user
                ];
                return response()->json($data);
            } else {
                $data = [
                    'status' => 'Error de autenticación',
                    'code' => 'ko',
                    'message' => 'Las credenciales proporcionadas son inválidas.'
                ];
                return response()->json($data, 401);
            }
        } catch (\Exception $e) {
            // Capturar la excepción y devolver una respuesta de error
            $errorData = [
                'status' => 'Error al intentar iniciar sesión',
                'message' => $e->getMessage()
            ];
            return response()->json($errorData, 500);
        }
    }


    /**
     * Display the specified user.
     */
    public function show(User $idUser)
    {
        //
        return response()->json($idUser);
    }
}
