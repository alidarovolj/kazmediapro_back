<?php

namespace App\Http\Controllers\Api\Messages;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Messages;
use Illuminate\Support\Facades\Mail;
use App\Mail\Message;
use Validator;

class MessagesController extends Controller
{
    public function messagesList()
    {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
        $array = Messages::all();
        $data_1 = collect($array)->all();

        return response()->json(['data' => $data_1], 200);
    }

    public function messageSave(Request $request)
    {
        $rules = [
            'direction' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, $validator->errors()], 400);
        }
        $direction = $request->direction;
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $note = $request->note;
        Mail::to("oljasalidarov@gmail.com")->send(new Message($direction, $name, $email, $phone, $note));
        $message = Messages::create(['direction' => $direction, 'name' => $name, 'email' => $email, 'phone' => $phone, 'note' => $note]);
        return response()->json(['success' => true, $message], 201);
    }
}
