<!DOCTYPE html>
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
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/table_style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png')}}"/>
    <style>
      a:focus, input:focus {
          border-color: black;
          outline: black;
      }
       #snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #313a46;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 80%;
        bottom: 82%;
        font-size: 17px;
      }
      
      #snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
      }
      
      @keyframes fadein {
        from {top: 0; opacity: 0;}
        to {top: 50px; opacity: 1;}
      }

      .btn_status 
      {
        font-size: .70rem;
        font-weight: 500;
        letter-spacing: 1px;
        padding: 5px 10px;
        border-radius: 0.25rem;
        text-transform: uppercase;
        box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
      }
      .dataTables_wrapper .dataTables_length select{
        background: white !important;  
        border: 1.5px solid !important;   
        color: black !important; 
      }
    </style>
  </head>
  <body>
    <div class="container-scroller" >
        @include('admin.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.navbar')
            <!-- partial --><style>
                .cc{
                    background-color: lightgrey;    
                }
            </style>
            <div class="main-panel">
            <div class="content-wrapper cc">  
                <nav aria-label="breadcrumb">
                    <div class="btn-group">             
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item text-dark"><i class="mdi mdi-table-large mdi-15px"></i></li>
                        <li class="breadcrumb-item"><a href="{{url('admin/superadmin')}}">Super Admin list</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List of Admin table</li>
                      </ol>
                    </div>
                    <div id="error">
                    </div> 
                    <div>
                      @if(session()->get('message'))
                        <div id="snackbar"><b>Success:</b> {{session()->get('message')}}</div>
                      @endif
                      @if(session()->get('error'))
                        <div id="snackbar" style="background-color: red;"><b>Warning:</b> {{session()->get('error')}}</div>
                      @endif
                    </div>           
                </nav>     
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card" style="background-color: #fff;">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <h4 class="card-title text-dark">Admin List</h4>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                          <a class="nav-link btn btn-success create-new-button" href="{{url('admin/admin_add_sub_admin')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                          </svg> Add Admin</a>
                        </div>
                      </div>
                      {{-- <p class="card-title h5 text-dark"> Disabled Apps : {{count($app_active)}} </p> --}}
                      <strong><p class="card-title h5 text-dark" style="padding-right: 40px">Total Admins : {{count($superadmin)}}</p></strong>
                      <div class="table-responsive">
                        <table id="members_list" class="table table-bordered border-0 bg-light">
                          <thead>
                            <tr>
                              <th scope="col text-dark"> <strong> # </th>
                              <th scope="col text-dark"> <strong>Name </strong></th>
                              <th scope="col text-dark d-flex justify-content-center"> <strong> Email </strong></th>
                              <th scope="col text-dark d-flex justify-content-center"> <strong> Role </strong></th>
                              <th scope="col text-dark d-flex justify-content-center"> <strong> Admin Image </strong></th>
                              <th scope="col text-dark"> <strong> Actions </strong></th>
                              <th scope="col text-dark"><strong>Questions Count</strong></th>
                              <th scope="col text-dark"><strong> view </strong></th>
                              <th scope="col text-dark"> <strong> Status </strong></th>
                            </tr>
                          </thead>
                          <tbody>
                            @php $sno = 1;@endphp
                            @foreach($superadmin as $superadmin)
                              <tr> 
                                <td class="text-dark">{{$sno}}</td>
                                <td class="text-dark">{{$superadmin->name}}</td>
                                <td class="text-dark justify-content-center">{{$superadmin->email}}</td>
                                <td class="text-dark justify-content-center">{{$superadmin->role}}</td>
                                <td class="text-dark d-flex justify-content-center">
                                  @if($superadmin->image == null)   
                                    <center><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdoCQ7-yS62tALBS9_FY5pExwg8Lvvsie6Iml51YO_JQ&s" style="height:50px; width:auto;border-radius:70%;"></center>
                                  @elseif($superadmin->image_type == 1)
                                    <center><img  src="{{asset('storage/'.$superadmin->image ) }}"  style="height:50px; width:auto;border-radius:70%;"></center>
                                  @else
                                  <center><img  src="{{$superadmin->image}}" style="height:60px; width:70px;border-radius:50%;"></center>
                                  @endif
                                  </td>
                                <td>
                                    <div class="btn-group" role="group">
                                      <form action={{url("admin/edit_admin/".$superadmin->id)}} method="POST" style="padding-left:5px;">
                                          {{csrf_field()}}
                                          <button type="submit" class="btn-sm btn-primary border-1" style="min-height: 15%"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit App"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                          </svg></button>
                                      </form>
                                      <form action={{url("admin/delete_admin/".$superadmin->id)}} method="POST" style="padding-left:5px;">
                                        {{csrf_field()}}
                                        <button type="submit" class="btn-sm btn-danger border-1" onclick="return confirm('Are you sure you want to delete this item?');" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete App"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                          <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                          </svg></button>
                                        </form>
                                  </div>
                                </td>
                              <td>
                                <h5>{{count($superadmin->count)}}</h5>
                              </td>
                              <td>
                                <form action={{url("admin/manage/".$superadmin->id)}} method="POST" style="padding-left:5px;">
                                  {{csrf_field()}}
                                  <button type="submit" class="badge badge-warning border-1" style="min-height: 15%"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="View More">View More</button>
                                </form>
                              </td>
                              <td>
                                <form action="{{url('admin/user_status_update')}}" method="POST">
                                  @csrf
                                  <input type="hidden" name="user_id" value="{{$superadmin->id}}">
                                  @if($superadmin->is_active == '0')
                                      <input type="hidden" name="status" value="0">
                                      <button type="submit" data-toggle="tooltip"  data-original-title="Enable" id="enable" name="enable" title="" class="btn_status btn-success enable">
                                          <i class="mdi mdi-check"></i>Active
                                      </button>
                                  @else
                                      <input type="hidden" name="status" value="1">
                                      <button type="submit" data-toggle="tooltip" data-original-title="Disable" id="disable" title=""
                                        name="disable" class="btn_status btn-xs btn-icon btn-success"
                                        style="background: #ffad46!important;border-color: #ffad46!important;color: #fff!important;">
                                        <i class="mdi mdi-discord"></i>In_Active
                                      </button>
                                  @endif
                                </form>
                              </td>
                              </tr>  
                              @php $sno++; @endphp
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
        <style>
          .footer{
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            color: white;
            background-color: #313a46;
            text-align: center;
          }
          </style>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
          </div>
      </footer>
    </div>
    
   
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    function myFunction() 
    {
       $('#error').append('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>UnAuthorized:</strong> Permission Denied!...<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
    </script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/r/dt/dt-1.10.9/datatables.min.js"></script>
    <!-- End custom js for this page -->
    <script>
      $(document).ready(function (){
          var table = $('#members_list').DataTable({
             lengthMenu: [ [5, 10, 25, -1], [5, 10, 25, "All"] ],
             pageLength: 5
          });
      });
    </script>
    <script>
      myFunction();
      function myFunction() {
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      }
    </script>
  </body>
</html>