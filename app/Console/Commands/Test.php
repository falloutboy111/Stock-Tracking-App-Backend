<?php

namespace App\Console\Commands;

use App\Models\UserType;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 't';

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
        UserType::create(["name" => "staff"]);
        UserType::create(["name" => "manager"]);
        
        return 0;
    }
}
