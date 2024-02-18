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
        // Default All Permission
        $allPermission = [
            [
                'name' => 'manage user',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'create user',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'edit user',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'delete user',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'manage role',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'create role',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'edit role',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'delete role',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'manage contact',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'create contact',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'edit contact',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'delete contact',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'manage support',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'create support',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'edit support',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'delete support',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'reply support',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'manage note',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'create note',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'edit note',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'delete note',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'manage logged history',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ],
            [
                'name' => 'delete logged history',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ],
            [
                'name' => 'manage pricing packages',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'create pricing packages',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'edit pricing packages',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'delete pricing packages',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'buy pricing packages',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'manage coupon',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'create coupon',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'edit coupon',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'delete coupon',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'manage coupon history',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'delete coupon history',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'manage pricing transation',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'manage account settings',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ],
            [
                'name' => 'manage password settings',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'manage general settings',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ],
            [
                'name' => 'manage company settings',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'manage email settings',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'manage payment settings',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'manage seo settings',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'manage google recaptcha settings',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],


            [
                'name'=>'manage category',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'create category',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'edit category',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'delete category',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'manage sub category',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'create sub category',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'edit sub category',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'delete sub category',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'manage tag',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'create tag',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'edit tag',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'delete tag',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'manage document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'create document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'edit document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'delete document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'show document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'manage my document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'edit my document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'delete my document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'show my document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'create my document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'manage reminder',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'create reminder',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'edit reminder',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'delete reminder',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'show reminder',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'manage my reminder',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'manage document history',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'download document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'preview document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'manage comment',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'create comment',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'manage version',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'create version',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'manage share document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'delete share document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'create share document',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'manage mail',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'send mail',
                'gaurd_name'=>'web',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],

        ];
        Permission::insert($allPermission);

        // Default Super Admin Role
        $systemSuperAdminRole = Role::create(
            [
                'name' => 'super admin',
                'parent_id' => 0,
            ]
        );
        $systemSuperAdminPermission = [
            ['name' => 'manage user'],
            ['name' => 'create user'],
            ['name' => 'edit user'],
            ['name' => 'delete user'],
            ['name' => 'manage contact'],
            ['name' => 'create contact'],
            ['name' => 'edit contact'],
            ['name' => 'delete contact'],
            ['name' => 'manage support'],
            ['name' => 'create support'],
            ['name' => 'edit support'],
            ['name' => 'delete support'],
            ['name' => 'reply support'],
            ['name' => 'manage note'],
            ['name' => 'create note'],
            ['name' => 'edit note'],
            ['name' => 'delete note'],
            ['name' => 'manage pricing packages'],
            ['name' => 'create pricing packages'],
            ['name' => 'edit pricing packages'],
            ['name' => 'delete pricing packages'],
            ['name' => 'manage pricing transation'],
            ['name' => 'manage coupon'],
            ['name' => 'create coupon'],
            ['name' => 'edit coupon'],
            ['name' => 'delete coupon'],
            ['name' => 'manage coupon history'],
            ['name' => 'delete coupon history'],
            ['name' => 'manage account settings'],
            ['name' => 'manage password settings'],
            ['name' => 'manage general settings'],
            ['name' => 'manage email settings'],
            ['name' => 'manage payment settings'],
            ['name' => 'manage seo settings'],
            ['name' => 'manage google recaptcha settings'],


        ];
        $systemSuperAdminRole->givePermissionTo($systemSuperAdminPermission);
        // Default Super Admin
        $systemSuperAdmin = User::create(
            [
                'first_name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'super admin',
                'lang' => 'english',
                'profile' => 'avatar.png',
                'parent_id' => 0,
            ]
        );
        $systemSuperAdmin->assignRole($systemSuperAdminRole);

        // Default Owner Role
        $systemOwnerRole = Role::create(
            [
                'name' => 'owner',
                'parent_id' => $systemSuperAdmin->id,
            ]
        );

        // Default Owner All Permissions
        $systemOwnerPermission = [
            ['name' => 'manage user'],
            ['name' => 'create user'],
            ['name' => 'edit user'],
            ['name' => 'delete user'],
            ['name' => 'manage role'],
            ['name' => 'create role'],
            ['name' => 'edit role'],
            ['name' => 'delete role'],
            ['name' => 'manage contact'],
            ['name' => 'create contact'],
            ['name' => 'edit contact'],
            ['name' => 'delete contact'],
            ['name' => 'manage support'],
            ['name' => 'create support'],
            ['name' => 'edit support'],
            ['name' => 'delete support'],
            ['name' => 'reply support'],
            ['name' => 'manage note'],
            ['name' => 'create note'],
            ['name' => 'edit note'],
            ['name' => 'delete note'],
            ['name' => 'manage logged history'],
            ['name' => 'delete logged history'],
            ['name' => 'manage pricing packages'],
            ['name' => 'buy pricing packages'],
            ['name' => 'manage pricing transation'],
            ['name' => 'manage account settings'],
            ['name' => 'manage account settings'],
            ['name' => 'manage password settings'],
            ['name' => 'manage general settings'],
            ['name' => 'manage company settings'],

            ['name'=>'manage category'],
            ['name'=>'create category'],
            ['name'=>'edit category'],
            ['name'=>'delete category'],
            ['name'=>'manage sub category'],
            ['name'=>'create sub category'],
            ['name'=>'edit sub category'],
            ['name'=>'delete sub category'],
            ['name'=>'manage tag'],
            ['name'=>'create tag'],
            ['name'=>'edit tag'],
            ['name'=>'delete tag'],
            ['name'=>'manage document'],
            ['name'=>'create document'],
            ['name'=>'edit document'],
            ['name'=>'delete document'],
            ['name'=>'show document'],
            ['name'=>'manage my document'],
            ['name'=>'edit my document'],
            ['name'=>'delete my document'],
            ['name'=>'show my document'],
            ['name'=>'create my document'],
            ['name'=>'manage reminder'],
            ['name'=>'create reminder'],
            ['name'=>'edit reminder'],
            ['name'=>'delete reminder'],
            ['name'=>'show reminder'],
            ['name'=>'manage my reminder'],
            ['name'=>'manage document history'],
            ['name'=>'download document'],
            ['name'=>'preview document'],
            ['name'=>'manage comment'],
            ['name'=>'create comment'],
            ['name'=>'manage version'],
            ['name'=>'create version'],
            ['name'=>'manage share document'],
            ['name'=>'delete share document'],
            ['name'=>'create share document'],
            ['name'=>'manage mail'],
            ['name'=>'send mail'],
        ];
        $systemOwnerRole->givePermissionTo($systemOwnerPermission);

        // Default Owner Create
        $systemOwner = User::create(
            [
                'first_name' => 'Owner',
                'email' => 'owner@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'owner',
                'lang' => 'english',
                'profile' => 'avatar.png',
                'subscription' => 1,
                'parent_id' => $systemSuperAdmin->id,
            ]
        );
        // Default Owner Role Assign
        $systemOwner->assignRole($systemOwnerRole);


        // Default Owner Role
        $systemManagerRole = Role::create(
            [
                'name' => 'manager',
                'parent_id' => $systemOwner->id,
            ]
        );
        // Default Manager All Permissions
        $systemManagerPermission = [
            ['name' => 'manage user'],
            ['name' => 'create user'],
            ['name' => 'edit user'],
            ['name' => 'delete user'],
            ['name' => 'manage contact'],
            ['name' => 'create contact'],
            ['name' => 'edit contact'],
            ['name' => 'delete contact'],
            ['name' => 'manage support'],
            ['name' => 'create support'],
            ['name' => 'edit support'],
            ['name' => 'delete support'],
            ['name' => 'reply support'],
            ['name' => 'manage note'],
            ['name' => 'create note'],
            ['name' => 'edit note'],
            ['name' => 'delete note'],

            ['name'=>'manage category'],
            ['name'=>'create category'],
            ['name'=>'edit category'],
            ['name'=>'delete category'],
            ['name'=>'manage sub category'],
            ['name'=>'create sub category'],
            ['name'=>'edit sub category'],
            ['name'=>'delete sub category'],
            ['name'=>'manage tag'],
            ['name'=>'create tag'],
            ['name'=>'edit tag'],
            ['name'=>'delete tag'],
            ['name'=>'manage document'],
            ['name'=>'create document'],
            ['name'=>'edit document'],
            ['name'=>'delete document'],
            ['name'=>'show document'],
            ['name'=>'manage my document'],
            ['name'=>'edit my document'],
            ['name'=>'delete my document'],
            ['name'=>'show my document'],
            ['name'=>'create my document'],
            ['name'=>'manage reminder'],
            ['name'=>'create reminder'],
            ['name'=>'edit reminder'],
            ['name'=>'delete reminder'],
            ['name'=>'show reminder'],
            ['name'=>'manage my reminder'],
            ['name'=>'manage document history'],
            ['name'=>'download document'],
            ['name'=>'preview document'],
            ['name'=>'manage comment'],
            ['name'=>'create comment'],
            ['name'=>'manage version'],
            ['name'=>'create version'],
            ['name'=>'manage share document'],
            ['name'=>'delete share document'],
            ['name'=>'create share document'],
            ['name'=>'manage mail'],
            ['name'=>'send mail'],
        ];
        $systemManagerRole->givePermissionTo($systemManagerPermission);
        // Default Manager Create
        $systemManager = User::create(
            [
                'first_name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'manager',
                'lang' => 'english',
                'profile' => 'avatar.png',
                'subscription' => 0,
                'parent_id' => $systemOwner->id,
            ]
        );
        // Default Manager Role Assign
        $systemManager->assignRole($systemManagerRole);


        // Default employee role
        $systemEmployeeRole = Role::create(
            [
                'name' => 'employee',
                'parent_id' => $systemOwner->id,
            ]
        );
        // Default employee permissions
        $systemEmployeePermissions = [
            ['name'=>'manage contact'],
            ['name'=>'create contact'],
            ['name'=>'edit contact'],
            ['name'=>'delete contact'],
            ['name'=>'manage support'],
            ['name'=>'create support'],
            ['name'=>'edit support'],
            ['name'=>'delete support'],
            ['name'=>'reply support'],
            ['name'=>'manage note'],
            ['name'=>'create note'],
            ['name'=>'edit note'],
            ['name'=>'delete note'],
            ['name'=>'manage my document'],
            ['name'=>'edit my document'],
            ['name'=>'delete my document'],
            ['name'=>'show my document'],
            ['name'=>'create my document'],
            ['name'=>'show reminder'],
            ['name'=>'manage my reminder'],
            ['name'=>'download document'],
            ['name'=>'preview document'],
            ['name'=>'manage comment'],
            ['name'=>'create comment'],
            ['name'=>'manage version'],
            ['name'=>'manage share document'],
            ['name'=>'create share document'],
        ];
        $systemEmployeeRole->givePermissionTo($systemEmployeePermissions);

        // Default employee
        $systemEmployee = User::create(
            [
                'first_name' => 'Employee',
                'email' => 'employee@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'employee',
                'lang' => 'english',
                'profile' => 'avatar.png',
                'subscription' => 0,
                'parent_id' => $systemOwner->id,
            ]
        );

        // Default employee role assign
        $systemEmployee->assignRole($systemEmployeeRole);


    }
}
