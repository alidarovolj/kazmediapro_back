<?php

namespace App\Http\Controllers\Api\Cases;

use App\Http\Controllers\Api\Controller;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Validator;

use App\Models\Models\Cases;

class CasesController extends Controller
{
    use SoftDeletes;
    public function cases()
    {
        $array = Cases::with(['user_id', 'category_id'])->get();
        $data_1 = collect($array)->all();

        return response()->json(['data' => $data_1], 200);
    }
    public function caseSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'images' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id', // Validate if the category_id exists in the categories table
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        // Get the authenticated user's ID
        $user_id = auth()->user()->id;

        // Retrieve the request data
        $name = $request->input('name');
        $description = $request->input('description');
        $images = $request->input('images');
        $category_id = $request->input('category_id');

        // Save the case in the database
        $case = Cases::create([
            'name' => $name,
            'description' => $description,
            'images' => $images,
            'category_id' => $category_id,
            'user_id' => $user_id,
        ]);

        // Return a success response with the created case
        return response()->json(['success' => true, 'case' => $case], 201);
    }
    public function caseRemove(Request $request)
    {
        $rules = [
            'id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        $id = $request->id;
        $message = Cases::where('id', $id)->delete();
        return response()->json(['success' => true, 'message' => $message], 201);
    }
    public function caseUpdate(Request $request)
    {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 401);
        }
        $rules = [
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'images' => 'required',
            'category_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        $id = $request->id;
        Cases::where('id', $id)->update(array(
            'name' => $request->name,
            'description' => $request->description,
            'images' => $request->images,
            'category_id' => $request->category_id,
        ));
        return response()->json(['success' => true, "data" => "Data updated successfully"], 200);
    }
}
