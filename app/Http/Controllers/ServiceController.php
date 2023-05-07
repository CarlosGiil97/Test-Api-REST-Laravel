<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $services = Service::all();
        return response()->json($services);
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
        ///
        $service = new Service();
        $service->name = $request->name;
        $service->descripcion = $request->descripcion;
        $service->price = $request->price;
        $service->created_at = $request->created_at;
        $service->updated_at = $request->updated_at;
        $service->save();

        //en vez de devolver el cliente en sí, creo un nuevo array con un status de ok y el contenido del cliente creado
        $data = [
            'status' => 'Servicio creado con éxito',
            'data' => $service
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
        return response()->json($service);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
        $service->name = $request->name;
        $service->descripcion = $request->descripcion;
        $service->price = $request->price;
        $service->created_at = $request->created_at;
        $service->updated_at = $request->updated_at;
        $service->save();

        $data = [
            'status' => 'Servicio actualizado  con éxito',
            'data' => $service
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
        $service->delete();
        $data = [
            'status' => 'Servicio eliminado  con éxito',
            'data' => $service
        ];
        return response()->json($data);
    }

    public function client(Request $request)
    {
        $service = Service::find($request->service_id);
        $clients = $service->client;

        return response()->json($clients);
    }
}
