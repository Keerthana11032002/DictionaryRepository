{{-- <!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <!-- plugins:css -->
    <link href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <!-- End layout styles -->
    
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png')}}"/>
  </head>
  <body> --}}
    @php $AccessModule = Auth::guard('admin')->user()->accountAccessModule @endphp
    @php $explode_1 = explode('|',$AccessModule);@endphp
    <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #313a46">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top" style="background-color: #313a46">
        <a class="sidebar-brand brand-logo text-light" href="{{url('admin/app_list')}}"><center>A D M I N</center></a>
        <a class="sidebar-brand brand-logo-mini text-light" href="{{url('admin/app_list')}}">A</a>
        </div>
        <ul class="nav">
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('admin/dashboard')}}">
            <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @php $filename = basename(dirname($_SERVER['PHP_SELF'])); $file = basename($_SERVER['PHP_SELF']); @endphp
        @if((Auth::guard('admin')->user()->role == 'SuperAdmin') || (in_array('app',$explode_1)))
        <li class="nav-item menu-items @php echo ($filename == 'mapped_app') ? 'active':'' @endphp">
            <a class="nav-link @php echo ($filename == 'mapped_app') ? 'collapsed':'' @endphp" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="@php echo ($filename == 'mapped_app') ? 'true':'false' @endphp" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-table-large"></i>
              </span>
              <span class="menu-title">App</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @php echo ($filename == 'mapped_app') ? 'show':''@endphp" id="ui-basic">
              <ul class="nav flex-column sub-menu ">
                <li class="nav-item" style="padding-left:5px;"> <a class="nav-link" href="{{route('admin.dashboard')}}">List</a></li>
                <li class="nav-item" style="padding-left:5px;"> <a class="nav-link" href="{{url('admin/admin_add_app')}}">Add</a></li>
                @if($filename == "edit_app")
                <li class="nav-item" style="padding-left:5px;"><a class="nav-link" href="/admin/edit_app/{{$file}}">Manage</a></li>
                @endif
                @if($filename == "mapped_app")
                <li class="nav-item" style="padding-left:5px;"><a class="nav-link @php echo ($filename == 'mapped_app') ? 'active':'' @endphp" href="/admin/mapped_app/{{$file}}">Mapping Category</a></li>
                @endif
              </ul>
            </div>
        </li>
        @endif
        @if((Auth::guard('admin')->user()->role == 'SuperAdmin') || (in_array('category',$explode_1) || in_array('sub_category',$explode_1)))
        <li class="nav-item menu-items">
          <a class="nav-link" data-bs-toggle="collapse" href="#ui-basicss" aria-expanded="false" aria-controls="ui-basicss">
            <span class="menu-icon">
              <i class="mdi mdi-table-large"></i>
            </span>
            <span class="menu-title">Category</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basicss">
            <ul class="nav flex-column sub-menu">
              @if((Auth::guard('admin')->user()->role == 'SuperAdmin') || (in_array('category',$explode_1)))
              <li class="nav-item" style="padding-left:5px;"> <a class="nav-link" href="{{url('admin/category_list')}}">List</a></li>
              <li class="nav-item" style="padding-left:5px;"> <a class="nav-link" href="{{url('admin/add_category')}}">Add</a></li>
              <li class="nav-item" style="padding-left:5px;"> <a class="nav-link" href="{{url('admin/add_option')}}">Add Options</a></li>
                @if($filename == "edit_category")
                <li class="nav-item" style="padding-left:5px;"><a class="nav-link" href="/admin/edit_category/{{$file}}">Manage</a></li>
                @endif
              @endif
            </ul>
          </div>
        </li>
        @endif
      @if((Auth::guard('admin')->user()->role == 'SuperAdmin') ||(in_array('question',$explode_1)))
      <li class="nav-item menu-items">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basicsss" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon">
            <i class="mdi mdi-table-large"></i>
          </span>
          <span class="menu-title">Dictionary</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basicsss">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item" style="padding-left:5px;"><a class="nav-link" href="{{url('admin/dictionary')}}">List </a></li>
            <li class="nav-item" style="padding-left:5px;"><a class="nav-link" href="{{url('admin/add_dictionary')}}">Add </a></li>
            @if($filename == "edit_dictionary")
            <li class="nav-item" style="padding-left:5px;"><a class="nav-link" href="/admin/edit_dictionary/{{$file}}">Manage</a></li>
            @endif
          </ul>
        </div>
      </li>
      @endif
      @if((Auth::guard('admin')->user()->role == 'SuperAdmin') || (in_array('admin',$explode_1)))
      <li class="nav-item menu-items">
          <a class="nav-link" data-bs-toggle="collapse" href="#ui-basics" aria-expanded="false" aria-controls="ui-basics">
            <span class="menu-icon">
              <i class="mdi mdi-laptop"></i>
            </span>
            <span class="menu-title">Administrator</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basics">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item" style="padding-left:5px;"> <a class="nav-link" href="{{url('admin/superadmin')}}">List</a></li>
              <li class="nav-item" style="padding-left:5px;"> <a class="nav-link"  href="{{url('admin/admin_add_sub_admin')}}">Add </a></li>
              @if($filename == "edit_admin")
                <li class="nav-item" style="padding-left:5px;"> <a class="nav-link"  href="/admin/edit_admin/{{$file}}">manage</a></li>
              @endif
              @if($filename == "manage")
                <li class="nav-item" style="padding-left:5px;"> <a class="nav-link"  href="/admin/manage/{{$file}}">manage</a></li>
              @endif
              <li class="nav-item" style="padding-left:5px;"> <a class="nav-link" href="#">Users</a></li>
            </ul>
          </div>
      </li>
    @endif
    @if((Auth::guard('admin')->user()->role == 'SuperAdmin') ||(in_array('Activity',$explode_1)))
        <li class="nav-item menu-items" >
          <a class="nav-link" data-bs-toggle="collapse" href="#ui-log" aria-expanded="false" aria-controls="ui-basics">
            <span class="menu-icon">
              <i class="mdi mdi-laptop"></i>
            </span>
            <span class="menu-title">Activity Check</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-log">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item" style="padding-left:5px;"> <a class="nav-link" href="{{url('admin/logActivity')}}">Activity List</a></li>
            </ul>
          </div>
        </li>
      @endif
      <li class="nav-item menu-items" >
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basicssss" aria-expanded="false" aria-controls="ui-basics">
          <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
          </span>
          <span class="menu-title">Settings</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basicssss">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item" style="padding-left:5px;"> <a class="nav-link" href="{{url('admin/profile_update')}}">Update Profile</a></li>
            <li class="nav-item" style="padding-left:5px;"> <a class="nav-link"  href="{{ route('admin.logout') }}" >Logout</a><form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form></li>
          </ul>
        </div>
      </li>
      </ul>
  </nav>
    
    {{-- <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{ asset('assets/js/misc.js')}}"></script>
    <script src="{{ asset('assets/js/settings.js')}}"></script>
    <script src="{{ asset('assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/dashboard.js')}}"></script>
  </body>
</html> --}}