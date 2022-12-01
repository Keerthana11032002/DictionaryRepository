<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="title" content="Search the meaning of a word with translation into other language" />
        <mete name="description" content="Moreover, on getting just the synonyms of a word; one can click on a word to gather the relative words and their meanings in different forms - Dictionary" />
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
        <section id="top">
            <div class="header">
                <div class="container">
                    <form class="form"  role="search">
                        <div class="row d-flex">
                            <div class="col-md-10">
                                <div class="urlclass">{{$from}} to {{$to}}/ {{$word}} meaning in {{$to}}</div>
                            </div>
                            <div class="col-md-2">
                                <div class="card">
                                    <a href="{{url('/dictionary')}}"><b>Home</b></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section> 

        <section id="main">
            <div class="show">
                <div class="container-fuild">
                    <div class="content">
                        <div class="row">
                            <div class="col-md-9 descriptionList">        
                                
                                <div class="group" id="values">
                                    @foreach($meaning as $col)
                                        <div class="card">
                                            <div class="row">

                                                <div class="col-md-3">
                                                    <div class="word">
                                                        <div class="{{$col->id}}">
                                                            <b>{{$col->dictionary->dictionary_name}}</b>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-8">
                                                    <div class="meaning">
                                                        <div class="{{$col->id}}">{{$col->description_language}}</div>
                                                    </div>
                                                </div>

                                                <div class="col-md-1">
                                                <a href="#values" data-toggle="tooltip" title="Copy!"><i class="fas fa-copy" onclick="copyToClipboard('{{$col->id}}')"></i></a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="pagin" id="pagin">
                                    {{ $meaning->links() }}
                                </div>    

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

        function copyToClipboard(id) {
            var main = id;
            var value = $('.'+main).text();
            var successful = navigator.clipboard.writeText(value);
        }
    </script>
</html>
