<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.3/css/bulma.min.css" rel="stylesheet"/> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.8.1/themes/prism.min.css" rel="stylesheet"/> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"> --}}
    <link href="{{ asset('assets/new/style.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/new/dist/dual-listbox.css')}}" rel="stylesheet" />
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
      
      .dual-listbox .dual-listbox__title
      {
        /* color:black!important; */
        /* background-color: white; */
        /* border: 2px; */
      }
      .dual-listbox .dual-listbox__available, .dual-listbox .dual-listbox__selected
      {
        color:white!important;
        background-color: black;
      }
      .dual-listbox .dual-listbox__item{
        color:black!important;
        background-color: white;
      }
    </style>
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png')}}"/>
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
                @php $filename = dirname($_SERVER['PHP_SELF']); @endphp    
                  <nav aria-label="breadcrumb">
                      <div class="btn-group">             
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><i class="mdi mdi-table-large text-dark mdi-17px"></i></li>
                          <li class="breadcrumb-item"><a href="{{url('admin/app_list')}}">App List</a></li>
                          <li class="breadcrumb-item active" aria-current="page">List of app table</li>
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
                      <div class="card ff">
                        <div class="card-body">
                          <form  method="POST" action="{{route('admin.mapping_cat', $edit->id)}}">
                            @csrf
                              <section class="section card-body text-dark">
                                <h4 class="card-title text-dark">Select by List of Category</h4>
                                <hr class="text-dark">
                                {{-- <p class="card-description h5 text-dark">Mapped App Category</p> --}}
                                <div class="row">
                                  <div class="col-md-4">
                                    <h4 class="card-header h5 text-dark" style="padding-right: 40px">Total Available Categories : {{count($category_list)}}</h4>
                                  </div>
                                  <div class="col-md-4" style="padding-right: 50px">
                                    <h4 class="card-header h5 text-dark" >Total selected Categories :{{count($mapped_app)}}</h4>
                                  </div>
                                </div>
                                    <div class="form-group row">
                                      <select class="select1" multiple="multiple" name="countries[]">
                                        @foreach($category_list as $row)
                                          @if(in_array($row->id,$mapped_app))
                                            <option value="{{$row->id}}" selected="selected">{{$row->category_name}}</option>
                                          @else
                                            <option value="{{$row->id}}">{{$row->category_name}}</option>
                                          @endif
                                        @endforeach
                                      </select>
                                    </div>
                                  <input class="btn btn-outline-primary btn-fw" type="submit" name="submit" value="Submit Form"/>
                              </section>
                            </form>
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
   
    <!--node of wrapper -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.8.1/prism.min.js"></script>
        <script src="{{ asset('assets/new/dist/dual-listbox.js')}}"></script>
        <script>
            var dlb1 = new DualListbox(".select1");

            var sources = document.querySelectorAll(".source");
            for (var i = 0; i < sources.length; i++) {
                var source = sources[i];
                source.addEventListener("click", function (event) {
                    var code = document.querySelector(
                        "." + event.currentTarget.dataset.source
                    );
                    code.classList.toggle("open");
                });
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
