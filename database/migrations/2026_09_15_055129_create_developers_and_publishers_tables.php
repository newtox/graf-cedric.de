<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::table('games', function (Blueprint $table) {
            $table->foreignId('developer_id')->nullable()->after('slug')->constrained()->nullOnDelete();
            $table->foreignId('publisher_id')->nullable()->after('developer_id')->constrained()->nullOnDelete();
        });

        // Bestehende Daten übernehmen: pro einzigartigem Namen genau einen
        // Developer/Publisher-Datensatz anlegen (erstes gefundenes Bild gewinnt),
        // dann jedes Game darauf verweisen lassen.
        DB::table('games')->select('id', 'developer_name', 'developer_image', 'publisher_name', 'publisher_image')
            ->orderBy('id')
            ->get()
            ->each(function ($game) {
                $developerId = DB::table('developers')->where('name', $game->developer_name)->value('id');
                if (! $developerId) {
                    $developerId = DB::table('developers')->insertGetId([
                        'name' => $game->developer_name,
                        'image' => $game->developer_image,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $publisherId = DB::table('publishers')->where('name', $game->publisher_name)->value('id');
                if (! $publisherId) {
                    $publisherId = DB::table('publishers')->insertGetId([
                        'name' => $game->publisher_name,
                        'image' => $game->publisher_image,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('games')->where('id', $game->id)->update([
                    'developer_id' => $developerId,
                    'publisher_id' => $publisherId,
                ]);
            });

        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn(['developer_name', 'developer_image', 'publisher_name', 'publisher_image']);
        });
    }

    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->string('developer_name')->nullable();
            $table->string('developer_image')->nullable();
            $table->string('publisher_name')->nullable();
            $table->string('publisher_image')->nullable();
        });

        DB::table('games')->get()->each(function ($game) {
            $developer = DB::table('developers')->find($game->developer_id);
            $publisher = DB::table('publishers')->find($game->publisher_id);

            DB::table('games')->where('id', $game->id)->update([
                'developer_name' => $developer?->name,
                'developer_image' => $developer?->image,
                'publisher_name' => $publisher?->name,
                'publisher_image' => $publisher?->image,
            ]);
        });

        Schema::table('games', function (Blueprint $table) {
            $table->dropConstrainedForeignId('developer_id');
            $table->dropConstrainedForeignId('publisher_id');
        });

        Schema::dropIfExists('publishers');
        Schema::dropIfExists('developers');
    }
};
