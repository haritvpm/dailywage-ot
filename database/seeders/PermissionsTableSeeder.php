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
                'title' => 'category_create',
            ],
            [
                'id'    => 18,
                'title' => 'category_edit',
            ],
            [
                'id'    => 19,
                'title' => 'category_show',
            ],
            [
                'id'    => 20,
                'title' => 'category_delete',
            ],
            [
                'id'    => 21,
                'title' => 'category_access',
            ],
            [
                'id'    => 22,
                'title' => 'daily_wage_employee_create',
            ],
            [
                'id'    => 23,
                'title' => 'daily_wage_employee_edit',
            ],
            [
                'id'    => 24,
                'title' => 'daily_wage_employee_show',
            ],
            [
                'id'    => 25,
                'title' => 'daily_wage_employee_delete',
            ],
            [
                'id'    => 26,
                'title' => 'daily_wage_employee_access',
            ],
            [
                'id'    => 27,
                'title' => 'designation_create',
            ],
            [
                'id'    => 28,
                'title' => 'designation_edit',
            ],
            [
                'id'    => 29,
                'title' => 'designation_show',
            ],
            [
                'id'    => 30,
                'title' => 'designation_delete',
            ],
            [
                'id'    => 31,
                'title' => 'designation_access',
            ],
            [
                'id'    => 32,
                'title' => 'session_create',
            ],
            [
                'id'    => 33,
                'title' => 'session_edit',
            ],
            [
                'id'    => 34,
                'title' => 'session_show',
            ],
            [
                'id'    => 35,
                'title' => 'session_access',
            ],
            [
                'id'    => 36,
                'title' => 'calender_create',
            ],
            [
                'id'    => 37,
                'title' => 'calender_edit',
            ],
            [
                'id'    => 38,
                'title' => 'calender_show',
            ],
            [
                'id'    => 39,
                'title' => 'calender_delete',
            ],
            [
                'id'    => 40,
                'title' => 'calender_access',
            ],
            [
                'id'    => 41,
                'title' => 'session_duty_item_create',
            ],
            [
                'id'    => 42,
                'title' => 'session_duty_item_edit',
            ],
            [
                'id'    => 43,
                'title' => 'session_duty_item_show',
            ],
            [
                'id'    => 44,
                'title' => 'session_duty_item_delete',
            ],
            [
                'id'    => 45,
                'title' => 'session_duty_item_access',
            ],
            [
                'id'    => 46,
                'title' => 'session_duty_create',
            ],
            [
                'id'    => 47,
                'title' => 'session_duty_edit',
            ],
            [
                'id'    => 48,
                'title' => 'session_duty_show',
            ],
            [
                'id'    => 49,
                'title' => 'session_duty_delete',
            ],
            [
                'id'    => 50,
                'title' => 'session_duty_access',
            ],
            [
                'id'    => 51,
                'title' => 'single_day_duty_create',
            ],
            [
                'id'    => 52,
                'title' => 'single_day_duty_edit',
            ],
            [
                'id'    => 53,
                'title' => 'single_day_duty_show',
            ],
            [
                'id'    => 54,
                'title' => 'single_day_duty_delete',
            ],
            [
                'id'    => 55,
                'title' => 'single_day_duty_access',
            ],
            [
                'id'    => 56,
                'title' => 'employee_access',
            ],
            [
                'id'    => 57,
                'title' => 'single_day_duty_item_create',
            ],
            [
                'id'    => 58,
                'title' => 'single_day_duty_item_edit',
            ],
            [
                'id'    => 59,
                'title' => 'single_day_duty_item_show',
            ],
            [
                'id'    => 60,
                'title' => 'single_day_duty_item_delete',
            ],
            [
                'id'    => 61,
                'title' => 'single_day_duty_item_access',
            ],
            [
                'id'    => 62,
                'title' => 'section_create',
            ],
            [
                'id'    => 63,
                'title' => 'section_edit',
            ],
            [
                'id'    => 64,
                'title' => 'section_show',
            ],
            [
                'id'    => 65,
                'title' => 'section_delete',
            ],
            [
                'id'    => 66,
                'title' => 'section_access',
            ],
            [
                'id'    => 67,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
