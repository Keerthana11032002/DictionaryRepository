<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="title" content="All in one language dictionary conversion with a word or term" />
        <mete name="description" content="Track down the meaning of any word in any other language in this All-in-one-language dictionary" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Dictionary</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
        <link href="{{asset('assets/css/cron.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" referrerpolicy="no-referrer"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body class="bg">
        <section id="navbar">
            <div class="top">
                <div class="container">
                    <div class="row">
                        <nav class="navbar navbar-expand-lg bg-light">
                            <div class="container-fuild">
                                <div class="collapse navbar-collapse" id="navbarText">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="#">About us</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Learn</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Word of the day</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section id="topbar">
            <div class="header">
                <div class="container">    
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="navbar-brand" >
                                <h1>Choose your input language<h1>
                            </div>
                        </div>
                    </div>
                    <form class="form"  role="search">
                        <div class="row d-flex">
    
                            <div class="col-md-4">
                                <select name="parent" class="form-select" id="search" aria-label="Default select example">
                                    <option value=""> Input Language</option>
                                    @foreach($language as $coloumn)
                                        <option value ='{{ $coloumn->id }}' data-slug='{{ $coloumn->slug }}' @if($coloumn->slug==$from) selected @endif> {{$coloumn->category_name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <input class="form-control me-2" type="search" name="searchmean" id="searchmean" placeholder="Letters" aria-label="Search" value="{{$search}}">
                            </div>

                            <div class="col-md-2">
                                <input type="button" class="src btn btn-outline-success" value="SEARCH" id="submitword">
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </section>
        
        <section id="head">
            <div class="select">
                <div class="container">
                    <div class="row">
                        <nav class="navbar navbar-expand-lg bg-light">
                            <div class="container">
                                <div class="card">
                                    <select name="parent" class="form-select" id="lang_to" aria-label="Default select example">
                                    <option value="">Language Meaning In</option>
                                        @foreach($language as $coloumn)
                                            <option value ='{{ $coloumn->id }}' data-slug='{{ $coloumn->slug }}' @if($coloumn->slug==$to) selected @endif><b> {{$coloumn->category_name }} </b></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </section> 

        <section id="main">
            <div class="show">
                <div class="container">
                    <div class="row">
                        <div class="span">
                            <span>Meaning</span>
                        </div>
                    </div>
                    <div class="names">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-12" id="result">
                                @foreach($letters as $col)
                                    <a href="javascript:;" class="myclass">{{$col->letters}}</a>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fuild">
                    <div class="content">
                        <div class="row">
                            <div class="col-md-9 descriptionList">

                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-10">

                                        </div>
                                    </div>
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>  
    </body>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var page = 1;
        var letter = '{{$letter}}';
        $(document).ready(function(){
            $("#search").on("change", function() {
                letter = '';
                replaceUrl(letter);
            });
        });
        $("#lang_to").on("change", function() {
            letter = '';
            replaceUrl(letter);
        });
        $('#submitword').click(function(){
            letter = '';
            replaceUrl(letter);
        });

        $(document).on('click', '.myclass', function(event){
            var letter=$(this).html();
            $("#searchmean").val(''); 
            replaceUrl(letter);
        });

        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            page = $(this).attr('href').split('page=')[1];
            descriptionList(page,letter);
        });

        function replaceUrl(letter=''){
            
            var url = "{{ url('/dictionary')}}/";   
            var from_lng = $("#search").val();
            var lng_from = $("#search").find(':selected').attr('data-slug');
            // alert(lng_from);
            var to_lng = $("#lang_to").val();
            var lng_to = $("#lang_to").find(':selected').attr('data-slug');
            var search = $("#searchmean").val();
            
            if(to_lng!=''){
                url = url + lng_from + '-to-'+ lng_to;
            }else{
                url = url + lng_from + '-to-all';
            }
            if(letter!='' && search==''){
                url = url + '?letter=' + letter;
            }
            if(search!=''){
                url = url + '?search='+search;
            }
            window.history.replaceState(null, null, url);
            window.location.reload(true);
        }

        function descriptionList(page,letter=''){
            var url = "{{ url('/dictionary')}}/";   
            var from_lng = $("#search").val();
            var lng_from = $("#search").find(':selected').attr('data-slug');
            // alert(lng_from);
            var to_lng = $("#lang_to").val();
            var lng_to = $("#lang_to").find(':selected').attr('data-slug');
            var search = $("#searchmean").val();

            $.ajax({
                type: "POST",
                url:"{{url('/dictionary_words')}}?page="+page,
                dataType: 'json',
                data:{'from_lng':from_lng ,'to_lng':to_lng ,'search':search,'letter':letter},
                success: function(response)
                {    
                    $('.descriptionList').html(response.data.htmldata);
                }
            });

            
        }
        function Changeletters()
        {
            $.ajax({
                type: "POST",
                url:"{{url('/letters')}}",
                dataType: 'json',
                data:{'category':$("#search").val() },
                success: function(response) 
                {
                    var datalist = response.data.letters;
                    searchlist ='';
                    $.each(datalist, function(i, keys)
                    {
                        // alert(i);
                        var cate= keys.letters;
                        var cateid= keys.id;
                        searchlist = searchlist + '<a href="javascript:;" class="myclass">'+cate+'</a>';
                    });
                    $('#result').html(searchlist);
                }
            });
        }
        function copyToClipboard(id) {
            var main = id;
            var value = $('.'+main).text();
            var successful = navigator.clipboard.writeText(value);
        }
        descriptionList(page,letter);
        Changeletters();

        function clickWord(dictionary_name) {
            var main = dictionary_name;
            // alert(des);
            var from_lng = $("#search").find(':selected').attr('data-slug');
            var to_lng = $("#lang_to").find(':selected').attr('data-slug');
            window.location="{{url('dictionary')}}/"+from_lng+"-to-"+to_lng+"/"+main+"-meaning-in-"+to_lng;
        }
    </script>
</html>
