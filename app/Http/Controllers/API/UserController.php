<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Auth\AuthController;
use App\Jobs\ProcessMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * @var $request
     */
    public $request;

    /**
     * @var $user
     */
    public $user;

    /**
     * @var $reset
     */
    public $reset;

    /**
     * Update User Password
     *
     * @param Request $request
     * @return json $mixed
     */
    public function updatePassword (Request $request)
    {
        if (!Auth::attempt([$request->user()->email, $request->password])) {
            return response()->json([], 401);
        }
        $user = User::find($request->id());
        $user->password = bcrypt($request->newPassword);
        $user->save();
        $auth = new AuthController;
        $auth->auth($request, $request->newPassword);
    }

    /**
     * Update User
     *
     * @param Request $request
     * @return void
     */
    public function updateName (Request $request)
    {
        $user = User::find($request->id());
        $user->name = $request->name;
        $user->save();
    }

    /**
     * Request Delete User
     *
     * @param Request $request
     * @return json $mixed
     */
    public function requestDelete (Request $request)
    {
        if (!Auth::attempt([$request->user()->email, $request->password])) {
            return response()->json([], 401);
        }
        // SEND MAIL
    }

    /**
     * Delete User account
     *
     * @param Request $request
     * @return json $mixed
     */
    public function deleteUser (Request $request)
    {

    }

    /**
     * Send activation code
     *
     * @param Request $request
     */
    public function sendActivation(Request $request)
    {
        $this->user = User::where('email', strtolower($request->email))->first();
        if (!$this->user) {
            return response()->json([], 401);
        }
        $this->reset = $this->user->resets()->create([
            'key' => Str::random(25),
            'expires_at' => Carbon::now()->addDay()
        ]);
        $data = ['user' => $this->user,'reset' => $this->reset];
        ProcessMail::dispatch($data);
    }

    /**
     * Reset user password
     *
     * @param Request $request
     */
    public function resetPassword(Request $request)
    {
        $this->request = $request;
        $this->verifyResetLink();
        $this->user->password = bcrypt($this->request->password);
        $this->user->save();
        return response();
    }


    /**
     * Verify the password reset request
     *
     * @param Request $request
     */
    public function verifyResetLink ()
    {
        $this->user = User::find($this->request->user_id);
        if (!$this->user) {
            return response()->json([], 401);
        }
        $reset = $this->user->resets()->find($this->request->reset_id);
        if (!$reset) {
            return response()->json([], 404);
        }
        if ($reset->expires_at < Carbon::now()) {
            return response()->json([], 401);
        }
        return $this->user;
    }
}
