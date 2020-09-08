<?php
namespace App\Http\Controllers\WEB\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait AuthFacade
{
    public function id (int $id)
    {
        return User::find($id);
    }

    /**
     * @return bool|mixed
     */
    public function user ($email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * Validate request
     * @return bool true|false
     * true passed
     * false failed
     */
    public function validator (Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];
        $rules = [
            'name' => 'required|string|min:6',
            'email' => 'required|email:dns,rfc'
        ];
        return !(Validator::make($data, $rules)->fails());
    }

    public function lower (&$email)
    {
        return strtolower($email);
    }

    public function auth (Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (!Auth::attempt($credentials)) {
            return false;
        }

        //API
        $user = $request->user();
        $tokenResult = $user->createToken('Users Private Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeek(1);
        if ($request->exists('remember_me')) {
            $token->expires_at = Carbon::now()->addMonth(6);
        }
        $token->save();
        //END API
        return [
            'token' => $tokenResult->accessToken,
            'user' => $user
        ];
    }

    public function lazyAuth ($user)
    {
        Auth::login($user);
        $tokenResult = $user->createToken('Users Private Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeek(12);
        $token->save();
        return [
            'token' => $tokenResult->accessToken,
            'user' => $user
        ];
    }
}
