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
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png')}}"/>
    <style>
       #snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: lightseagreen;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 85%;
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
        to {top: 8px; opacity: 1;}
      }
      
      /* @keyframes fadeout {
        from {top: 5px; opacity: 1;}
        to {bottom: 8px; opacity: 0;}
      } */
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
    </style>
  </head>
  <body>
    @php $AccessModule = Auth::guard('admin')->user()->accountAccessModule @endphp
    @php $explode_1 = explode('|',$AccessModule);@endphp
    <div class="container-scroller" >
        @include('admin.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.navbar')
            <style>
                .cc
                {
                    background-color: lightgrey;    
                }
            </style>
            <div class="main-panel">
            <div class="content-wrapper cc">  
                <nav aria-label="breadcrumb">
                    <div class="btn-group">             
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item text-dark"><i class="mdi mdi-table-large mdi-15px"></i></li>
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Available List</li>
                      </ol>
                    </div>
                    <div> 
                      @if(session()->get('error'))
                        <div id="snackbar" style="background-color: red;"><b>Warning:</b> {{session()->get('error')}}</div>
                      @elseif(Auth::guard('admin')->user()->email != null)
                        <div id="snackbar"><b>Welcome  : </b> {{Auth::guard('admin')->user()->email}}</div>
                      @endif
                    </div>             
                </nav>   
            <style>
                .card {
                    /* Add shadows to create the "card" effect */
                    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                    transition: 0.3s;
                    }

                    /* On mouse-over, add a deeper shadow */
                    .card:hover {
                    box-shadow: 0 8px 16px 0 black;
                    }

                    /* Add some padding inside the card container */
                    .container {
                    padding: 2px 16px;
                    }
                </style>  
                {{-- <div class="col-lg-8 grid-margin stretch-card bg-light text-dark">
                  <div class="card bg-light text-dark">
                    <div class="card-body  bg-light text-dark">
                      <h4 class="card-title  bg-light text-dark">Bar chart</h4>
                      <canvas id="barChart" style="height:230px"></canvas>
                    </div>
                  </div>
                </div> --}}
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    @if((Auth::guard('admin')->user()->role == 'SuperAdmin') || (in_array('app',$explode_1)))
                    <div class="col-md-3">
                        <div class="card bg-light text-dark" style="width: 18rem;">
                            <center><img src="https://www.pngkey.com/png/full/299-2992939_list-logo-vector-png.png" alt="Avatar" style="width:40%;height:50%;padding-top:10px;"></center>
                            <div class="card-body text-dark">
                              <h5 class="card-title text-dark">App</h5>
                              <h6 class="card-subtitle mb-2 text-muted">App List</h6>
                              <hr class="bg-dark">
                              <h5 class="card-text">Total Apps : {{count($apps)}}</h5>
                              <a href="{{url('admin/admin_add_app')}}" class="btn btn-success">ADD</a>
                              <a href="{{route('admin.dashboard')}}" class="btn btn-primary pull-right" style="float: right;">View</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if((Auth::guard('admin')->user()->role == 'SuperAdmin') || (in_array('category',$explode_1)))
                    <div class="col-md-3">
                        <div class="card bg-light text-dark" style="width: 18rem;">
                            <center><img src="https://www.pngkey.com/png/full/299-2992939_list-logo-vector-png.png" alt="Avatar" style="width:40%;height:50%;padding-top:10px;"></center>
                            <div class="card-body text-dark">
                              <h5 class="card-title text-dark">Category</h5>
                              <h6 class="card-subtitle mb-2 text-muted">Category List</h5>
                                <hr class="bg-dark">
                              <h5 class="card-text">Total Categories : {{count($category)}}</h5>
                              <a href="{{url('admin/add_category')}}" class="btn btn-success">ADD</a>
                              <a href="{{url('admin/category_list')}}" class="btn btn-primary pull-right" style="float: right;">View</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if((Auth::guard('admin')->user()->role == 'SuperAdmin') ||(in_array('question',$explode_1)))
                    <div class="col-md-3">
                        <div class="card bg-light text-dark" style="width: 18rem;">
                            <center><img src="https://www.pngkey.com/png/full/299-2992939_list-logo-vector-png.png" alt="Avatar" style="width:40%;height:50%;padding-top:10px;"></center>
                            <div class="card-body text-dark">
                              <h5 class="card-title text-dark">Dictionary</h5>
                              <h6 class="card-subtitle mb-2 text-muted">Dictionary List</h6>
                              <hr class="bg-dark">
                              <h5 class="card-text">Total Dictionary : {{count($question)}}</h5>
                              <a href="{{url('admin/add_dictionary')}}" class="btn btn-success">ADD</a>
                              <a href="{{url('admin/dictionary')}}" class="btn btn-primary pull-right" style="float: right;">View</a>
                            </div>
                        </div>
                    </div>
                    @endif
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
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/js/chart.js')}}"></script>
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