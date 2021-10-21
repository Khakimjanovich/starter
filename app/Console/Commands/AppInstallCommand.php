<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Command\Command as CommandAlias;

class AppInstallCommand extends Command
{
    protected $signature = 'app:install';

    protected $description = 'Creates all the basic things and install everything that is needed';

    private string $admin = 'SuperAdmin';

    private array $permission = [
        //browsing permissions
        [
            'name' => 'browse-dashboard'
        ],
        [
            'name' => 'browse-management'
        ],
        [
            'name' => 'browse-users'
        ],
        [
            'name' => 'browse-roles'
        ],
        [
            'name' => 'browse-permissions'
        ],

        //reading permissions
        [
            'name' => 'read-users'
        ],
        [
            'name' => 'read-roles'
        ],
        [
            'name' => 'read-permissions'
        ],

        //adding permissions
        [
            'name' => 'add-users'
        ],
        [
            'name' => 'add-roles'
        ],
        [
            'name' => 'add-permissions'
        ],

        //editing permissions
        [
            'name' => 'edit-users'
        ],
        [
            'name' => 'edit-roles'
        ],
        [
            'name' => 'edit-permissions'
        ],

        //deleting permissions
        [
            'name' => 'delete-users'
        ],
        [
            'name' => 'delete-roles'
        ],
        [
            'name' => 'delete-permissions'
        ],


    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->info('Migrating tables');
        Artisan::call('migrate:fresh');
        $this->info('Tables migrated successfully!');

        $this->info('Creating permissions');
        foreach ($this->permission as $permission) {
            Permission::create($permission);
        }
        $this->info('Permissions has been created successfully');

        $this->info('Creating a role');
        $role = Role::create([
            'name' => $this->admin
        ]);
        $this->info('Attaching permissions to the role');
        $permissions = Permission::all('name')->map(function ($permission) {
            return $permission->name;
        })->toArray();
        $role->syncPermissions($permissions);
        $this->info('Creating a user');
        $user = User::create([
            'name' => 'Yunusali Abduraxmanov',
            'email' => 'yunusalikhakimjanovich@gmail.com',
            'password' => bcrypt('password')
        ]);
        $this->info('Giving a user the role');

        $user->assignRole($role);

        $this->info('Application installed successfully');

        return CommandAlias::SUCCESS;
    }
}
