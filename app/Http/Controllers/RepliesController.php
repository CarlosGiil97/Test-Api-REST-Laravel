<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReplyPosts;


class RepliesController extends Controller
{

    public function show(ReplyPosts $reply)
    {
        //
        $response = $reply;


        return response()->json($response);
    }


    public function update(Request $request, ReplyPosts $reply)
    {


        $reply->title = $request->title;
        $reply->body = $request->body;

        $reply->save();

        $data = [
            'status' => 'Respuesta actualizada con éxito',
            'code' => 'ok',
        ];
        return response()->json($data);
    }
}
