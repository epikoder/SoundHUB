<?php

namespace App\Jobs;

use App\Models\Payments;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProcessPayments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($response, $plan, $user)
    {
        $this->data['plan'] = $plan;
        $this->data['user'] = $user;
        $this->data['response'] = $response;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->data['user']->plans()->sync($this->data['plan']->id, [
            'reference' => $this->data['response']->response,
            'response' => $this->data['response']->message,
            'expires_at' => Carbon::now()->addDays($this->data['plan']->days)
        ]);

        $artist = $this->data['user']->artist;
        if (!$artist) {
            $artist = $this->data['user']->artists()->create();
        }
        $artist->active = 1;
        $artist->save();
    }
}
