<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrPermissions = [
            'manage user',
            'create user',
            'edit user',
            'delete user',
            'manage role',
            'create role',
            'edit role',
            'delete role',
            'manage contact',
            'create contact',
            'edit contact',
            'delete contact',
            'manage support',
            'create support',
            'edit support',
            'delete support',
            'reply support',
            'manage note',
            'create note',
            'edit note',
            'delete note',
            'manage account settings',
            'manage password settings',
            'manage general settings',
            'manage company settings',

        ];
        foreach($arrPermissions as $ap)
        {
            Permission::create(['name' => $ap]);
        }


        // Default Super admin
        $superAdmin = User::create(
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'super admin',
                'lang' => 'english',
                'profile' => 'avatar.png',
                'parent_id' => 0,
            ]
        );

        // Default admin role
        $adminRole = Role::create(
            [
                'name' => 'owner',
                'parent_id' => $superAdmin->id,
            ]
        );
        // Default admin permissions
        $adminPermissions = [
            'manage user',
            'create user',
            'edit user',
            'delete user',
            'manage role',
            'create role',
            'edit role',
            'delete role',
            'manage contact',
            'create contact',
            'edit contact',
            'delete contact',
            'manage support',
            'create support',
            'edit support',
            'delete support',
            'reply support',
            'manage note',
            'create note',
            'edit note',
            'delete note',
            'manage account settings',
            'manage password settings',
            'manage general settings',
            'manage company settings',
        ];
        foreach($adminPermissions as $ap)
        {
            $permission = Permission::findByName($ap);
            $adminRole->givePermissionTo($permission);
        }
        // Default admin
        $admin = User::create(
            [
                'name' => 'Owner',
                'email' => 'owner@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'admin',
                'lang' => 'english',
                'profile' => 'avatar.png',
                'subscription' => 1,
                'parent_id' => $superAdmin->id,
            ]
        );
        // Default admin role assign
        $admin->assignRole($adminRole);


        // Default admin role
        $managerRole = Role::create(
            [
                'name' => 'manager',
                'parent_id' => $admin->id,
            ]
        );
        // Default admin permissions
        $managerPermissions = [
            'manage user',
            'create user',
            'edit user',
            'delete user',
            'manage role',
            'create role',
            'edit role',
            'delete user',
            'manage contact',
            'create contact',
            'edit contact',
            'delete contact',
            'manage support',
            'create support',
            'edit support',
            'delete support',
            'reply support',
            'manage note',
            'create note',
            'edit note',
            'delete note',
        ];
        foreach($managerPermissions as $ap)
        {
            $permission = Permission::findByName($ap);
            $managerRole->givePermissionTo($permission);
        }
        // Default admin
        $manager = User::create(
            [
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'manager',
                'lang' => 'english',
                'profile' => 'avatar.png',
                'subscription' => 1,
                'parent_id' => $admin->id,
            ]
        );
        // Default admin role assign
        $manager->assignRole($managerRole);

    }
}
