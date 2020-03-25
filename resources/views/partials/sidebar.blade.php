@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="{{ route('admin.users.index') }}">
                        <i class="fe-users"></i>
                        <span> @lang('cruds.userManagement.title') </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.users.index') }}">
                                <span> @lang('cruds.user.title') </span>
                            </a>
                        </li>
                        @can('admin_permission')
                        <li>
                            <a href="{{ route('admin.permissions.index') }}">
                                <span>@lang('cruds.permission.title')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.roles.index') }}">
                                <span>@lang('cruds.role.title')</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.company.index') }}">
                        <i class="fe-users"></i>
                        <span> @lang('cruds.company.title') </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}
