<div class="sidebar sidebar-main sidebar-default">
    <div class="sidebar-content">

        <!-- User menu -->
        {{-- <div class="sidebar-user-material">
            <div class="category-content">
                <div class="sidebar-user-material-content">
                    <a href="#"><img src="assets/images/placeholder.jpg" class="img-circle img-responsive" alt=""></a>
                    <h6>{{auth()->guard('admin')->user()->name}}</h6>
                    <span class="text-size-small"></span>
                </div>

                <div class="sidebar-user-material-menu">
                    <a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
                </div>
            </div>

            <div class="navigation-wrapper collapse" id="user-nav">
                <ul class="navigation">
                    <!-- <li><a href="#"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                    <li><a href="#"><i class="icon-coins"></i> <span>My balance</span></a></li>
                    <li><a href="#"><i class="icon-comment-discussion"></i> <span><span
                                    class="badge bg-teal-400 pull-right">58</span> Messages</span></a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-cog5"></i> <span>Account settings</span></a></li> -->
                    <li><a href="{{url('admin/logout')}}"><i
                                class="icon-switch2"></i> <span>logout</span></a>
                       
                    </li>

                </ul>
            </div>
        </div> --}}
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li class=""><a href="{{url('admin/')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>

                    @if(auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                        <li class="navigation-header"><span>House Repair</span> <i class="icon-menu" title="Main pages"></i></li>
                        <li class=""><a href="{{url('/admin/house-repair-requests')}}"><i class="icon-home4"></i> <span>House Repair Request</span></a></li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasAnyPermission(['warehouse-manager_own','warehouse-manager_global','house-captain_own','house-captain_global']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                        <li class="navigation-header"><span>People</span> <i class="icon-menu" title="Main pages"></i></li>
                       
                        @if(auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                            <li class=""><a href="{{url('admin/field-assistants')}}"><i class="icon-home4"></i> <span>Field Assistant</span></a></li>
                        @endif
                        
                        @if(auth()->guard('admin')->user()->hasAnyPermission(['warehouse-manager_own','warehouse-manager_global']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                            <li class=""><a href="{{url('admin/warehouse-managers')}}"><i class="icon-home4"></i> <span>Warehouse Managers</span></a></li>
                        @endif
                        
                        @if(auth()->guard('admin')->user()->hasAnyPermission(['house-captain_own','house-captain_global']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                            <li class=""><a href="{{url('admin/house-captains')}}"><i class="icon-home4"></i> <span>Housecaptains</span></a></li>
                        @endif

                    @endif

                    @if(auth()->guard('admin')->user()->hasAnyPermission(['warehouse_own','warehouse_global','inventory_own','inventory_global']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                        <li class="navigation-header"><span>Management</span> <i class="icon-menu" title="Main pages"></i></li>
                    
                        @if(auth()->guard('admin')->user()->hasAnyPermission(['warehouse_own','warehouse_global']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                            <li class=""><a href="{{url('admin/warehouses')}}"><i class="icon-home4"></i> <span>Warehouse</span></a></li>
                        @endif

                        @if(auth()->guard('admin')->user()->hasAnyPermission(['inventory_own','inventory_global']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                        <li class=""><a href="{{url('admin/inventories')}}"><i class="icon-home4"></i> <span>Inventories</span></a></li>
                        @endif

                    @endif

                    @if(auth()->guard('admin')->user()->hasAnyPermission(['state_own','state_global','city_own','city_global','organization_own','organization_global']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                        <li class="navigation-header"><span>Utilities</span> <i class="icon-menu" title="Main pages"></i></li>
                        
                        @if(auth()->guard('admin')->user()->hasAnyPermission(['state_own','state_global']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                            <li class=""><a href="{{url('admin/states')}}"><i class="icon-home4"></i> <span>States</span></a></li>
                        @endif

                        @if(auth()->guard('admin')->user()->hasAnyPermission(['city_own','city_global']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                            <li class=""><a href="{{url('admin/cities')}}"><i class="icon-home4"></i> <span>Cities</span></a></li>
                        @endif

                        @if(auth()->guard('admin')->user()->hasAnyPermission(['organization_own','organization_global']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                            <li class=""><a href="{{url('admin/organization')}}"><i class="icon-home4"></i> <span>Organization</span></a></li>
                        @endif
                    @endif

                    {{-- @if(auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                        <li><a href="{{url('/admin/return')}}"><i class="icon-home"></i> <span>Return Product</span></a></li>
                    @endif --}}

                    @if(auth()->guard('admin')->user()->role == 'field_assistant')
                    <li class="navigation-header"><span>Verification</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li class=""><a href="{{url('admin/field-assistant/verification-requests')}}"><i class="icon-home4"></i> <span>Verification Requests</span></a></li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                        <li class="navigation-header"><span>Role Permission</span> <i class="icon-menu" title="Main pages"></i></li>
                        <li class=""><a href="{{url('/admin/roles')}}"><i class="icon-home4"></i> <span>Roles</span></a></li>
                        <li class=""><a href="{{url('/admin/permissions-groups')}}"><i class="icon-home4"></i> <span>permission</span></a></li>
                    @endif
                    <li><a href="{{url('admin/logout')}}"><i
                        class="icon-switch2"></i> <span>logout</span></a>
               
                    </li>
                </ul>
                
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>