<?php

namespace App\Jobs;

use App\Payments;
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
    public function __construct($reference, $plan, $user)
    {
        $this->data['plan'] = $plan;
        $this->data['user'] = $user;
        $this->data['reference'] = $reference;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle ()
    {
        $payment = Payments::where('reference', $this->data['reference'])->first();
        DB::table('process_log')->insert([
            'log' => json_encode($payment)
        ]);
        
        if (!$payment) {
            $this->data['user']->plans()->attach($this->data['plan']->id, [
                'reference' => $this->data['reference'],
                'expires_at' => Carbon::now()->addYear()
            ]);
        }

        $artist = $this->data['user']->artist;
        if (!$artist) {
            $this->data['user']->artists()->create();
        }
    }
}
