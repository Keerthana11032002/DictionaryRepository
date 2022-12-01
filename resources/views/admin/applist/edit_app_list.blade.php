<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
      
      /* @keyframes fadeout {
        from {top: 0; opacity: 0;}
        to {top: 50px; opacity: 1;}
      } */
      .form-group label
       {
         padding: 5px;
         font-size: 0.975rem;
         float: none;
         vertical-align: middle;
       }
   </style>
  </head>
  <body>
    <div class="container-scroller" >
        @include('admin.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.navbar')
            <!-- partial -->
            <div class="main-panel">
              <style>
                .cc{
                    background-color: lightgray;    
                }
                .ff{
                    background-color: whitesmoke;
                }
              </style>
              <div class="content-wrapper cc">
                @php $filename = basename($_SERVER['PHP_SELF']); @endphp         
                  <nav aria-label="breadcrumb">
                      <div class="btn-group">             
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><i class="mdi mdi-table-large text-dark mdi-17px"></i></li>
                          <li class="breadcrumb-item"><a href="{{url('admin/app_list')}}">App List</a></li>
                          <li class="breadcrumb-item active" aria-current="page">List of app table</li>
                          {{-- <li class="breadcrumb-item active" aria-current="page">{{$filename;}}</li> --}}
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
                          <h4 class="card-title text-dark">Edit App Form</h4>
                          @if ($errors->any())
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            @endforeach
                          </div>
                          @endif
                          <hr class="text-dark">
                          @foreach ($edit_app_id as $edit_app_id)
                          <form class="forms-sample" role="form" action="{{url('admin/edit_app_list/'.$edit_app_id->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="hidden" value="{{$edit_app_id->question_version}}" hidden>
                            <div class="form-group row">
                              <label for="editappname" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">App Name <span style="color:red;">&nbsp;*</span></label>
                              <div class="col-sm-9">
                                <input type="text" multiple class="form-select bg-outline-dark border-3" name="edited_app_name" id="editappname" value="{{$edit_app_id->app_name}}" placeholder="Enter a App name">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="editappdescription" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">App Description <span style="color:red;">&nbsp;*</span></label>
                              <div class="col-sm-9">
                                <textarea multiple class="form-select bg-outline-dark border-3" name="edited_app_description" id="editappdescription" placeholder="Enter a App Description" rows="5">{{$edit_app_id->app_description}}</textarea>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="exampleInputUsername2" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">Image Type</label>
                              <div class="col-sm-9">
                                <div class="form-check-inline h5 text-dark">
                                  <input class="form-check-input" type="radio" name="file_type" id="image_1" value='1' >
                                  <label class="form-check-label" for="image_1">
                                    Image Type
                                  </label>
                                </div>
                                <div class="form-check-inline h5 text-dark">
                                  <input class="form-check-input" type="radio" name="file_type" id="image_2" value='2'>
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
                                <input type="text" multiple class="form-select bg-outline-dark border-3" id="file_1" name="url_image" value="@if($edit_app_id->image_type == 2){{$edit_app_id->app_image}}@endif" placeholder="Copy and past a URL">
                              </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary" style="padding-left: 10px">Submit</button>
                            <a href="{{url('admin/app_list')}}" class="btn btn-dark" type="button">cancel</a>
                          </form>
                          @endforeach
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- container-scroller -->
    <!-- plugins:js -->
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
    <!-- End custom js for this page -->
    <script>
      var image = {{$edit_app_id->image_type ?? 1}};
      test_check(image);
      function test_check(params)
      {
        if(params == "1")
        {
          $('#image_1').attr("checked",true);
          $('#image_2').attr("checked",false);
          $("#Normal_image_type").show()
          $('#url_image_type').hide();
        }
        else if(params == "2") 
        { 
          $('#image_2').attr("checked",true);
          $('#image_1').attr("checked",false);
          $("#Normal_image_type").hide()
          $('#url_image_type').show();
        }
      }
    </script>
    <script>
      if($('#image_2').is(':checked'))
      {
          $("#Normal_image_type").hide();
          $('#url_image_type').show().attr('checked',true);
      }

      $('#image_1').bind('change', function () {
        if ($(this).is(':checked'))
          $("#Normal_image_type").show().removeAttr('checked',true)
          $('#url_image_type').hide();
      });
      
      $("#image_2").bind('change', function(){
        if ($(this).is(':checked'))
          $("#Normal_image_type").hide();
          $('#url_image_type').show().attr('checked',true);
      });
    </script>
    <script type="text/javascript">
      function submitQuestionForm()
      {
        var image = $('input[name="file_type"]:checked').val();
        var image_type = '';
        if(qytoe == 1){
          quesdesc = $('#Normal_image_type').val();
        }
        if(qytoe == 2)
        {
          quesdesc = $('#url_image_type').val();
        }
      }
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
