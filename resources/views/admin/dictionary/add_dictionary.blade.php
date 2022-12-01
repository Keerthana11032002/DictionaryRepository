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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
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
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script> --}}
  </head>
  <body>

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
      
    .ck-blurred p,h1,h2,h4, .ck-editor__editable:focus{
      color: #000 ;
    }
    .form-group label
    {
      padding: 5px;
      font-size: 0.975rem;
      float: none;
      vertical-align: middle;
    }
    .select2-container--default .select2-selection--single, .select2-container--default .select2-dropdown, .select2-container--default .select2-selection--multiple
    {
      background-color: white !important;
      color: black !important;
      font-weight: 500;
      text-emphasis-color: #313a46;
    }
    #select2-category-container{
      color: black;
    }
    #select2-subcategory-container{
      color: black;
    }
    #select2-parent-container{
      color: whitesmoke !important;
      position: relative;
    }
    .select2-container .select2-selection--single {
      height: 40px !important;
      text-align: left;
    }
    .select2-container--default .select2-selection--single {
      border: 1px solid lightgray !important;
      color: black;
      border: 3px solid !important;
      border-color: lightgray !important;
      border-radius: 2px !important;
    } 
    </style>
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
                          <li class="breadcrumb-item"><a href="{{url('admin/dictionary')}}">Dictionary List</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><a href="{{url('admin/dictionary')}}">List of Dictionary table</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Dictionary Add</li>
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
                          <h4 class="card-title text-dark">dictionary Details</h4>
                          @if ($errors->any())
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            @endforeach
                          </div>
                          @endif
                          <hr class="text-dark">
                          <form role="form" class="forms-sample" action="{{url('admin/insert_dictionary')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">Category <span style="color:red;">&nbsp;*</span></label>
                                <div class="col-sm-9">
                                  <select class="js-example-basic-single form-select form-select-white mb-3 text-dark bg-outline-dark border-3 select2" name="category" id="category" style="width:100%" >
                                        <option id="font" class="text-dark" value="" >Select a Category *</option>
                                      @foreach($category as $category)
                                        <option class="text-dark" value="{{$category->id}}">{{$category->category_name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                            </div>
                            <div class="form-group row">
                              <label for="QuestionName" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">Word <span style="color:red;">&nbsp;*</span></label>
                              <div class="col-sm-9">
                                <input type="text" multiple class="form-select bg-outline-dark border-3" name="dictionaryName" id="dictionaryName" placeholder="Enter a dictionary name">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="exampleInputUsername2" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">Text Type <span style="color:red;">&nbsp;*</span></label>
                              <div class="col-sm-9">
                                <div class="form-check-inline h5 text-dark">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value='1' checked>
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    Normal Text
                                  </label>
                                </div>
                                <div class="form-check-inline h5 text-dark">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value='2' >
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    Html Text
                                  </label>
                                </div> 
                              </div>
                            </div>
                            <div id ='Normal' class="form-group row">
                              <label for="QuestionDescription" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">Meaning<span style="color:red;">&nbsp;*</span></label>
                              <div class="col-sm-9">
                                <textarea multiple class="form-select bg-outline-dark border-3" id="normal_desc" name="ques_desc_1" placeholder="Enter a Dictionary Description" rows="10"></textarea>
                              </div>
                            </div>
                            <div id="form-text" class="form-group row">
                              <label for="QuestionDescription" class="col-sm-3 col-form-label h2 text-dark" style="padding-left: 10px">Meaning HTML Type <span style="color:red;">&nbsp;*</span></label>
                              <div class="col-sm-9">
                                <textarea class="form-control" id="html_desc" name="ques_desc_2" placeholder="Enter a Question Description" rows="4"></textarea>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary submitBtn" name="submit">Submit</button>
                            <a href="{{url('admin/dictionary')}}" class="btn btn-dark" type="button">cancel</a>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div> 
                </div>
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


    {{-- ckeditor --}}
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    {{-- <script src="{{ asset('assets/vendors/chart.js/Chart.min.js')}}"></script> --}}
    <script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>
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
    <script src="{{ asset('assets/editor_ckediter/ckeditor.js')}}"></script>
    <script src="{{ asset('assets/editor_ckediter/adapters/jquery.js')}}"></script>
    <script src="{{ asset('assets/editor_ckediter/styles.js')}}"></script>
    {{-- <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script> --}}
    {{-- <script>
        CKEDITOR.replace('html_desc');
    </script> --}}
    <script>
      var editor = CKEDITOR.replace('html_desc', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
          if($('#flexRadioDefault1').is(':checked')){
            $("#Normal").show()
            $('#form-text').hide();
          }

          $('#flexRadioDefault1').bind('change', function () {
            if ($(this).is(':checked'))
              $("#Normal").show().removeAttr('checked',true)
              $('#form-text').hide();
          });
          
          $("#flexRadioDefault2").bind('change', function(){
            if ($(this).is(':checked'))
              $("#Normal").hide();
              $('#form-text').show().attr('checked',true);
          });

    </script>
    <script>
      if($('#image_1').is(':checked'))
      {
        $("#Normal_image_type").show()
        $('#url_image_type').hide();
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
          var qytoe = $('input[name="flexRadioDefault"]:checked').val();
          var quesdesc = '';
          if(qytoe == 1){
            quesdesc = $('#normal_desc').val();
          }
          if(qytoe == 2)
          {
              quesdesc = editor.getData();
          }
          var image = $('input[name="file_type"]:checked').val();
          var image_type = '';
          if(qytoe == 1){
            quesdesc = $('#Normal_image_type').val();
          }
          if(qytoe == 2)
          {
            quesdesc = $('#url_image_type').val();
          }
          // alert(quesdesc);
          
          // if(questionname.trim() == '' )
          // {
          //     $('#QuestionName').val('');
          //     $('.statusMsg1').html('<span style="color:red;">Some problem occurred, please fill the Question name.</span>');
          //     // return false;
          // }
          
          // if(ShortNormal.trim() == '' )
          // {
          //     $('#QuestionDescription').val('');
          //     $('.statusMsg1').html('<span style="color:red;">Some problem occurred, please fill the Question description.</span>');
          //     // return false;
          // }
          
          // if(categoryname.trim() =='')
          // {
          //     $('.statusMsg1').html('<span style="color:red;">Please select atlest one category.</span>');
          //     // return false;
          // }
          // if(subcategory.trim() == "")
          // {
          //     $('.statusMsg1').html('<span style="color:red;">Please select atlest one sub-category.</span>');
          // }
          // else
          // {
          //     $.ajaxSetup({
          //         headers: {
          //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          //         }
          //     });
          //     $.ajax({
          //         type:'POST',
          //         url:"{{url('/insert_question')}}",

          //         data:{categoryname:categoryname,subcategory:subcategory,questionname:questionname,questionshort:ShortNormal,quesdesc:quesdesc},
          //         beforeSend: function() 
          //         {
          //             $('.submitBtn').attr("disabled","disabled");
          //         },
          //         success:function(msg)
          //         {
          //           if(msg == 'ok')
          //           {
          //               $('#category').val('');
          //               $('#subcategory').val('');
          //               $('#QuestionName').val('');
          //               $('#QuestionDescription').val('');
          //               $('.msg1').html('<span style="color:green;"><strong>Question is Added Successfully.</strong></p>');
          //           }
          //           else
          //           {
          //             $('.msg1').html('<span style="color:red;">Some problem occurred, please try again.</span>');
          //           }
          //           $('.submitBtn').removeAttr("disabled");
          //         }
          //     });
          // }
      }
    </script>

  {{-- <script type="text/javascript">
    $('#category').on('change',function() {
    let id = $(this).val();
    // $(this).toggleClass('clicked');
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url:"{{url('admin/subcat')}}",
        type:"POST",
        data: {cat_id: id},
    success:function(data) 
    {
        $('#subcategory').empty();
        var data = data.subcategories;
        if(data.length > 0)
        {
          // $('#subcategory').attr('required');
          $('#subcategory').append('<option class="text-dark" value="" selected>Select a Sub-Category*</option>');
          $.each(data,function(index,subcategory)
          {
              $('#subcategory').append('<option class="text-dark" value="'+subcategory.id+'">'+subcategory.sub_category_name+'</option>');
          })
        }
        else{
          $('#subcategory').append('<option class="text-dark" value="0">None</option>');
        }
    }
    })
    });
  </script> --}}
  <script>
    $('.select2').select2();
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
