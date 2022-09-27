<?php

namespace App\Console\Commands;

use App\Models\Region;
use Illuminate\Console\Command;

class SetRegions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'region:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates Regions';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Region::truncate();

        Region::create(["name" => "eastern_cape"]);
        Region::create(["name" => "free_state"]);
        Region::create(["name" => "gauteng"]);
        Region::create(["name" => "kzn"]);
        Region::create(["name" => "limpopo"]);
        Region::create(["name" => "mpumalanga"]);
        Region::create(["name" => "northern_cape"]);
        Region::create(["name" => "western_cape"]);

        return 0;
    }
}
