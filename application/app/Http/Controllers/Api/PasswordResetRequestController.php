<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailReset;

class PasswordResetRequestController extends Controller
{
    public function sendPasswordResetLink(Request $request)
    {
        if (!$this->validateEmail($request->email))
            return $this->failedResponse();

        $this->send($request->email);

        return $this->successResponse();
    }

    public function send($email)
    {
        $token = $this->createToken($email);
        Mail::to($email)->send(new SendMailReset($token, $email));
    }

    public function createToken($email)
    {
        $oldToken = DB::table('password_resets')->where('email', $email)->first();

        if ($oldToken)
            return $oldToken->token;

        $token = Str::random(40);

        $this->saveToken($token, $email);
        return $token;
    }

    public function saveToken($token, $email)
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }

    public function validateEmail($email)
    {
        return !!User::where('email', $email)->first();
    }

    public function failedResponse()
    {
        return response()->json([
            'message' => 'Email does\'t found on our database'
        ], 404);
    }

    public function successResponse()
    {
        return response()->json([
            'message' => 'Reset Email is send successfully, please check your inbox.'
        ], 200);
    }
}
