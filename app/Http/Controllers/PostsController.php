<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\ReplyPosts;


class PostsController extends Controller
{
    //
    public function index()
    {
        //
        $posts = Posts::all();
        $posts = Posts::select('*')
            ->with('categories')
            ->with('infoUser')
            ->get();

        // if (!empty($posts)) {
        //     foreach ($posts as $post) {
        //         $array[$post->id] = $post;
        //         $category = $post->categories;
        //         $array[$post->id]['categories'] = $category;
        //         $infoUser = $post->infoUser;
        //         $array[$post->id]['infoUser'] = ['name' => $infoUser->name, 'username' => $infoUser->username];
        //     }
        // }
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

    public function show(Posts $post)
    {
        //
        $response = $post;


        $response['infoUser'] = $post->infoUser;

        $replies = $post->replyes;

        if (!empty($replies)) {
            $response['numReplies'] = count($replies);
            foreach ($replies as $key => $reply) {
                $response['replyes'][$key] = $reply;
                $response['replyes'][$key]['user'] = $reply->user;
            }
        }
        return response()->json($response);
    }

    public function update(Request $request, Posts $post)
    {

        $post->id_user = $request->userId;
        $post->title = $request->title;
        $post->body = $request->description;
        $post->id_cat = $request->category;
        $post->date_modified = date('Y-m-d H:i:s');
        $post->is_edited =  1;
        $post->save();

        $data = [
            'status' => 'Post actualizado  con éxito',
            'code' => 'ok',
        ];
        return response()->json($data);
    }
}
