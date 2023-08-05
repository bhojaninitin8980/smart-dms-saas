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
            'manage category',
            'create category',
            'edit category',
            'delete category',
            'manage sub category',
            'create sub category',
            'edit sub category',
            'delete sub category',
            'manage tag',
            'create tag',
            'edit tag',
            'delete tag',
            'manage document',
            'create document',
            'edit document',
            'delete document',
            'show document',
            'manage my document',
            'edit my document',
            'delete my document',
            'show my document',
            'create my document',
            'manage reminder',
            'create reminder',
            'edit reminder',
            'delete reminder',
            'show reminder',
            'manage my reminder',
            'manage document history',
            'download document',
            'preview document',
            'manage comment',
            'create comment',
            'manage version',
            'create version',
            'manage share document',
            'delete share document',
            'create share document',
            'manage mail',
            'send mail',
            'manage logged history',
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
            'manage category',
            'create category',
            'edit category',
            'delete category',
            'manage sub category',
            'create sub category',
            'edit sub category',
            'delete sub category',
            'manage tag',
            'create tag',
            'edit tag',
            'delete tag',
            'manage document',
            'create document',
            'edit document',
            'delete document',
            'show document',
            'manage my document',
            'edit my document',
            'delete my document',
            'show my document',
            'create my document',
            'manage reminder',
            'create reminder',
            'edit reminder',
            'delete reminder',
            'show reminder',
            'manage my reminder',
            'manage document history',
            'download document',
            'preview document',
            'manage comment',
            'create comment',
            'manage version',
            'create version',
            'manage share document',
            'delete share document',
            'create share document',
            'manage mail',
            'send mail',
            'manage logged history',
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
            'manage document',
            'create document',
            'edit document',
            'delete document',
            'show document',
            'manage my document',
            'edit my document',
            'delete my document',
            'show my document',
            'create my document',
            'manage reminder',
            'create reminder',
            'edit reminder',
            'delete reminder',
            'show reminder',
            'manage my reminder',
            'manage document history',
            'download document',
            'preview document',
            'manage comment',
            'create comment',
            'manage version',
            'create version',
            'manage share document',
            'delete share document',
            'create share document',
            'manage mail',
            'send mail',
            'manage logged history',
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
                'subscription' => 0,
                'parent_id' => $admin->id,
            ]
        );
        // Default admin role assign
        $manager->assignRole($managerRole);


        // Default Employee role
        $employeeRole = Role::create(
            [
                'name' => 'employee',
                'parent_id' => $admin->id,
            ]
        );
        // Default admin permissions
        $employeePermissions = [
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
            'manage my document',
            'edit my document',
            'delete my document',
            'show my document',
            'create my document',
            'show reminder',
            'manage my reminder',
            'download document',
            'preview document',
            'manage comment',
            'create comment',
            'manage version',
            'manage share document',
            'create share document',
        ];
        foreach($employeePermissions as $ap)
        {
            $permission = Permission::findByName($ap);
            $employeeRole->givePermissionTo($permission);
        }
        // Default admin
        $employee = User::create(
            [
                'name' => 'Employee',
                'email' => 'employee@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'employee',
                'lang' => 'english',
                'profile' => 'avatar.png',
                'subscription' => 0,
                'parent_id' => $admin->id,
            ]
        );
        // Default admin role assign
        $employee->assignRole($employeeRole);

    }
}
