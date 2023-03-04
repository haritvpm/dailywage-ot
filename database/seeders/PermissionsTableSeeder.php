<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'employee_access',
            ],
            [
                'id'    => 18,
                'title' => 'category_create',
            ],
            [
                'id'    => 19,
                'title' => 'category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'category_show',
            ],
            [
                'id'    => 21,
                'title' => 'category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'category_access',
            ],
            [
                'id'    => 23,
                'title' => 'designation_create',
            ],
            [
                'id'    => 24,
                'title' => 'designation_edit',
            ],
            [
                'id'    => 25,
                'title' => 'designation_show',
            ],
            [
                'id'    => 26,
                'title' => 'designation_delete',
            ],
            [
                'id'    => 27,
                'title' => 'designation_access',
            ],
            [
                'id'    => 28,
                'title' => 'section_create',
            ],
            [
                'id'    => 29,
                'title' => 'section_edit',
            ],
            [
                'id'    => 30,
                'title' => 'section_show',
            ],
            [
                'id'    => 31,
                'title' => 'section_delete',
            ],
            [
                'id'    => 32,
                'title' => 'section_access',
            ],
            [
                'id'    => 33,
                'title' => 'daily_wage_employee_create',
            ],
            [
                'id'    => 34,
                'title' => 'daily_wage_employee_edit',
            ],
            [
                'id'    => 35,
                'title' => 'daily_wage_employee_show',
            ],
            [
                'id'    => 36,
                'title' => 'daily_wage_employee_delete',
            ],
            [
                'id'    => 37,
                'title' => 'daily_wage_employee_access',
            ],
            [
                'id'    => 38,
                'title' => 'session_create',
            ],
            [
                'id'    => 39,
                'title' => 'session_edit',
            ],
            [
                'id'    => 40,
                'title' => 'session_show',
            ],
            [
                'id'    => 41,
                'title' => 'session_access',
            ],
            [
                'id'    => 42,
                'title' => 'calender_create',
            ],
            [
                'id'    => 43,
                'title' => 'calender_edit',
            ],
            [
                'id'    => 44,
                'title' => 'calender_show',
            ],
            [
                'id'    => 45,
                'title' => 'calender_delete',
            ],
            [
                'id'    => 46,
                'title' => 'calender_access',
            ],
            [
                'id'    => 47,
                'title' => 'duty_form_create',
            ],
            [
                'id'    => 48,
                'title' => 'duty_form_edit',
            ],
            [
                'id'    => 49,
                'title' => 'duty_form_show',
            ],
            [
                'id'    => 50,
                'title' => 'duty_form_delete',
            ],
            [
                'id'    => 51,
                'title' => 'duty_form_access',
            ],
            [
                'id'    => 52,
                'title' => 'duty_form_item_create',
            ],
            [
                'id'    => 53,
                'title' => 'duty_form_item_edit',
            ],
            [
                'id'    => 54,
                'title' => 'duty_form_item_show',
            ],
            [
                'id'    => 55,
                'title' => 'duty_form_item_delete',
            ],
            [
                'id'    => 56,
                'title' => 'duty_form_item_access',
            ],
            [
                'id'    => 57,
                'title' => 'profile_password_edit',
            ],
           
            

        ];

        Permission::insert($permissions);
    }
}
