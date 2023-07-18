<?php

namespace App\Http\Controllers\Api\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Clients;
use Validator;

class ClientsController extends Controller
{
    public function clients()
    {
        $array = Clients::with(['user_id'])->get();
        $data_1 = collect($array)->all();

        return response()->json(['data' => $data_1], 200);
    }
    public function clientSave(Request $request)
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
        $message = Clients::create(['name' => $name, 'user_id' => $user_id]);
        return response()->json(['success' => true, $message], 201);
    }
}
