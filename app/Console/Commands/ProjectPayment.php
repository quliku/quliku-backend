<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        DB::table('projects')
            ->join('users', 'projects.foreman_id', '=', 'users.id')
            ->join('foreman_details', 'users.id', '=', 'foreman_details.user_id')
            ->where('projects.status', '=', 'not_paid')
            ->where('projects.updated_at', '<', now()->subHours(24))
            ->update([
                'projects.status' => 'reject',
                'projects.reject_reason' => 'Payment is not received',
                'projects.updated_at' => now(),
                'foreman_details.status' => 'active',
                'foreman_details.is_work' => false,
                'foreman_details.updated_at' => now(),
            ]);

        Log::info('ProjectPayment command executed');
    }
}
