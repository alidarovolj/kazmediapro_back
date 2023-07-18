<?php

namespace App\Http\Controllers\Api\Projects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Projects;
use Validator;

class ProjectsController extends Controller
{
    public function projects()
    {
        $array = Projects::with(['user_id', 'client_id', 'case_id'])->get();
        $data_1 = collect($array)->all();

        return response()->json(['data' => $data_1], 200);
    }
    public function projectSave(Request $request)
    {
        $rules = [
            'name' => 'required',
            'images' => 'required',
            'description' => 'required',
            'client_id' => 'required',
            'case_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, $validator->errors()], 400);
        }
        $name = $request->name;
        $description = $request->description;
        $images = $request->images;
        $client_id = $request->client_id;
        $case_id = $request->case_id;
        $user_id = auth()->user()->id;
        $message = Projects::create(['name' => $name, 'description' => $description, 'images' => $images, 'user_id' => $user_id, 'client_id' => $client_id, 'case_id' => $case_id]);
        return response()->json(['success' => true, $message], 201);
    }
}
