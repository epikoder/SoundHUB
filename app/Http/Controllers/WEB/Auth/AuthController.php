<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessRegSignup;
use App\Models\Signup;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use stdClass;

class AuthController extends Controller
{
    use AuthFacade;

    protected $user;

    /**
     * Route for signup
     *
     * @param Request $request
     */
    public function regSignupRoute(Request $request)
    {
        /**
         * Check if user is logged in
         */
        if ($request->user()) {
            Session::put('user', json_decode($request->user()->toJson()));
            if ($request->user()->artists) {
                if ($request->user()->artists->name == null) {
                    redirect()->route('setup');
                }
                return redirect()->route('dashboard/artists', ['name' => $request->user()->artists->name]);
            }
            return redirect()->route('pay/info');
        }

        return view('signup.signup-reg');
    }

    /**
     * Save user information and await email verification
     *
     * @param Request $request
     */
    public function regSignup(Request $request)
    {
        /**
         * Check if User is logged in
         */
        if ($request->user()) {
            Session::put('user', json_decode($request->user()->toJson()));
            if ($request->user()->artists) {
                if ($request->user()->artists->name == null) {
                    redirect()->route('setup');
                }
                return redirect()->route('dashboard/artists', ['name' => $request->user()->artists->name]);
            }
            return redirect()->route('pay/info');
        }

        // Validation
        if (!$request->exists('email') || !$request->exists('name') || $this->validator($request)) {
            return response()->json([
                'message' => 'ERROR: invalid information'
            ], 400);
        }
        if ($this->user($request->email)) {
            return response()->json([
                'message' => 'Email already exist'
            ], 409);
        }

        /**
         * Prepare user info
         */
        $this->user = new stdClass;
        $this->user->name = $request->name;
        $this->user->email = strtolower($request->email);
        ProcessRegSignup::dispatch($this->user);

        Session::put('signup', $this->user);
        return response()->json([]);
    }

    /**
     * Response on save success
     */
    public function responseSignup()
    {
        return view('signup.signup-res');
    }

    /**
     * Return view for signup completion after email verification
     *
     */
    public function verSignup(Request $request)
    {
        /**
         * Verify info to prevent existing email
         */
        Session::flush();
        $signup = Signup::find($request->id);
        if ($this->user($signup->email)) {
            return redirect()->route('login');
        }

        Session::put('signup', $signup);
        return view('signup.signup');
    }

    /**
     * Complete signup process  uses xhttp
     */
    public function signup(Request $request)
    {
        /**
         * Verify info to prevent existing email
         */
        $signup = Signup::find($request->id);
        if ($this->user($signup->email)) {
            return response()->json([
                'message' => 'Account already exist'
            ], 409);
        }

        if (!$request->exists('password')) {
            return response()->json([
                'message' => 'password is missing'
            ], 400);
        }

        // Create new user
        $user = new User([
            'name' => $signup->name,
            'email' => $signup->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();

        //Set roles
        $user->roles()->sync(1);
        
        return response()->json();
    }

    public function loginRoute()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Auth user
        $data = $this->auth($request);
        $artist = ($data) ? $data['user']->artists : null;
        if (!$data) {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }

        // If user is artist
        $dashboard = $artist ? route('dashboard/artists', ['name' => $artist->name]) : null;

        return response()->json(
            [
                'user' => $data['user'],
                'artist' => $artist,
                'url' => [
                    'dashboard' => $dashboard,
                    'pay' => route('paystack/pay')
                ]
            ]
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
