<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list blogs']);
        Permission::create(['name' => 'view blogs']);
        Permission::create(['name' => 'create blogs']);
        Permission::create(['name' => 'update blogs']);
        Permission::create(['name' => 'delete blogs']);

        Permission::create(['name' => 'list blogcategories']);
        Permission::create(['name' => 'view blogcategories']);
        Permission::create(['name' => 'create blogcategories']);
        Permission::create(['name' => 'update blogcategories']);
        Permission::create(['name' => 'delete blogcategories']);

        Permission::create(['name' => 'list blogcomments']);
        Permission::create(['name' => 'view blogcomments']);
        Permission::create(['name' => 'create blogcomments']);
        Permission::create(['name' => 'update blogcomments']);
        Permission::create(['name' => 'delete blogcomments']);

        Permission::create(['name' => 'list experiences']);
        Permission::create(['name' => 'view experiences']);
        Permission::create(['name' => 'create experiences']);
        Permission::create(['name' => 'update experiences']);
        Permission::create(['name' => 'delete experiences']);

        Permission::create(['name' => 'list messages']);
        Permission::create(['name' => 'view messages']);
        Permission::create(['name' => 'create messages']);
        Permission::create(['name' => 'update messages']);
        Permission::create(['name' => 'delete messages']);

        Permission::create(['name' => 'list projects']);
        Permission::create(['name' => 'view projects']);
        Permission::create(['name' => 'create projects']);
        Permission::create(['name' => 'update projects']);
        Permission::create(['name' => 'delete projects']);

        Permission::create(['name' => 'list projectcategories']);
        Permission::create(['name' => 'view projectcategories']);
        Permission::create(['name' => 'create projectcategories']);
        Permission::create(['name' => 'update projectcategories']);
        Permission::create(['name' => 'delete projectcategories']);

        Permission::create(['name' => 'list qualifications']);
        Permission::create(['name' => 'view qualifications']);
        Permission::create(['name' => 'create qualifications']);
        Permission::create(['name' => 'update qualifications']);
        Permission::create(['name' => 'delete qualifications']);

        Permission::create(['name' => 'list skills']);
        Permission::create(['name' => 'view skills']);
        Permission::create(['name' => 'create skills']);
        Permission::create(['name' => 'update skills']);
        Permission::create(['name' => 'delete skills']);

        Permission::create(['name' => 'list sociallinks']);
        Permission::create(['name' => 'view sociallinks']);
        Permission::create(['name' => 'create sociallinks']);
        Permission::create(['name' => 'update sociallinks']);
        Permission::create(['name' => 'delete sociallinks']);

        Permission::create(['name' => 'list testimonials']);
        Permission::create(['name' => 'view testimonials']);
        Permission::create(['name' => 'create testimonials']);
        Permission::create(['name' => 'update testimonials']);
        Permission::create(['name' => 'delete testimonials']);

        Permission::create(['name' => 'list tools']);
        Permission::create(['name' => 'view tools']);
        Permission::create(['name' => 'create tools']);
        Permission::create(['name' => 'update tools']);
        Permission::create(['name' => 'delete tools']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
