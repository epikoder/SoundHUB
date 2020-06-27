<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessRoles;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $user;
    public $tokenResult;
    
    /**
     * Create User
     *
     * @param Request $request
     * @return json $mixed
     */
    public function signup (Request $request)
    {
        $this->request = $request;
        $this->store();
        $this->auth();
        return response()->json(
            [
                'message' => 'Account created successfully',
                'user' => $this->user,
                // 'activate' => $activationKey
            ],
            200,
            [
                'Authorization' => 'Bearer '. $this->tokenResult->accessToken,
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json'
            ]
        );
    }

    /**
     * Login User
     *
     * @param Request request
     * @return Json $mixed
     */
    public function login (Request $request)
    {
        $this->request = $request;
        $this->auth($this->request);
        return response()->json(
            [
                'message' => 'Account created successfully',
                'user' => $this->user,
            ],
            200,
            [
                'Authorization' => 'Bearer ' . $this->tokenResult->accessToken,
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json'
            ]
        );
    }

    /**
     * Logout User
     *
     * @param Request $request
     * @return void
     */
    public function logout (Request $request)
    {
        $this->request = $request;
        $this->request->user()->token()->revoke();
    }

    /**
     * Authenticate against credentials
     *
     * @param Request $request
     * @return void
     */
    public function auth (Request $request = null, $password = null)
    {
        if ($request) {
            $this->request = $request;
        }
        if ($password) {
            $this->request->password = $password;
        }
        $credentials = ['email' => $this->request->email, 'password' => $this->request->password];
        Auth::attempt($credentials);
        $this->user = $this->request->user();
        $this->tokenResult = $this->user->createToken('Users Private Personal Access Token');
        $token = $this->tokenResult->token;
        $token->expires_at = Carbon::now()->addWeek(1);
        if ($this->request->exists('remember_me')) {
            $token->expires_at = Carbon::now()->addWeeks(12);
        }
        $token->save();
    }

    /**
     * Return User instance
     *
     * @param Request $request
     * @param Json $mixed
     */
    public function user(Request $request)
    {
        if ($request) {
            $this->request = $request;
        }
        $this->user = $this->request->user();
        return response()->json([
            'user' => $this->user,
            'role' => $this->user->role
        ]);
    }

    /**
     * Store new User
     *
     * @param Request $this->request
     * @return void
     */
    public function store(Request $request = null)
    {
        if ($request) {
            $this->request = $request;
        }
        $this->request->email = strtolower($this->request->email);
        $this->user = new User([
            'email' => $this->request->email,
            'password' => bcrypt($this->request->password),
            'name' => $this->request->name
        ]);
        $this->user->save();
        ProcessRoles::dispatch($this->user, 1);
    }
}
