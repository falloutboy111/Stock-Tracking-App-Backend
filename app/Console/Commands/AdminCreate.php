<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a backend user. ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::create([
            "uuid" => Str::uuid(),
            "name" => "test",
            "email" => "test@gmail.com",
            "password" => Hash::make("1qaz2wsx"),
        ]);
        
        $role = Role::create(['name' => 'super-admin']);
        $permission = Permission::create(['name' => 'god mode']);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'brand-manager']);
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'staff']);

        $permission->assignRole($role);

        $user = User::where(["uuid" => $user->uuid])->first();

        $user->assignRole("super-admin");

        return 0;
    }
}
