<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            "id" => 1,
            "name" => "superadmin",
            "display_name" => "superadmin",
            "email" => "superadmin@example.com",
            "phone" => "082233334444",
            "address" => "Jalan Mawar No. 4",
            "departement" => "Superadmin",
            "password" => Hash::make('password'),
            "status" => 1
        ]);
        $user2 = User::create([
            "id" => 2,
            "name" => "admin",
            "display_name" => "admin",
            "email" => "admin@example.com",
            "phone" => "082233335555",
            "address" => "Jalan Mawar No. 4",
            "departement" => "Admin",
            "password" => Hash::make('password'),
            "status" => 1
        ]);
        $user3 = User::create([
            "id" => 3,

            "name" => "author",
            "display_name" => "author",
            "email" => "author@example.com",
            "phone" => "082233336666",
            "address" => "Jalan Mawar No. 4",
            "departement" => "Author",
            "password" => Hash::make('password'),
            "status" => 1
        ]);

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $arrayOfPermissionNames = [
            'tim-index',
            'transaksi-index',
            'withdrawal-index',
            'withdrawal-update',

            'solusi-index',
            'solusi-add',
            'solusi-update',
            'solusi-delete',
            'client-index',
            'client-add',
            'client-update',
            'client-delete',
            'layanan-index',
            'layanan-add',
            'layanan-update',
            'layanan-delete',
            'faq-index',
            'faq-add',
            'faq-update',
            'faq-delete',
            'testimonial-index',
            'testimonial-add',
            'testimonial-update',
            'testimonial-delete',
            'news-index',
            'news-add',
            'news-update',
            'news-delete',
            'pricing-index',
            'pricing-add',
            'pricing-update',
            'pricing-delete',
            'web-index',
            'web-add',
            'web-update',
            'web-delete',
            'user-index',
            'user-add',
            'user-update',
            'user-delete',
            'role-index',
            'role-add',
            'role-update',
            'role-delete',
            'usp-index',
            'usp-add',
            'usp-update',
            'usp-delete',
        ];

        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());

        $role = Role::create(['name' => 'superadmin'])
            ->givePermissionTo([
            'tim-index',
            'transaksi-index',
            'withdrawal-index',
            'withdrawal-update',
            'solusi-index',
            'solusi-add',
            'solusi-update',
            'solusi-delete',
            'client-index',
            'client-add',
            'client-update',
            'client-delete',
            'layanan-index',
            'layanan-add',
            'layanan-update',
            'layanan-delete',
            'faq-index',
            'faq-add',
            'faq-update',
            'faq-delete',
            'testimonial-index',
            'testimonial-add',
            'testimonial-update',
            'testimonial-delete',
            'news-index',
            'news-add',
            'news-update',
            'news-delete',
            'pricing-index',
            'pricing-add',
            'pricing-update',
            'pricing-delete',
            'web-index',
            'web-add',
            'web-update',
            'web-delete',
            'user-index',
            'user-add',
            'user-update',
            'user-delete',
            'role-index',
            'role-add',
            'role-update',
            'role-delete'
            ]);

            $user1 = $user1->fresh();
            $user1->syncRoles(['superadmin']);
    }
}
