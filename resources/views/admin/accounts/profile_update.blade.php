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
                    @php $filename = basename($_SERVER['PHP_SELF']); @endphp         
                      <nav aria-label="breadcrumb">
                          <div class="btn-group">             
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><i class="mdi mdi-table-large text-dark mdi-17px"></i></li>
                              <li class="breadcrumb-item"><a href="{{url('admin/profile_update')}}">Admin</a></li>
                              {{-- <li class="breadcrumb-item active" aria-current="page"><a href="{{url('app_list')}}">List of app table</a></li> --}}
                              <li class="breadcrumb-item active" aria-current="page">{{$filename;}}</li>
                            </ol>
                          </div>    
                          <div>
                            @if(session()->get('message'))  
                              <div id="snackbar"><b>Success:</b> {{session()->get('message')}}</div>
                            @endif
                          </div>          
                      </nav>     
                      <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                          <div class="card" style="background-color: #fff;">
                            <div class="card-body">
                              <h4 class="card-title text-dark">Update Profile</h4>
                              @if ($errors->any())
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                               @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                @endforeach
                              </div>
                              @endif
                              <hr class="text-dark">
                              {{-- <form class="forms-sample" action="{{route('')}}" method="POST" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                  <label for="exampleInputUsername2" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">App Name <span style="color:red;">&nbsp;*</span></label>
                                  <div class="col-sm-9">
                                    <input type="text" multiple class="form-select bg-outline-dark border-3" name="app_name" id="exampleInputUsername2" placeholder="Enter a App name">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="exampleInputEmail2" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">App Description <span style="color:red;">&nbsp;*</span></label>
                                  <div class="col-sm-9">
                                    <textarea multiple class="form-select bg-outline-dark border-3" name="app_description" id="exampleInputEmail2" placeholder="Enter a App Description" rows="7"></textarea>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="radio" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">Image Type </label>
                                  <div class="col-sm-9">
                                    <div class="form-check-inline h5 text-dark">
                                      <input class="form-check-input" type="radio" name="file_type" id="image_1" value='1' checked>
                                      <label class="form-check-label" for="image_1">
                                        Image Type
                                      </label>
                                    </div>
                                    <div class="form-check-inline h5 text-dark">
                                      <input class="form-check-input" type="radio" name="file_type" id="image_2" value='2' >
                                      <label class="form-check-label" for="image_2">
                                        URL Type
                                      </label>
                                    </div> 
                                  </div>
                                </div>
                                <div id ='Normal_image_type' class="form-group row mb-4">
                                  <label for="file" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">App Image <span style="color:red;">&nbsp;*</span></label>
                                  <div class="col-sm-9">
                                    <input type="File" multiple class="form-select bg-outline-dark border-3" id="file" name="file" placeholder="Choose File">
                                  </div>
                                </div>
                                <div id="url_image_type" class="form-group row">
                                  <label for="file_1" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">URL Image <span style="color:red;">&nbsp;*</span></label>
                                  <div class="col-sm-9">
                                    <input type="text" multiple class="form-select bg-outline-dark border-3" id="file_1" name="url_image" placeholder="Copy and past a URL">
                                  </div>
                                </div>                     
                                <button type="submit" name="submit" class="btn btn-primary" >Submit</button>
                                <a href="{{'app_list'}}" class="btn btn-dark" type="button">cancel</a>
                              </form> --}}  

                              <form class="forms-sample" role="form" action="{{route('profileupdate')}}" method="POST" enctype='multipart/form-data'>
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">User Name <span style="color:red;">&nbsp;*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" multiple class="form-select bg-outline-dark border-3"  id="name" name="name" value="{{Auth::guard('admin')->user()->name}}">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">User Email <span style="color:red;">&nbsp;*</span></label>
                                    <div class="col-sm-9">
                                    <input type="text" multiple class="form-select bg-outline-dark border-3"  id ="email" value="{{Auth::guard('admin')->user()->email}}" name="email">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">Password Changed <span style="color:red;">&nbsp;*</span></label>
                                    <div class="col-sm-9">
                                        <input id="check" class="toggle" type="checkbox" name="checkbox" checked>
                                    </div>
                                </div>
                                <br>
                                <div id="Normal">
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">password <span style="color:red;">&nbsp;*</span></label>
                                        <div class="col-sm-9">
                                        <input type="password" multiple class="form-select bg-outline-dark border-3"  id ="password" name="password" placeholder="Enter a Password">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="password_confirmation" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">Password Change<span style="color:red;">&nbsp;*</span></label>
                                        <div class="col-sm-9">
                                        <input type="password" multiple class="form-select bg-outline-dark border-3"  id ="password_confirmation" name="password_confirmation" placeholder="Enter a confirm Password">
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                    <div class="form-group row">
                                        <label for="file" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">Profile Image <span style="color:red;">&nbsp;*</span></label>
                                        <div class="col-sm-9">
                                          <input type="File" multiple class="form-select bg-outline-dark border-3" id="file" name="file" placeholder="Choose File">
                                        </div>
                                    </div>
                                    <br>
                                <button type="submit" name="submit" class="btn btn-primary" >Update Profile</button>
                                <a href="{{'app_list'}}" class="btn btn-dark" type="button">cancel</a>
                            </form>
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
    $(function() 
    { 
        $('.toggle').change(function() 
        { 
          var status = $(this).prop('checked') == true ? 1 : 0;        
          var name = status;
          // alert(name);
          test_check(name);
          function test_check(name)
          {
              if(name == "1")
              {
                $('#check').attr("checked",true);
                $("#Normal").show();
                $('#check').attr("checked",false);
                $("#Normal").show().attr('checked',true);
              }
              else if(name == "0") 
              { 
                $('#check').attr("checked",false);
                $("#Normal").hide();
                $('#check').attr("checked",true);
                $("#Normal").hide().attr('checked',false);
              }

              if($('#check').is(':checked'))
              {
                  $('#check').attr("checked",false);
                  $("#Normal").hide();
              }
              else
              {
                  $('#check').bind('change', function () {
                      if ($(this).is(':checked'))
                      {
                          $('#check').attr("checked",true);
                          $("#Normal").show();
                      }
                  });
              }
          }
        }) 
      }) 
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