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

            $.ajax({
                type: "POST",
                url:"{{url('/letters')}}",
                dataType: 'json',
                data:{'category':$("#search").val() },
                success: function(response) 
                {    
                    var datalist = response.data.letters;
                    searchlist ='';
                    var valuefinal=datalist.join(',');
                    var list=[];
                    $.each(datalist, function(i, keys)
                    {
                        // alert(i);
                        var cate= keys.letters;
                        var valuefinal=valuefinal + cate;
                        list.push(cate);
                        var cateid= keys.id;
                        // searchlist = searchlist + '<a href="">'+cate+',</a>';
                        searchlist = searchlist + '<a href="javascript:;" class="myclass">'+cate+'</a>';
                    });
                    $('#result').html(searchlist);
                }
            });
            descriptionList(page,letter);
        });
    });

        function descriptionList(page,letter=''){
            var url = "{{ url('/dictionary') }}?";   
            var from_lng = $("#search").val();
            var to_lng = $("#lang_to").val();
            var search = $("#searchmean").val(); 
            
            url = url +'from='+ from_lng +'&to='+ to_lng;
            if(search!=''){
                url = url + '&search='+ search;
            }            
            if(letter!='' && search==''){
                url = url +'&letter='+ letter;  
            }
            window.history.replaceState(null, null, url);
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
        $("#lang_to").on("change", function() {
            descriptionList(page,letter);
        });
        $('#submitword').click(function(){
            descriptionList(page,letter);
        });

        $(document).on('click', '.myclass', function(event){
            var letter=$(this).html();
            $("#searchmean").val(''); 
            descriptionList(page,letter);
        });

        $(document).on('click', '.pagination a', function(event){
            event.preventDefault(); 
            page = $(this).attr('href').split('page=')[1];
            descriptionList(page,letter);
        });

            function copyToClipboard(id) {
                var main = id;
                var value = $('.'+main).text();
                var successful = navigator.clipboard.writeText(value);
            }
            descriptionList(page,letter);
    </script>