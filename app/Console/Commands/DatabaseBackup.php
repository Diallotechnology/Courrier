<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $backupPath = storage_path('app/backups');
        $backupFilename = 'backup-' . date('Y-m-d_His') . '.sql';

        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0777, true);
        }

        $databaseName = config('database.connections.mysql.database');
        $databaseUser = config('database.connections.mysql.username');
        $databasePassword = config('database.connections.mysql.password');

        $command = "mysqldump -u {$databaseUser} -p{$databasePassword} {$databaseName} > {$backupPath}/{$backupFilename}";

        exec($command);

        $this->info('Database backup created successfully!');
    }
}
