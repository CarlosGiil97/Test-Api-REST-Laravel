<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


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


            $userExists = DB::table('users')
                ->where('email', $user->email)
                ->exists();

            if ($userExists) {

                //al existir el usuario tengo que mandar un codigo de error
                $data = [
                    'status' => 'El mail ' . $request->email . ' ya está registrado',
                    'code' => 'ko',
                ];

                return response()->json($data);
            } else {
                $user->save();
                // Generar un token de autenticación para el usuario
                $token = $user->createToken('auth_token')->plainTextToken;
                //en vez de devolver el cliente en sí, creo un nuevo array con un status de ok y el contenido del cliente creado
                $data = [
                    'status' => 'Usuario creado con éxito',
                    'code' => 'ok',
                    'data' => $user,
                    'access_token' => $token,
                    'type_token' => 'Bearer'
                ];

                return response()->json($data);
            }
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
                $user->api_token = Str::random(60);

                $user->save();
                // Respuesta de éxito
                $data = [
                    'status' => 'Autenticación con exito',
                    'code' => 'ok',
                    'api_token' => $user->api_token,
                    'id' => $user->id,
                    'user' => $user
                ];
                return response()->json($data);
            } else {
                $data = [
                    'status' => 'Error de autenticación',
                    'code' => 'ko',
                    'message' => 'Las credenciales proporcionadas son inválidas.'
                ];
                return response()->json($data);
            }
        } catch (\Exception $e) {
            // Capturar la excepción y devolver una respuesta de error
            $errorData = [
                'status' => 'Error al intentar iniciar sesión',
                'code' => 'ko',
                'message' => $e->getMessage()
            ];
            return response()->json($errorData, 500);
        }
    }


    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        //
        $data = [
            'msg' => 'Usuario obtenido con éxito',
            'code' => 'ok',
            'user' => $user,
        ];
        return response()->json($data);
    }

    public function update(Request $request, User $user)
    {
        //
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->updated_at = $request->updated_at;
        $user->save();

        $data = [
            'status' => 'Usuario actualizado  con éxito',
            'code' => 'ok',
            'data' => $user
        ];
        return response()->json($data);
    }

    public function upload(Request $request)
    {

        var_dump($request, 'yiee');
        return response()->json(['eee']);
    }

    public function test(Request $request)
    {
        var_dump('hola');
    }
}
