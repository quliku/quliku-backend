<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProjectDone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:done';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change project status to done if project is finished automatically after 24 hours';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        DB::table('projects')
            ->leftJoinSub(
                DB::table('reports')
                    ->select('project_id', DB::raw('MAX(created_at) as created_at, MAX(percentage) as percentage'))
                    ->groupBy('project_id'),
                'project_report',
                'project_report.project_id',
                '=',
                'projects.id'
            )->where('projects.status', '=', 'ongoing')
            ->where('project_report.percentage', '=', 100)
            ->where('project_report.created_at', '<', now()->subHours(24))
            ->update([
                'projects.status' => 'done',
                'projects.updated_at' => now(),
            ]);
    }
}
