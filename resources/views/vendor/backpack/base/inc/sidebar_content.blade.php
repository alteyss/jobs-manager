<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('application') }}'><i class='nav-icon la la-paper-plane'></i> {{ trans('base.applications') }}</a></li>

@if (backpack_user()->hasRole('Admin'))
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('target') }}'><i class='nav-icon la la-bullseye'></i> {{ trans('base.targets') }}</a></li>
<!-- All models -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-database"></i> {{ trans('base.models') }}</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('degree') }}'><i class='nav-icon la la-graduation-cap'></i> {{ trans('base.degrees') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('region') }}'><i class='nav-icon la la-map-marked'></i> {{ trans('base.regions') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('department') }}'><i class='nav-icon la la-map-signs'></i> {{ trans('base.departments') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('field') }}'><i class='nav-icon la la-building'></i> {{ trans('base.fields') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('job') }}'><i class='nav-icon la la-suitcase'></i> {{ trans('base.jobs') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('state') }}'><i class='nav-icon la la-check-circle'></i> {{ trans('base.states') }}</a></li>
    </ul>
</li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> {{ trans('base.authentication') }}</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>{{ trans('backpack::permissionmanager.users') }}</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>{{ trans('backpack::permissionmanager.roles') }}</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>{{ trans('base.permissions') }}</span></a></li>
    </ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon la la-terminal'></i> Logs</a></li>
@endif