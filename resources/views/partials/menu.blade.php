<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('session_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.sessions.index") }}" class="nav-link {{ request()->is("admin/sessions") || request()->is("admin/sessions/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-archway">

                            </i>
                            <p>
                                {{ trans('cruds.session.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('calender_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.calenders.index") }}" class="nav-link {{ request()->is("admin/calenders") || request()->is("admin/calenders/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-calendar-alt">

                            </i>
                            <p>
                                {{ trans('cruds.calender.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('employee_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/categories*") ? "menu-open" : "" }} {{ request()->is("admin/daily-wage-employees*") ? "menu-open" : "" }} {{ request()->is("admin/designations*") ? "menu-open" : "" }} {{ request()->is("admin/sections*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/categories*") ? "active" : "" }} {{ request()->is("admin/daily-wage-employees*") ? "active" : "" }} {{ request()->is("admin/designations*") ? "active" : "" }} {{ request()->is("admin/sections*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-address-book">

                            </i>
                            <p>
                                {{ trans('cruds.employee.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.categories.index") }}" class="nav-link {{ request()->is("admin/categories") || request()->is("admin/categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-object-group">

                                        </i>
                                        <p>
                                            {{ trans('cruds.category.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('daily_wage_employee_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.daily-wage-employees.index") }}" class="nav-link {{ request()->is("admin/daily-wage-employees") || request()->is("admin/daily-wage-employees/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.dailyWageEmployee.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('designation_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.designations.index") }}" class="nav-link {{ request()->is("admin/designations") || request()->is("admin/designations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-address-card">

                                        </i>
                                        <p>
                                            {{ trans('cruds.designation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('section_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sections.index") }}" class="nav-link {{ request()->is("admin/sections") || request()->is("admin/sections/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-puzzle-piece">

                                        </i>
                                        <p>
                                            {{ trans('cruds.section.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('session_duty_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.session-duties.index") }}" class="nav-link {{ request()->is("admin/session-duties") || request()->is("admin/session-duties/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-calendar-check">

                            </i>
                            <p>
                                {{ trans('cruds.sessionDuty.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('session_duty_item_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.session-duty-items.index") }}" class="nav-link {{ request()->is("admin/session-duty-items") || request()->is("admin/session-duty-items/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-list-ol">

                            </i>
                            <p>
                                {{ trans('cruds.sessionDutyItem.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('single_day_duty_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.single-day-duties.index") }}" class="nav-link {{ request()->is("admin/single-day-duties") || request()->is("admin/single-day-duties/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-address-card">

                            </i>
                            <p>
                                {{ trans('cruds.singleDayDuty.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('single_day_duty_item_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.single-day-duty-items.index") }}" class="nav-link {{ request()->is("admin/single-day-duty-items") || request()->is("admin/single-day-duty-items/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-list-ol">

                            </i>
                            <p>
                                {{ trans('cruds.singleDayDutyItem.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>