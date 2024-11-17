<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Attorney;
use App\Models\Company;
use App\Models\Driver;
use App\Models\Manager;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // Define permissions
        Permission::create(['name' => 'create tickets']);
        Permission::create(['name' => 'read tickets']);
        Permission::create(['name' => 'update tickets']);
        Permission::create(['name' => 'delete tickets']);

        Permission::create(['name' => 'create company']);
        Permission::create(['name' => 'read company']);
        Permission::create(['name' => 'update company']);
        Permission::create(['name' => 'delete company']);


        Permission::create(['name' => 'create attorneys']);
        Permission::create(['name' => 'read attorneys']);
        Permission::create(['name' => 'update attorneys']);
        Permission::create(['name' => 'delete attorneys']);

        Permission::create(['name' => 'create drivers']);
        Permission::create(['name' => 'read drivers']);
        Permission::create(['name' => 'update drivers']);
        Permission::create(['name' => 'delete drivers']);


        Permission::create(['name' => 'create citation']);
        Permission::create(['name' => 'read citation']);
        Permission::create(['name' => 'update citation']);
        Permission::create(['name' => 'delete citation']);

        Permission::create(['name' => 'write.company.*']);

        // Define the admin role and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'create tickets',
            'read tickets',
            'update tickets',
            'delete tickets',
            'create company',
            'read company',
            'update company',
            'delete company',
            'create attorneys',
            'read attorneys',
            'update attorneys',
            'delete attorneys',
            'create drivers',
            'read drivers',
            'update drivers',
            'delete drivers',
            'create citation',
            'read citation',
            'update citation',
            'delete citation',
        ]);

        // Define the company role and assign permissions
        $companyRole = Role::create(['name' => 'company']);
        $companyRole->givePermissionTo([
            'create tickets',
            'read tickets',
            'update tickets',
            'delete tickets',
            'read company',
            'create attorneys',
            'read attorneys',
            'update attorneys',
            'delete attorneys',
            'create drivers',
            'read drivers',
            'update drivers',
            'delete drivers',
        ]);

        // Define the manager role and assign permissions
        $managerRole = Role::create(['name' => 'manager']);
        $managerRole->givePermissionTo([
            'read tickets',
            'read company',
            'read attorneys',
            'read drivers',
        ]);

        // Define the attorney role and assign permissions
        $attorneyRole = Role::create(['name' => 'attorney']);
        $attorneyRole->givePermissionTo([
            'read tickets',
            'read drivers',
        ]);

        // Define the driver role and assign permissions
        $attorneyRole = Role::create(['name' => 'driver']);
        $attorneyRole->givePermissionTo([
            'read tickets',
        ]);
        // Create role Models.
        $admin = Admin::create([]);
        $company = Company::create([]);
        $manager = Manager::create([
            'company_id' => $company->id
        ]);
        $attorney = Attorney::create([]);
        $driver = Driver::create([
            'company_id' => $company->id
        ]);

        // Create users.
        $adminUser = User::factory()->create([
            'name' => 'Admin Account',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin1234'),
            'roleable_id' => $admin->id,
            'roleable_type' => Admin::class,
        ]);
        $adminUser->assignRole('admin');

        $driverUser = User::factory()->create([
            'name' => 'Driver Account',
            'email' => 'driver@example.com',
            'password' => Hash::make('admin1234'),
            'roleable_id' => $driver->id,
            'roleable_type' => Driver::class,
        ]);
        $driverUser->assignRole('driver');

        $companyUser = User::factory()->create([
            'name' => 'Company Account',
            'email' => 'company@example.com',
            'password' => Hash::make('admin1234'),
            'roleable_id' => $company->id,
            'roleable_type' => Company::class,
        ]);
        $companyUser->assignRole('company');

        $managerUser = User::factory()->create([
            'name' => 'Manager Account',
            'email' => 'manager@example.com',
            'password' => Hash::make('admin1234'),
            'roleable_id' => $manager->id,
            'roleable_type' => Manager::class,
        ]);
        $managerUser->assignRole('manager');

        $attorneyUser = User::factory()->create([
            'name' => 'Attorney Account',
            'email' => 'attorney@example.com',
            'password' => Hash::make('admin1234'),
            'roleable_id' => $attorney->id,
            'roleable_type' => Attorney::class,
        ]);
        $attorneyUser->assignRole('attorney');
    }
}
