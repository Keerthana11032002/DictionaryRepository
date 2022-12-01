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
            <!-- partial -->
            <style>
                .cc{
                    background-color: lightgray;    
                }
            </style>
            <div class="main-panel">
            <div class="content-wrapper cc">  
                <nav aria-label="breadcrumb">
                    <div class="btn-group">             
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><i class="mdi mdi-table-large text-dark mdi-15px"></i></li>
                        <li class="breadcrumb-item"><a href="{{url('admin/dictionary')}}">Dictionary List</a></li>
                          <li class="breadcrumb-item active" aria-current="page">List of Dictionary table</li>
                      </ol>
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
                  <div class="card bg-light">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <h4 class="card-title text-dark">Dictionary List</h4>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3" style="padding-left:98px;">
                          <a class="nav-link btn btn-success create-new-button" href="{{url('admin/add_dictionary')}}">+ Create a Dictionary</a>
                        </div>
                      </div>
                      {{-- <p class="card-description text-dark"> List of Sub Category Tables </p> --}}
                      <p class="card-title h5 text-dark" style="padding-right: 40px">Total  Dictionaries : {{count($dictionary)}}</p>
                      <div class="table-responsive">
                        <style>
                            table td {
                            max-width: 50px;
                            white-space: nowrap;
                            text-overflow: ellipsis;
                            overflow: hidden;
                            }
                        </style>
                        <table id="members_list" class="table table-responsive table-bordered border-0 bg-light ">
                          <thead>
                            <tr>
                              <th scope="col text-dark">  <strong># </th>
                              <th scope="col text-dark">  <strong>Dictionary Name </strong></th>
                              <th scope="col text-dark">  <strong>Category Name </strong></th>
                              <th scope="col text-dark text-center" style="padding-left: 5px !important;">  <strong>Word Count</strong></th>
                              <th scope="col text-dark">  <strong>Actions </strong></th>
                              <th scope="col text-dark">  <strong>status </strong></th>
                            </tr>
                          </thead>
                          <tbody>
                            @php $sno = 1;@endphp
                            @foreach($dictionary as $dictionary)
                              <tr> 
                                <td class="text-dark center">{{$sno}}</td>
                                <td class="text-dark center">{{$dictionary->dictionary_name}}</td>                                
                                <td class="text-dark center">{{$dictionary->category->category_name ??'nil'}}</td>
                                <td class="text-dark text-center">{{$dictionary->subcategory->sub_category_name ?? '8'}}</td>  
                                <td>
                                  <div class="btn-group" role="group">
                                    <form action={{url("admin/edit_dictionary/".$dictionary->id)}} method="POST">
                                      {{csrf_field()}}
                                      <button type="submit" class="btn-sm btn-primary border-1" style="min-height: 15%" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Qusetion"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg></button>
                                    </form>
                                    <form action={{url("admin/delete_dictionary/".$dictionary->id)}} method="POST" style="padding-left:5px;">
                                   {{csrf_field()}}
                                    <button type="submit" class="btn-sm btn-danger border-1" onclick="return confirm('Are you sure you want to delete this item?');" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Question"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg></button>
                                  </form>
                                  </div>
                                </td>
                                <style>
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
                                <td>
                                  <form action="{{url('admin/dictionary_status_update')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="question_id" value="{{$dictionary->id}}">
                                    @if($dictionary->is_active == '0')
                                        <input type="hidden" name="status" value="0">
                                        <button type="submit" data-toggle="tooltip"  data-original-title="Enable" id="enable" name="enable" title="" class="btn_status btn-success enable">
                                            <i class="mdi mdi-check"></i>Enabled
                                        </button>
                                    @else
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" data-toggle="tooltip" data-original-title="Disable" id="disable" title=""
                                          name="disable" class="btn_status btn-xs btn-icon btn-success"
                                          style="background: #ffad46!important;border-color: #ffad46!important;color: #fff!important;">
                                          <i class="mdi mdi-discord"></i>Disabled
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
            {{-- <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2021</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin template</a> from Bootstrapdash.com</span>
                </div>
            </footer> --}}
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
    {{-- <script src="{{ asset('assets/vendors/chart.js/Chart.min.js')}}"></script> --}}
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
    {{-- <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script> --}}
    <script src="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    {{-- <script src="{{ asset('assets/js/off-canvas.js')}}"></script> --}}
    <script src="{{ asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{ asset('assets/js/misc.js')}}"></script>
    <script src="{{ asset('assets/js/settings.js')}}"></script>
    {{-- <script src="{{ asset('assets/js/todolist.js')}}"></script> --}}
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/dashboard.js')}}"></script>
    <!-- End custom js for this page -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/r/dt/dt-1.10.9/datatables.min.js"></script>

    <!-- End custom js for this page -->
    <script>
      $(document).ready(function (){
          var table = $('#members_list').DataTable({
             lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
             pageLength: 10
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