<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Models\Categories;

class CategoriesController extends Controller
{
    public function categories()
    {
        $array = Categories::all();
        $data_1 = collect($array)->all();

        return response()->json(['data' => $data_1], 200);
    }
    public function createCategory(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, $validator->errors()], 400);
        }
        $name = $request->name;
        $user_id = auth()->user()->id;
        $message = Categories::create(['name' => $name, 'user_id' => $user_id]);
        return response()->json(['success' => true, $message], 201);
    }
}
