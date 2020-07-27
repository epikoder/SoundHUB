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
        $this->user->email = strtolower($request->email);
        ProcessRegSignup::dispatch($this->user);
        return view('signup.reg-response', [
            'user' => $this->user
        ]);
    }

    public function verSignup (Request $request)
    {
        $signup = Signup::find($request->id);
        if ($this->user($signup->email)) {
            return view('errors.custom', [
                'code' => 409,
                'message' => 'Conflict'
            ]);
        }
        return view('signup.signup',[
            'user' => $signup
        ]);
    }

    public function signup (Request $request)
    {
        $signup = Signup::find($request->id);
        if ($this->user($signup->email)) {
            return view('signup.conflict');
        }

        if (!$request->exists('password')) {
            return view('signup.signup', [
                'user' => $signup
            ]);
        }

        $user = new User([
            'name' => strtolower($signup->name),
            'email' => $signup->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        $user->roles()->sync(1);
        $data = $this->lazyAuth($user);

        return response()->json([
                'user' => $data['user']
            ],
            200,
            [
                // 'Authorization' => 'Bearer ' . $data['token']
        ]);
    }

    public function login (Request $request)
    {
        $data = $this->auth($request);
        if (!$data) {
           return response()->json([], 401);
        }
        /*
        return view('dashboard', [
            'user' => $data['user'],
            'artist' => $data['user']->artists
        ]);
        */

        return response()->json(
            [
                'user' => $data['user'],
                'artist' => $data['user']->artists
            ],
            200,
            [
                // 'Authorization' => 'Bearer '.$data['token']
            ]
        );
    }
}
