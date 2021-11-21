<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class RestoreDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:restore {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will restore the database';

    /**
     * @var Process
     */
    protected $process;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = $this->option('path');
        $this->process = Process::fromShellCommandline(sprintf(
            'psql -U %s %s < %s',
            config('database.connections.pgsql.username'),
            config('database.connections.pgsql.database'),
            $path
        ));
        try {
            $this->call('migrate:fresh');
            $this->info('The restore has been started');
            $this->process->mustRun();
            $this->info('The restore has been proceed successfully.');
        } catch (ProcessFailedException $exception) {
            logger()->error('restore exception', compact('exception'));
            $this->error('The restore process has been failed.');
        }
    }
}
