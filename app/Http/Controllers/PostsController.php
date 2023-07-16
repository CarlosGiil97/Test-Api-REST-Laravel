<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;


class PostsController extends Controller
{
    //
    public function index()
    {
        //
        $posts = Posts::all();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $array[$post->id] = $post;
                $array[$post->id]['categories'] = $post->categories ?? [];
            }
        }
        return response()->json($posts);
    }
    //
    /**
     * Store a newly users resource in storage.
     */


    public function store(Request $request)
    {
        //
        try {
            $posts = new Posts();
            $posts->title = $request->title;
            $posts->id_cat = $request->category;
            $posts->id_user = $request->userId;
            $posts->body = $request->description;
            $posts->images = $request->images ?? null;

            $posts->save();
            //en vez de devolver el cliente en sí, creo un nuevo array con un status de ok y el contenido del cliente creado
            $data = [
                'status' => 'Posts creado con éxito',
                'code' => 'ok',
                'data' => $posts,
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            // Capturar la excepción y devolver una respuesta de error
            $errorData = [
                'status' => 'Error al crear el posts',
                'message' => $e->getMessage()
            ];
            return response()->json($errorData, 500);
        }
    }
}
