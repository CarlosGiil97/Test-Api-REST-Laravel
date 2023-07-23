<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

//importo la clase posts



class CategoriesController extends Controller
{

    public function index()
    {
        //
        $categories = Categories::all();
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $response[$category['id']] = $category;
                $response[$category['id']]['posts'] = $category->categoriesPosts;
            }
        }
        return response()->json($categories);
    }

    public function show(Categories $categories)
    {
        //
        $response = [];

        $response = $categories->only(['id', 'nombre', 'created_at', 'updated_at']);
        $response['posts'] = $categories->categoriesPosts;


        return response()->json($response);
    }
}