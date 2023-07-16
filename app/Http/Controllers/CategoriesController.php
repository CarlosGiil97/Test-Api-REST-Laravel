<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{

    public function index()
    {
        //
        $categories = Categories::all();
        return response()->json($categories);
    }
}
