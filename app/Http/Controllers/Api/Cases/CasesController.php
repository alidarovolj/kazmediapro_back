<?php

namespace App\Http\Controllers\Api\Cases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Models\Cases;

class CasesController extends Controller
{
    public function cases()
    {
        $array = Cases::all();
        $data_1 = collect($array)->all();

        return response()->json(['data' => $data_1], 200);
    }
    public function caseSave(Request $request)
    {
        $rules = [
            'name' => 'required',
            'images' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, $validator->errors()], 400);
        }
        $name = $request->name;
        $description = $request->description;
        $images = $request->images;
        $category_id = $request->category_id;
        $user_id = auth()->user()->id;
        $message = Cases::create(['name' => $name, 'description' => $description, 'images' => $images, 'category_id' => $category_id, 'user_id' => $user_id]);
        return response()->json(['success' => true, $message], 201);
    }
}
