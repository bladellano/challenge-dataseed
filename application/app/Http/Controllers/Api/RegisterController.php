<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register(UserRequest $request)
    {
        try {
            $data = $request->all();
            $data['password'] =  Hash::make($request->input('password'));
            $record = User::create($data);
            return response()->json(['data' => $record, 'message' => 'Record created successfully!'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message'=> $e->getMessage()], 422);
        }
    }
}
