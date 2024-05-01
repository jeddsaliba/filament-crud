<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\HttpServiceProvider;
use Illuminate\Support\Facades\Auth;

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

        $abilities = $user->data->role->accessPermissions->pluck('slug');
        $accessToken = $user->data->createToken('abilities', $abilities->toArray());
        // $accessToken = $user->data->createToken('token');
        return response(['status' => $user->status, 'message' => $user->message, 'result' => ['user' => $user->data, 'access_token' => $accessToken->plainTextToken]], HttpServiceProvider::OK);
    }
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($request->type) {
            auth()->guard('web')->logout();
            return redirect('login');
        }
        $user->currentAccessToken()->delete();
        return response(['status' => true, 'message' => 'Logout successful.'], HttpServiceProvider::OK);
    }
}
