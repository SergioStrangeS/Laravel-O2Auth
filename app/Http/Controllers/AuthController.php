<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function AuthRedirect(Request $request)
    {
        $request->session()->put('state', $state = Str::random(40));
        $query = http_build_query([
            'client_id' => '95fc2067-6f1c-4a8f-aa2a-99d3d400a0f0',
            'redirect_uri' => 'http://vpn.nyako.ru/auth/callback',
            'response_type' => 'code',
            'state' => $state
        ]);

        return redirect(env('W2ME_SERVER') . '/oauth/authorize?' . $query);
    }

    public function AuthCallback(Request $request)
    {
        $state = $request->session()->pull("state");

        throw_unless(strlen($state) > 0 && $state == $request->state, InvalidArgumentException::class);

        $response = Http::asForm()->post(
            "http://25.66.30.206:8000/oauth/token",
            [
                "grant_type" => "authorization_code",
                "client_id" => "95fc2067-6f1c-4a8f-aa2a-99d3d400a0f0",
                "client_secret" => "l0EVt1gQDsPGj3jQm2g0KuTy1G9iPdzNvKqbKk0k",
                "redirect_uri" => "http://vpn.nyako.ru/auth/callback",
                "code" => $request->code
            ]);

        $access_token = $response->json("access_token");
        $w2me_user = Http::withHeaders([
            "Accept" => "application/json",
            "Authorization" => "Bearer " . $access_token
        ])->get("http://25.66.30.206:8000/api/user");


        $user = User::where('id', $w2me_user->json('id'))->first();

        if ($user) {
            $user->update([
                'w2me_token' => $response->json('access_token'),
                'w2me_refresh_token' => $response->json('refresh_token'),
            ]);
        } else {
            $user = User::create([
                'name' => $w2me_user->json('name'),
                'email' => $w2me_user->json('email'),
                'w2me_id' => $w2me_user->json('id'),
                'w2me_token' => $response->json('access_token'),
                'w2me_refresh_token' => $response->json('refresh_token'),
            ]);
        }

        Auth::login($user);

        return redirect()->route('profile');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();

        return redirect()->route('index');
    }

    public function profile()
    {
        return view('profile');
    }
}
