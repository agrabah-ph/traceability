<li class="{{ (request()->is('/')) ? 'active' : '' }}">
    <a href="/"><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span></a>
</li>

{{--<li class="">--}}
{{--    <a href="#"><i class="fa fa-user-circle-o"></i> <span class="nav-label">Personnel</span><span class="fa arrow"></span></a>--}}
{{--    <ul class="nav nav-second-level collapse">--}}
{{--        <li class=""><a href="{!! route('personnel.index') !!}">List</a></li>--}}
{{--        @if(auth()->user()->can('add-personnel'))--}}
{{--            <li class=""><a href="{!! route('personnel.create') !!}">Create</a></li>--}}
{{--        @endif--}}
{{--    </ul>--}}
{{--</li>--}}


@if(auth()->user()->hasRole('master-farmer'))
    <li class="">
        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Farmer</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li class=""><a href="{!! route('farmer.index') !!}">List</a></li>
            <li class=""><a href="{!! route('farmer.create') !!}">Create</a></li>
        </ul>
    </li>
@endif

@if(auth()->user()->hasRole('farmer'))
    <li class="">
        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Inventory</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li class=""><a href="{!! route('farmer.index') !!}">List</a></li>
            <li class=""><a href="{!! route('farmer.create') !!}">Create</a></li>
        </ul>
    </li>
@endif

@if(auth()->user()->hasRole('super-admin'))
    <li class="{{ (request()->is('farmer*')) ? 'active' : '' }}">
        <a href="#"><i class="fa fa-user-circle"></i> <span class="nav-label">Farmer</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li class="{{ (request()->is('farmer')) ? 'active' : '' }}"><a href="{!! route('farmer.index') !!}">List</a></li>
            <li class="{{ (request()->is('farmer/create')) ? 'active' : '' }}"><a href="{!! route('farmer.create') !!}">Create</a></li>
        </ul>
    </li>

    <li class="{{ (request()->is('master-farmer*')) ? 'active' : '' }}">
        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Master Farmer</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li class="{{ (request()->is('master-farmer')) ? 'active' : '' }}"><a href="{!! route('master-farmer.index') !!}">List</a></li>
            <li class="{{ (request()->is('master-farmer/create')) ? 'active' : '' }}"><a href="{!! route('master-farmer.create') !!}">Create</a></li>
        </ul>
    </li>

    <li class="{{ (request()->is('product*')) ? 'active' : '' }}">
        <a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Products</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li class="{{ (request()->is('product')) ? 'active' : '' }}"><a href="{!! route('product.index') !!}">List</a></li>
            <li class="{{ (request()->is('product/create')) ? 'active' : '' }}"><a href="{!! route('product.create') !!}">Create</a></li>
        </ul>
    </li>

    <li class="{{ (request()->is('inventory*')) ? 'active' : '' }}">
        <a href="#"><i class="fa fa-list-alt"></i> <span class="nav-label">Inventory</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li class="{{ (request()->is('inventory')) ? 'active' : '' }}"><a href="{!! route('inventory.index') !!}">List</a></li>
            <li class="{{ (request()->is('inventory/create')) ? 'active' : '' }}"><a href="{!! route('inventory.create') !!}">Create</a></li>
        </ul>
    </li>

    <li class="{{ (request()->is('trace*')) ? 'active' : '' }}">
        <a href="#"><i class="fa fa-truck"></i> <span class="nav-label">Trace</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li class="{{ (request()->is('trace')) ? 'active' : '' }}"><a href="{!! route('trace.index') !!}">List</a></li>
            <li class="{{ (request()->is('trace/create')) ? 'active' : '' }}"><a href="{!! route('trace.create') !!}">Create</a></li>
        </ul>
    </li>

{{--    <li class="">--}}
{{--        <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">Administrator</span><span class="fa arrow"></span></a>--}}
{{--        <ul class="nav nav-second-level collapse">--}}
{{--            <li>--}}
{{--                <a href="#">Third Level <span class="fa arrow"></span></a>--}}
{{--                <ul class="nav nav-third-level">--}}
{{--                    <li><a href="#">Third Level Item</a></li>--}}
{{--                    <li><a href="#">Third Level Item</a></li>--}}
{{--                    <li><a href="#">Third Level Item</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class=""><a href="{!! route('role') !!}">Roles & Permissions</a></li>--}}
{{--        </ul>--}}
{{--    </li>--}}
@endif



{{--    <li class="{!! if_uri_pattern(array('user*','profile*','role*','logs','print*','fee*','note*')) == 1 ? 'active' : '' !!}">--}}
{{--        <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">Others</span><span class="fa arrow"></span></a>--}}
{{--        <ul class="nav nav-second-level collapse">--}}
{{--            <li class="{!! if_uri_pattern(array('user*','profile*')) == 1 ? 'active' : '' !!}"><a href="{!! route('user.index') !!}">Users</a></li>--}}
{{--            <li class="{!! if_uri_pattern(array('role*')) == 1 ? 'active' : '' !!}"><a href="{!! route('role') !!}">Roles</a></li>--}}
{{--            <li class="{!! if_uri_pattern(array('logs')) == 1 ? 'active' : '' !!}"><a href="{!! route('logs') !!}">Logs</a></li>--}}
{{--            <li class="{!! if_uri_pattern(array('fee*')) == 1 ? 'active' : '' !!}">--}}
{{--                <a href="#">Fee's Info <span class="fa arrow"></span></a>--}}
{{--                <ul class="nav nav-third-level">--}}
{{--                    <li class="{!! if_uri_pattern(array('fee')) == 1 ? 'active' : '' !!}"><a href="{!! route('fee.index') !!}">List</a></li>--}}
{{--                    <li class="{!! if_uri_pattern(array('fee/create')) == 1 ? 'active' : '' !!}"><a href="{!! route('fee.create') !!}">Create</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="{!! if_uri_pattern(array('note*')) == 1 ? 'active' : '' !!}">--}}
{{--                <a href="#">Billing Notes <span class="fa arrow"></span></a>--}}
{{--                <ul class="nav nav-third-level">--}}
{{--                    <li class="{!! if_uri_pattern(array('note')) == 1 ? 'active' : '' !!}"><a href="{!! route('note') !!}">Notes / Text</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </li>--}}





