<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('application') }}'><i class='nav-icon la la-paper-plane'></i> Applications</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('target') }}'><i class='nav-icon la la-bullseye'></i> Targets</a></li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>
<!-- All models -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Models</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('degree') }}'><i class='nav-icon la la-graduation-cap'></i> Degrees</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('region') }}'><i class='nav-icon la la-map-marked'></i> Regions</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('department') }}'><i class='nav-icon la la-map-signs'></i> Departments</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('field') }}'><i class='nav-icon la la-building'></i> Fields</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('job') }}'><i class='nav-icon la la-suitcase'></i> Jobs</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('state') }}'><i class='nav-icon la la-check-circle'></i> States</a></li>
    </ul>
</li>