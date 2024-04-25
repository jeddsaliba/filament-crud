<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\HttpServiceProvider;

class AuthController extends Controller
{
    private $_user;
    public function __construct(
        User $User
    ) {
        $this->_user = $User;
    }
    public function login(Request $request)
    {
        $user = $this->_user->login($request);
        if (!$user->status) {
            if ($request->type && $user->errors) {
                return redirect('login')->withErrors($user->errors);
            }
            return response(['status' => $user->status, 'message' => $user->message], HttpServiceProvider::BAD_REQUEST);
        }
        if ($request->type) {
            return redirect('dashboard');
        }
        $accessToken = $user->data->createToken('abilities', config('abilities'));
        return response(['status' => $user->status, 'message' => $user->message, 'result' => ['user' => $user->data, 'access_token' => $accessToken->plainTextToken]], HttpServiceProvider::OK);
    }
}
