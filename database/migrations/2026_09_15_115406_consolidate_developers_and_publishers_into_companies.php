<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::table('games', function (Blueprint $table) {
            $table->foreignId('developer_company_id')->nullable()->after('developer_id')->constrained('companies')->nullOnDelete();
            $table->foreignId('publisher_company_id')->nullable()->after('publisher_id')->constrained('companies')->nullOnDelete();
        });

        // Developer- und Publisher-Firmen anhand des Namens zu einer
        // einzigen companies-Zeile zusammenführen. Existiert derselbe Name
        // in beiden Tabellen, gewinnt das erste gefundene Bild.
        $companyIdByName = [];

        DB::table('developers')->orderBy('id')->get()->each(function ($dev) use (&$companyIdByName) {
            if (! isset($companyIdByName[$dev->name])) {
                $companyIdByName[$dev->name] = DB::table('companies')->insertGetId([
                    'name' => $dev->name,
                    'image' => $dev->image,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } elseif (empty(DB::table('companies')->where('id', $companyIdByName[$dev->name])->value('image')) && $dev->image) {
                DB::table('companies')->where('id', $companyIdByName[$dev->name])->update(['image' => $dev->image]);
            }
        });

        DB::table('publishers')->orderBy('id')->get()->each(function ($pub) use (&$companyIdByName) {
            if (! isset($companyIdByName[$pub->name])) {
                $companyIdByName[$pub->name] = DB::table('companies')->insertGetId([
                    'name' => $pub->name,
                    'image' => $pub->image,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } elseif (empty(DB::table('companies')->where('id', $companyIdByName[$pub->name])->value('image')) && $pub->image) {
                DB::table('companies')->where('id', $companyIdByName[$pub->name])->update(['image' => $pub->image]);
            }
        });

        // games auf die neuen, zusammengeführten Spalten umbiegen
        DB::table('games')->select('id', 'developer_id', 'publisher_id')->get()->each(function ($game) use ($companyIdByName) {
            $devName = DB::table('developers')->where('id', $game->developer_id)->value('name');
            $pubName = DB::table('publishers')->where('id', $game->publisher_id)->value('name');

            DB::table('games')->where('id', $game->id)->update([
                'developer_company_id' => $devName ? ($companyIdByName[$devName] ?? null) : null,
                'publisher_company_id' => $pubName ? ($companyIdByName[$pubName] ?? null) : null,
            ]);
        });

        Schema::table('games', function (Blueprint $table) {
            $table->dropConstrainedForeignId('developer_id');
        });
        Schema::table('games', function (Blueprint $table) {
            $table->dropConstrainedForeignId('publisher_id');
        });

        Schema::dropIfExists('developers');
        Schema::dropIfExists('publishers');
    }

    public function down(): void
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
            $table->foreignId('developer_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('publisher_id')->nullable()->constrained()->nullOnDelete();
        });

        DB::table('games')->select('id', 'developer_company_id', 'publisher_company_id')->get()->each(function ($game) {
            $dev = DB::table('companies')->find($game->developer_company_id);
            $pub = DB::table('companies')->find($game->publisher_company_id);

            $devId = null;
            if ($dev) {
                $devId = DB::table('developers')->insertGetId([
                    'name' => $dev->name, 'image' => $dev->image, 'created_at' => now(), 'updated_at' => now(),
                ]);
            }
            $pubId = null;
            if ($pub) {
                $pubId = DB::table('publishers')->insertGetId([
                    'name' => $pub->name, 'image' => $pub->image, 'created_at' => now(), 'updated_at' => now(),
                ]);
            }

            DB::table('games')->where('id', $game->id)->update([
                'developer_id' => $devId,
                'publisher_id' => $pubId,
            ]);
        });

        Schema::table('games', function (Blueprint $table) {
            $table->dropConstrainedForeignId('developer_company_id');
            $table->dropConstrainedForeignId('publisher_company_id');
        });

        Schema::dropIfExists('companies');
    }
};
