<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate([
            'name'       => RoleEnum::ADMIN->value,
            'guard_name' => 'api'
        ]);
        foreach (PermissionEnum::cases() as $case){
            Permission::create([
                'name'=>$case->value,
                'guard_name' => 'api'
            ]);
        }
        $permissions_id=Permission::all()->pluck('id');
        $role->syncPermissions($permissions_id);
    }
}
