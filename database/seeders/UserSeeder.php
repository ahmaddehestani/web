<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name'=>'admin',
            'mobile'=>'9100000000'
        ]);
        $role = Role::where('name',RoleEnum::ADMIN->value)->first();
        $admin->assignRole($role);
        User::factory(10)->create();
    }
}
