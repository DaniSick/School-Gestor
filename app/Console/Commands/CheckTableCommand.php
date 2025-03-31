<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class CheckTableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:check-table {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if a table exists in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $table = $this->argument('table');

        if (Schema::hasTable($table)) {
            $this->info("The table '{$table}' exists in the database.");
        } else {
            $this->error("The table '{$table}' does not exist in the database.");
        }
    }
}
