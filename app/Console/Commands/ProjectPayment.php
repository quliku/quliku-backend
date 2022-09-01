<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;

class ProjectPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change status project to reject if payment is not received after 24 hours';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        Project::where('status', '=', 'not_paid')
            ->where('created_at', '<', now()->subHours(24))
            ->update([
                'status' => 'reject',
                'reject_reason' => 'Payment is not received',
                'updated_at' => now(),
            ]);
    }
}
