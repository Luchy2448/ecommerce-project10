 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-info elevation-4">
     <!-- Brand Logo -->
     <a href="dashboard" class="brand-link bg-info">
         <img src="{{ asset('admin/images/AdminLTELogo.png') }}" alt="logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
         <span class="brand-text font-weight-light">Admin Panel</span>
     </a>
     {{-- <a href="#" class="brand-link" style="text-align: start; background-color: #17a2b8; margin: 0; ">
         <img src="{{ asset('admin/images/icon.png') }}" alt="Logo" style="width: 30%">
         <span class="brand-text font-weight-bold" style="color:blue;">Giga<b style="color:lime;">S</b>tore</span>
     </a> --}}

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 @if (!empty(Auth::guard('admin')->user()->image))
                     <img src="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}"
                         class="img-circle elevation-2" alt="User Image">
                 @else
                     <img src="{{ asset('admin/images/default-user-img.jpg') }}" class="img-circle elevation-2"
                         alt="User Image">
                 @endif
             </div>
             <div class="info">
                 <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
             </div>
         </div>

         <!-- SidebarSearch Form -->
         {{-- <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div> --}}

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                 @php
                     $active = Session::get('page') == 'dashboard' ? 'active' : '';
                 @endphp
                 <li class="nav-item">
                     <a href="dashboard" class="nav-link {{ $active }}">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>
                 @if (Auth::guard('admin')->user()->type == 'admin')
                     @php
                         $active =
                             Session::get('page') == 'update-details' || Session::get('page') == 'update_password'
                                 ? 'active'
                                 : '';
                     @endphp
                     <li class="nav-item menu-open">
                         <a href="#" class="nav-link {{ $active }}">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                 Settings
                                 <i class="right fas fa-angle-left"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview">
                             @php
                                 $active = Session::get('page') == 'update_password' ? 'active' : '';
                             @endphp
                             <li class="nav-item">
                                 <a href="update_password" class="nav-link {{ $active }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Update Admin Password</p>
                                 </a>
                             </li>
                             @php
                                 $active = Session::get('page') == 'update-details' ? 'active' : '';
                             @endphp
                             <li class="nav-item">
                                 <a href="update-details" class="nav-link  {{ $active }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Update Admin Details</p>
                                 </a>
                             </li>
                             {{-- <li class="nav-item">
                             <a href="./index3.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Dashboard v3</p>
                             </a>
                         </li> --}}
                         </ul>
                     </li>
                     @php
                         $active = Session::get('page') == 'subadmins' ? 'active' : '';
                     @endphp
                     <li class="nav-item">
                         <a href="{{ route('admin.subadmins.index') }}" class="nav-link {{ $active }}">
                             <i class="nav-icon fas fa-users"></i>
                             <p>
                                 Subadmins
                             </p>
                         </a>
                     </li>
                 @endif
                 @php
                     $active = Session::get('page') == 'cms_pages' ? 'active' : '';
                 @endphp

                 <li class="nav-item">
                     <a href="{{ route('admin.cms_pages.index') }}" class="nav-link {{ $active }}">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             CMS Pages
                         </p>
                     </a>
                     {{-- <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="pages/layout/top-nav.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Top Navigation</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Top Navigation + Sidebar</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/boxed.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Boxed</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Fixed Sidebar</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Fixed Sidebar <small>+ Custom Area</small></p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Fixed Navbar</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/fixed-footer.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Fixed Footer</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Collapsed Sidebar</p>
                             </a>
                         </li>
                     </ul> --}}
                 </li>
                 @php
                     $active = Session::get('page') == 'categories' ? 'active' : '';
                 @endphp
                 <li class="nav-item">
                     <a href="categories" class="nav-link {{ $active }}">
                         <i class="nav-icon fas fa-list"></i>
                         <p>
                             Categories
                         </p>
                     </a>
                 </li>

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
