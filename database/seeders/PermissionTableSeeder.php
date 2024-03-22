<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'product-list',
           'product-create',
           'product-edit',
           'product-delete',
           'class-list',
           'class-create',
           'class-edit',
           'class-delete',

           'class-wise-subject-list',
           'class-wise-subject-create',
           'class-wise-subject-edit',
           'class-wise-subject-delete',

           'manage-student-list',
           'manage-student-create',
           'manage-student-edit',
           'manage-student-delete',

           'manage-teacher-list',
           'manage-teacher-create',
           'manage-teacher-edit',
           'manage-teacher-delete',

           'manage-class-one-students',
           'manage-class-tow-students',
           'manage-class-three-students',
           'manage-class-four-students',
           'manage-class-five-students',
           'manage-class-six-students',
           'manage-class-seven-students',
           'manage-class-eight-students',
           'manage-class-nine-students',
           'manage-class-ten-students',

           
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
