<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
            'slug' => $this->faker->jobTitle,
        ];
    }

    public function configure()
    {
       
        return $this->afterCreating(function (Role $role) {
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 1],['slug' => 'view-patient' ,'name' => 'View Patient']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 2],['slug' => 'create-patient', 'name' => 'Create Patient']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 3],['slug' => 'edit-patient' , 'name' => 'Edit Patient']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 4],['slug' => 'delete-patient' , 'name' => 'Delete Patient']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 5],['slug' => 'view-appointment' , 'name' => 'View Appointment']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 6],['slug' => 'create-appointment' , 'name' => 'Create Appointment']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 7],['slug' => 'edit-appointment' , 'name' => 'Edit Appointment']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 8],['slug' => 'delete-appointment' , 'name' => 'Delete Appointment']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 9],['slug' => 'view-visit' , 'name' => 'View Visit']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 10],['slug' => 'create-visit' , 'name' => 'Create Visit']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 11],['slug' => 'edit-visit' , 'name' => 'Edit Visit']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 12],['slug' => 'delete-visit' , 'name' => 'Delete Visit']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 13],['slug' => 'view-treatment' , 'name' => 'View Treatment']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 14],['slug' => 'create-treatment' , 'name' => 'Create Treatment']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 15],['slug' => 'edit-treatment' , 'name' => 'Edit Treatment']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 16],['slug' => 'delete-treatment' , 'name' => 'Delete Treatment']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 17],['slug' => 'view-report' , 'name' => 'View Report']));
            $role->permissions()->attach(Permission::firstOrCreate(['id' => 18],['slug' => 'create-report' , 'name' => 'Create Report']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 19],['slug' => 'edit-report' , 'name' => 'Edit Report']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 20],['slug' => 'delete-report' , 'name' => 'Delete Report']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 21],['slug' => 'view-services' , 'name' => 'View Services']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 22],['slug' => 'create-services' , 'name' => 'Create Services']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 23],['slug' => 'edit-services' , 'name' => 'Edit Services']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 24],['slug' => 'delete-services' , 'name' => 'Delete Services']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 25],['slug' => 'view-user' , 'name' => 'View User']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 26],['slug' => 'create-user' , 'name' => 'Create User']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 27],['slug' => 'edit-user' , 'name' => 'Edit User']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 28],['slug' => 'delete-user' , 'name' => 'Delete User']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 29],['slug' => 'view-role' , 'name' => 'View Role']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 30],['slug' => 'create-role' , 'name' => 'Create Role']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 31],['slug' => 'edit-role' , 'name' => 'Edit Role']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 32],['slug' => 'delete-role' , 'name' => 'Delete Role']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 33],['slug' => 'view-debt' , 'name' => 'View Debt']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 34],['slug' => 'create-debt' , 'name' => 'Create Debt']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 35],['slug' => 'edit-debt' , 'name' => 'Edit Debt']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 36],['slug' => 'delete-debt' , 'name' => 'Delete Debt']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 37],['slug' => 'view-bill' , 'name' => 'View Bill']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 38],['slug' => 'create-bill' , 'name' => 'Create Bill']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 39],['slug' => 'edit-bill' , 'name' => 'Edit Bill']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 40],['slug' => 'delete-bill' , 'name' => 'Delete Bill']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 41],['slug' => 'view-payment' , 'name' => 'View Payment']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 42],['slug' => 'create-payment' , 'name' => 'Create Payment']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 43],['slug' => 'edit-payment' , 'name' => 'Edit Payment']));
             $role->permissions()->attach(Permission::firstOrCreate(['id' => 44],['slug' => 'delete-payment' , 'name' => 'Delete Payment']));
        });
    }
}
