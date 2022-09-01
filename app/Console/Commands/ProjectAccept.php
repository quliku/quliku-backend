<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;

class ProjectAccept extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:accept';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reject project if foreman is not accepted after 24 hours';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        Project::where('status', '=', 'waiting')
            ->where('created_at', '<', now()->subHours(24))
            ->update([
                'status' => 'reject',
                'reject_reason' => 'Foreman is not accepted',
            ]);
    }
}
