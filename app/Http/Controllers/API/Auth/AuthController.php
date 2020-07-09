<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessRegSignup;
use App\Signup;
use App\User;
use Illuminate\Http\Request;
use stdClass;

class AuthController extends Controller
{
    use AuthFacade;

    protected $user;

    /**
     * @param Request $request
     */
    public function regSignup (Request $request)
    {
        if (!$request->exists('email') && !$request->exists('name') && !$this->validator($request->email)) {
            return response()->json([], 400);
        }
        if ($this->user($request->email)) {
            return response()->json([], 409);
        }
        $this->user = new stdClass;
        $this->user->name = $request->name;
        $this->user->email = $request->email;
        ProcessRegSignup::dispatch($this->user);
        return response()->json([], 200);
    }

    public function verSignup (Request $request)
    {
        $signup = Signup::find($request->id);
        if ($this->user($signup->email)) {
            return response()->json([], 409);
        }
        return response()->json([
            'name' => $signup->name
        ], 200);
    }

    public function signup (Request $request)
    {
        $signup = Signup::find($request->id);
        if ($this->user($signup->email)) {
            return response()->json([], 409);
        }
        if (!$request->exists('password')) {
            return response()->json([], 400);
        }
        $user = new User([
            'name' => $signup->name,
            'email' => $signup->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        $user->roles()->sync(1);
        $data = $this->lazyAuth($user);
        return response()->json([
                'user' => $data['user']
            ], 200,
            [
                'Authorization' => 'Bearer ' . $data['token'],
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json'
            ]);
    }

    public function login (Request $request)
    {
        $data = $this->auth($request);
        if (!$data) {
            return response()->json([], 401);
        }
        return response()->json(
            [
                'user' => $data['user']
            ],
            200,
            [
                'Authorization' => 'Bearer '.$data['token'],
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json'
            ]
        );
    }
}
