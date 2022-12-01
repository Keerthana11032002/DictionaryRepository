<!DOCTYPE html>
<html>
<head>
    <title>Add Options</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body> 
    <div class="container">
        <h2 align="center">Add/remove multiple input fields</h2> 
        <form action="{{url('admin/category.insert')}}" method="POST">
            @csrf
            <!-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif -->
    
            <!-- @if (Session::has('success'))
                <div class="alert alert-success text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif -->
    
            <table class="table table-bordered" id="dynamicTable">  
                <tr>  
                    <td><input type="text" name="addmore[0][designation]" placeholder="Designation" class="form-control" required/></td>  
                    <td><input type="text" name="addmore[0][experience]" placeholder="Experience" class="form-control" required/></td>  
                    <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td> 
                </tr>  
            </table> 
        
            <button type="submit" class="btn btn-success">Save</button>
        </form>
        <div class="main-panel" id="values">

        </div>
    </div>
   
    <script type="text/javascript">
        var i = 0;  
        $("#add").click(function(){
            ++i;
            // alert(i);
            $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][designation]" placeholder="Designation" class="form-control" /></td><td><input type="text" name="addmore['+i+'][experience]" placeholder="Experience" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
            $("#values").append('<div class="course">$("input[name="addmore['+i+'][designation]")</div><div class="year">$("input[name="addmore['+i+'][experience]")</div>');
        });
        $(document).on('click', '.remove-tr', function(){  
            $(this).parents('tr').remove();
        }); 
    </script>
</body>
</html>