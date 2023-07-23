<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Api\Controller;
use App\Models\Models\Projects;
use Illuminate\Http\Request;
use Validator;

use App\Models\Models\Categories;

class CategoriesController extends Controller
{
    public function categories()
    {
        $array = Categories::with(['user_id'])->get();
        $data_1 = collect($array)->all();

        return response()->json(['data' => $data_1], 200);
    }
    public function categoryCases()
    {
        $categoriesWithCases = Categories::with(['user_id', 'cases'])->get();
        $data = $categoriesWithCases->toArray();

        return response()->json(['data' => $categoriesWithCases], 200);
    }
    public function categoryById($id)
    {
        $column = 'id';

        // Retrieve the category with its associated cases
        $category = Categories::with('cases')->find($id);

        if (is_null($category)) {
            return response()->json(['error' => true, 'message' => 'Object not found'], 404);
        }

        return response()->json(['data' => $category], 200);
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
    public function categoryRemove(Request $request)
    {
        $rules = [
            'id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        $id = $request->id;
        $message = Categories::where('id', $id)->delete();
        return response()->json(['success' => true, 'message' => $message], 201);
    }
    public function categoryUpdate(Request $request)
    {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 401);
        }
        $rules = [
            'id' => 'required',
            'name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        $id = $request->id;
        Categories::where('id', $id)->update(array(
            'name' => $request->name,
        ));
        return response()->json(['success' => true, "data" => "Data updated successfully"], 200);
    }
}
