<?php

namespace App\Jobs;

use App\Mail\MailSignup;
use App\Signup;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProcessRegSignup implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $signup = new Signup([
            'name' => $this->user->name,
            'email' => $this->user->email,
            'token' => md5(Str::random())
        ]);
        $signup->save();
        Mail::to($this->user)->send(new MailSignup($signup));
    }
}
