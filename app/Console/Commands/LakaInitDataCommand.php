<?php

namespace App\Console\Commands;

use App\Models\Menus\Menus;
use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LakaInitDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laka-tool:init {--reset}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        if ($this->option('reset')) {
            $this->info('Reset database ...');
            Schema::dropIfExists('feature_api');
            Schema::dropIfExists('list_function');
            Schema::dropIfExists('role');
            Schema::dropIfExists('role_has_feature_api');
            Schema::dropIfExists('role_user');

            $results = DB::select("SELECT t.TABLE_NAME,c.COLUMN_NAME
                FROM information_schema.`TABLES` t
                JOIN information_schema.`COLUMNS` c ON t.TABLE_NAME = c.TABLE_NAME
                    AND t.TABLE_SCHEMA = c.TABLE_SCHEMA
                WHERE t.TABLE_SCHEMA = DATABASE()
                    AND c.COLUMN_NAME = ?", ['deleted_at']);

            foreach(array_column($results, 'TABLE_NAME') as $table) {
                Schema::dropColumns($table, 'deleted_at');
            }

            if (Schema::hasColumn('users', 'role_id')) {
                Schema::dropColumns('users', 'role_id');
            }

            if (!Schema::hasColumn('top_menu', 'route_name')) {
                Schema::table($table, function (Blueprint $blueprint) {
                    $blueprint->string('route_name', 150)->after('index')->nullable();
                });
            }

            $this->info('Reset database: Done!');
        }
        $this->info('Reset menu ...');
        Menus::truncate();
        Artisan::call('db:seed', ['--class' => 'MenuSeeder']);
        $this->info('Reset menu: Done!');
        $this->info('Done!');
        return 0;
    }
}
