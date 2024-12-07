<?php

namespace App\Console\Commands;

use App\Models\Game;
use App\Models\Tag;
use Illuminate\Console\Command;

class ExportDatabaseData extends Command
{
    protected $signature = 'db:export';
    protected $description = 'Export database data to JSON';

    public function handle(): void
    {
        $data = [
            'games' => Game::all()->toArray(),
            'tags' => Tag::all()->toArray(),
            'game_tag' => \DB::table('game_tag')->get()->toArray()
        ];

        file_put_contents(
            storage_path('app/db-backup.json'),
            json_encode($data, JSON_PRETTY_PRINT)
        );

        $this->info('Data exported to storage/app/db-backup.json');
    }
}
