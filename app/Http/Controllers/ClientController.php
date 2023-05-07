<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $array = [];
        $clients = Client::all();
        if (!empty($clients)) {
            foreach ($clients as $client) {
                $array[$client->id] = $client;
                $array[$client->id]['services'] = $client->services ?? [];
            }
        }

        return response()->json($array);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();

        //en vez de devolver el cliente en sí, creo un nuevo array con un status de ok y el contenido del cliente creado
        $data = [
            'status' => 'Usuario creado con éxito',
            'data' => $client
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
        $data = [
            'msg' => 'Cliente obtenido con éxito',
            'client' => $client,
            'services' => $client->services
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();

        $data = [
            'status' => 'Usuario actualizado  con éxito',
            'data' => $client
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
        $client->delete();
        $data = [
            'status' => 'Usuario eliminado  con éxito',
            'data' => $client
        ];
        return response()->json($data);
    }

    public function attach(Request $request)
    {
        $client = Client::find($request->client_id);
        $client->services()->attach($request->service_id);

        $data = [
            'msg' => 'Servicio añadido al cliente',
            'data' => $client
        ];
        return response()->json($data);
    }

    public function detach(Request $request)
    {
        $client = Client::find($request->client_id);
        $client->services()->detach($request->service_id);

        $data = [
            'msg' => 'Servicio eliminado del cliente',
            'data' => $client
        ];
        return response()->json($data);
    }
}
