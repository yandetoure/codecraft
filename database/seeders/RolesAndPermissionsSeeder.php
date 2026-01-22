<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Services
            'view_services',
            'create_services',
            'edit_services',
            'delete_services',

            // Packs
            'view_packs',
            'create_packs',
            'edit_packs',
            'delete_packs',

            // Features
            'view_features',
            'create_features',
            'edit_features',
            'delete_features',

            // Projects
            'view_all_projects',
            'view_own_projects',
            'create_projects',
            'edit_projects',
            'delete_projects',
            'change_project_status',

            // Quotes
            'view_quotes',
            'create_quotes',
            'edit_quotes',
            'delete_quotes',
            'send_quotes',

            // Invoices
            'view_invoices',
            'create_invoices',
            'edit_invoices',
            'delete_invoices',

            // Payments
            'view_payments',
            'process_payments',
            'refund_payments',

            // Support Tickets
            'view_all_tickets',
            'view_own_tickets',
            'create_tickets',
            'assign_tickets',
            'resolve_tickets',

            // Appointments
            'view_all_appointments',
            'view_own_appointments',
            'create_appointments',
            'manage_appointments',

            // Users
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',

            // Settings
            'manage_settings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions

        // Super Admin - All permissions
        $superAdmin = Role::create(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin - Most permissions except user management
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'view_services',
            'create_services',
            'edit_services',
            'delete_services',
            'view_packs',
            'create_packs',
            'edit_packs',
            'delete_packs',
            'view_features',
            'create_features',
            'edit_features',
            'delete_features',
            'view_all_projects',
            'create_projects',
            'edit_projects',
            'change_project_status',
            'view_quotes',
            'create_quotes',
            'edit_quotes',
            'send_quotes',
            'view_invoices',
            'create_invoices',
            'edit_invoices',
            'view_payments',
            'process_payments',
            'view_all_tickets',
            'assign_tickets',
            'resolve_tickets',
            'view_all_appointments',
            'manage_appointments',
        ]);

        // Client - Limited permissions
        $client = Role::create(['name' => 'client']);
        $client->givePermissionTo([
            'view_own_projects',
            'view_own_tickets',
            'create_tickets',
            'view_own_appointments',
            'create_appointments',
        ]);

        $this->command->info('Roles and permissions created successfully!');
    }
}
