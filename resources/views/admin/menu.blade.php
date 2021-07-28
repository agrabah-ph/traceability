<li class="{{ (request()->is('home')) ? 'active' : '' }}">
    <a href="{!! route('home') !!}"><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span></a>
</li>

{{--<li class="{{ (request()->is('community-leader*')) ? 'active' : '' }}">--}}
{{--    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">User</span><span class="fa arrow"></span></a>--}}
{{--    <ul class="nav nav-second-level collapse">--}}
{{--        <li>--}}
{{--            <a href="#">Community Leader <span class="fa arrow"></span></a>--}}
{{--            <ul class="nav nav-third-level">--}}
{{--                <li class="{{ (request()->is('community-leader')) ? 'active' : '' }}"><a href="{!! route('community-leader.index') !!}">List</a></li>--}}
{{--                <li class="{{ (request()->is('community-leader/create')) ? 'active' : '' }}"><a href="{!! route('community-leader.create') !!}">Create</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="#">Farmer <span class="fa arrow"></span></a>--}}
{{--            <ul class="nav nav-third-level">--}}
{{--                <li class="{{ (request()->is('farmer')) ? 'active' : '' }}"><a href="{!! route('farmer.index') !!}">List</a></li>--}}
{{--                <li class="{{ (request()->is('farmer/create')) ? 'active' : '' }}"><a href="{!! route('farmer.create') !!}">Create</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="#">Loan Provider <span class="fa arrow"></span></a>--}}
{{--            <ul class="nav nav-third-level">--}}
{{--                <li class="{{ (request()->is('farmer')) ? 'active' : '' }}"><a href="{!! route('farmer.index') !!}">List</a></li>--}}
{{--                <li class="{{ (request()->is('farmer/create')) ? 'active' : '' }}"><a href="{!! route('farmer.create') !!}">Create</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--</li>--}}


<li class="{{ (request()->is('community-leader*')) ? 'active' : '' }}">
    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Community Leader</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="{{ (request()->is('master-farmer')) ? 'active' : '' }}"><a href="{!! route('community-leader.index') !!}">List</a></li>
        <li class="{{ (request()->is('master-farmer/create')) ? 'active' : '' }}"><a href="{!! route('community-leader.create') !!}">Create</a></li>
    </ul>
</li>

{{--<li class="{{ (request()->is('farmer*')) ? 'active' : '' }}">--}}
{{--    <a href="{!! route('farmer.index') !!}"><i class="fa fa-user-circle"></i> <span class="nav-label">Farmer</span></a>--}}
{{--</li>--}}

<li class="{{ (request()->is('farmer*')) ? 'active' : '' }}">
    <a href="#"><i class="fa fa-user-circle"></i> <span class="nav-label">Farmers</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="{{ (request()->is('farmer')) ? 'active' : '' }}"><a href="{!! route('farmer.index') !!}">List</a></li>
        <li class="{{ (request()->is('farmer/create')) ? 'active' : '' }}"><a href="{!! route('farmer.create') !!}">Create</a></li>
    </ul>
</li>

<li class="{{ (request()->is('product*')) ? 'active' : '' }}">
    <a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Products</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="{{ (request()->is('product')) ? 'active' : '' }}"><a href="{!! route('product.index') !!}">List</a></li>
        <li class="{{ (request()->is('product/create')) ? 'active' : '' }}"><a href="{!! route('product.create') !!}">Create</a></li>
    </ul>
</li>

<li class="{{ (request()->is('loan/applicants')) ? 'active' : '' }}">
    <a href="{!! route('loan-applicant') !!}"><i class="fa fa-money"></i> <span class="nav-label">Loan Applications</span></a>
</li>

<li class="{{ (request()->is('inventory*')) ? 'active' : '' }}">
    <a href="{!! route('inventory.index') !!}"><i class="fa fa-list-alt"></i> <span class="nav-label">Inventory</span></a>
</li>

<li class="{{ (request()->is('trace*')) ? 'active' : '' }}">
    <a href="{!! route('trace.index') !!}"><i class="fa fa-truck"></i> <span class="nav-label">Trace</span></a>
</li>

<li class="{{ (request()->is('role*')) ? 'active' : '' }}">
    <a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="{{ (request()->is('role*')) ? 'active' : '' }}"><a href="{!! route('role') !!}">Role</a></li>
    </ul>
    <ul class="nav nav-second-level collapse">
        <li class="{{ (request()->is('settings*')) ? 'active' : '' }}"><a href="{!! route('settings.index') !!}">Settings</a></li>
    </ul>
</li>
