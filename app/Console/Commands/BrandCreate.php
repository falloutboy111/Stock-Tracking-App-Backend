<?php

namespace App\Console\Commands;

use App\Models\Brand;
use Illuminate\Console\Command;

class BrandCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'brand:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Brand::create([
            "name" => "test"
        ]);
        return 0;
    }
}
