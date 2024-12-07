<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupProject extends Command
{
    protected $signature = 'backup:project';
    protected $description = 'Backup project files excluding node_modules and other large directories';

    public function handle(): void
    {
        $date = now()->format('Y-m-d_H-i-s');
        $filename = "backup_{$date}.tar.gz";
        $excludes = "--exclude='./node_modules' --exclude='./vendor' --exclude='./storage/*.log' --exclude='.git'";

        $command = "tar -czf storage/backups/{$filename} {$excludes} .";

        if (!is_dir(storage_path('backups'))) {
            mkdir(storage_path('backups'), 0755, true);
        }

        exec($command);
        $this->info("Backup created: {$filename}");
    }
}
