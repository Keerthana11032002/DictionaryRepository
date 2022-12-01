<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Question Bank - Version 1 [Dev-APIs] - Webservice Form</title>

<style type="text/css">
body {
	font-size:13px;
}
</style>

</head>

<body>
    <fieldset>
            <form name="form" method="GET" action="{{url('/api/app_list_api')}}"> 
            @csrf
            <input type="hidden" name="_token" value="poyVeWVAWoGXuKZxeCgQYlaYdOvUxCoQKczaj36T">           
            <table  border="0" width="100%">
            <tr>
                <td height="30" colspan="2" align="left"> <strong style="text-decoration:underline;color:#F00;"> 1 . App List [ Development Mode ] </strong><br>
                    <div><strong>API URL:</strong> {{ url('/api/app_list_api')}}</div>
                    <div><strong>Method:</strong> GET </div>
                    <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e. x-www-form-urlencoded]</div>
                    <div><strong>API Mode:</strong> Development </div>
                    <div><strong>Notes:</strong> Last Modified at : 06-Oct-2022 </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <table width="100%" border="0" cellspacing="2" cellpadding="2">
                        <tr style="background-color:#162133;  color:#FFF;">
                            <td><strong>Label Name</strong></td>
                            <td><strong>Value</strong></td>
                            <td><strong>Variable Name</strong></td>
                            <td><strong>Mandatory</strong></td>
                            <td><strong>Note</strong></td>
                            <td><strong>Sample</strong></td>
                        </tr>
                        <tr>
                            <td colspan="1" align="center"><input type="submit" value="Submit"/></td>
                        </tr>
                    
                    </table>
                </td>
            </tr>
            </table>
        </form>
    </fieldset>
    <br><br>

    <fieldset>
            <form name="form" method="POST" action="{{ url('api/category_list_by_app_id')}}">
            @csrf
            <input type="hidden" name="_token" value="poyVeWVAWoGXuKZxeCgQYlaYdOvUxCoQKczaj36T">
            <table  border="0" width="100%">
            <tr>
                <td height="30" colspan="2" align="left"> <strong style="text-decoration:underline;color:#F00;"> 2 .Category List By App Id [ Development Mode ] </strong><br>
                    <div><strong>API URL:</strong> {{url('api/category_list_by_app_id')}}</div>
                    <div><strong>Method:</strong> POST </div>
                    <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e. x-www-form-urlencoded]</div>
                    <div><strong>API Mode:</strong> Development </div>
                    <div><strong>Notes:</strong> Last Modified at : 06-Oct-2022 </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <table width="100%" border="0" cellspacing="2" cellpadding="2">
                        <tr style="background-color:#162133;  color:#FFF;">
                            <td><strong>Label Name</strong></td>
                            <td><strong>Value</strong></td>
                            <td><strong>Variable Name</strong></td>
                            <td><strong>Mandatory</strong></td>
                            <td><strong>Note</strong></td>
                            <td><strong>Sample</strong></td>
                        </tr>
                        
                        <tr>
                            <td>App ID</td>
                            <td><input type="text" name="app_id" /></td>
                            <td>app_id</td>
                            <td>Yes</td>
                            <td>From App List API </td>
                            <td>1 (string)</td>
                        </tr>
                        <tr>
                            <td>Page Number</td>
                            <td><input type="text" name="page"/></td>
                            <td>page</td>
                            <td>No</td>
                            <td>From the Pagination for search</td>
                            <td>1 or 2 (string)</td>
                        </tr>
                        <tr>
                            <td colspan="1" align="center"><input type="submit" value="Submit" /></td>
                        </tr>
                    
                    </table>
                </td>
            </tr>
            </table>
        </form>
    </fieldset>
    <br><br>
    
    <fieldset>
            <form name="form" method="POST" action="{{ url('api/sub_category_list') }}">
            @csrf
            <input type="hidden" name="_token" value="poyVeWVAWoGXuKZxeCgQYlaYdOvUxCoQKczaj36T">
            <table  border="0" width="100%">
            <tr>
                <td height="30" colspan="2" align="left"> <strong style="text-decoration:underline;color:#F00;"> 3 . Sub Category List By Category Id [ Development Mode ] </strong><br>
                    <div><strong>API URL:</strong> {{ url('api/sub_category_list') }} </div>
                    <div><strong>Method:</strong> POST </div>
                    <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e. x-www-form-urlencoded]</div>
                    <div><strong>API Mode:</strong> Development </div>
                    <div><strong>Notes:</strong> Last Modified at : 05-Oct-2022 </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <table width="100%" border="0" cellspacing="2" cellpadding="2">
                        <tr style="background-color:#162133;  color:#FFF;">
                            <td><strong>Label Name</strong></td>
                            <td><strong>Value</strong></td>
                            <td><strong>Variable Name</strong></td>
                            <td><strong>Mandatory</strong></td>
                            <td><strong>Note</strong></td>
                            <td><strong>Sample</strong></td>
                        </tr>
                        
                        <tr>
                            <td>Category ID</td>
                            <td><input type="text" name="category_id" /></td>
                            <td>category_id</td>
                            <td>Yes</td>
                            <td>From Category List API </td>
                            <td>1 (string)</td>
                        </tr>
                        <tr>
                            <td>Page Number</td>
                            <td><input type="text" name="page"/></td>
                            <td>page</td>
                            <td>No</td>
                            <td>From the Pagination for search</td>
                            <td>1 or 2 (string)</td>
                        </tr>
                        <tr>
                            <td colspan="1" align="center"><input type="submit" value="Submit" /></td>
                        </tr>
                    
                    </table>
                </td>
            </tr>
            </table>
        </form>
    </fieldset>
    <br><br>

    <fieldset>
            <form name="form" method="POST" action="{{ url('api/dictionary_list_by_category_id') }}">
                @csrf
            <table  border="0" width="100%">
            <tr>
                <td height="30" colspan="2" align="left"> <strong style="text-decoration:underline;color:#F00;"> 4 .Dictionary List By Category Id [ Development Mode ] </strong><br>
                    <div><strong>API URL:</strong>{{ url('api/dictionary_list_by_category_id') }}</div>
                    <div><strong>Method:</strong> POST </div>
                    <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e. x-www-form-urlencoded]</div>
                    <div><strong>API Mode:</strong> Development </div>
                    <div><strong>Notes:</strong> Last Modified at : 05-Oct-2022 </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <table width="100%" border="0" cellspacing="2" cellpadding="2">
                        <tr style="background-color:#162133;  color:#FFF;">
                            <td><strong>Label Name</strong></td>
                            <td><strong>Value</strong></td>
                            <td><strong>Variable Name</strong></td>
                            <td><strong>Mandatory</strong></td>
                            <td><strong>Note</strong></td>
                            <td><strong>Sample</strong></td>
                        </tr>
                        
                        <tr>
                            <td>Category ID</td>
                            <td><input type="text" name="dictionary_category_id" /></td>
                            <td>dictionary_category_id</td>
                            <td>Yes</td>
                            <td>From Dictionary List API </td>
                            <td>1 (string)</td>
                        </tr>
                        
                        <tr>
                            <td colspan="1" align="center"><input type="submit" value="Submit" /></td>
                        </tr>
                    </table>
                </td>
            </tr>
            </table>
        </form>
    </fieldset>
    <br><br>
    
    <fieldset>
            <form name="form" method="POST" action="{{ url('api/dictionary_list_by_sub_category_id') }}">
            @csrf
            <input type="hidden" name="_token" value="poyVeWVAWoGXuKZxeCgQYlaYdOvUxCoQKczaj36T">
            <table  border="0" width="100%">
            <tr>
                <td height="30" colspan="2" align="left"> <strong style="text-decoration:underline;color:#F00;"> 5 . Dictionary List By SubCategory Id [ Development Mode ] </strong><br>
                    <div><strong>API URL:</strong> {{ url('api/dictionary_list_by_sub_category_id') }}</div>
                    <div><strong>Method:</strong> POST </div>
                    <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e. x-www-form-urlencoded]</div>
                    <div><strong>API Mode:</strong> Development </div>
                    <div><strong>Notes:</strong> Last Modified at : 05-Oct-2022 </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <table width="100%" border="0" cellspacing="2" cellpadding="2">
                        <tr style="background-color:#162133;  color:#FFF;">
                            <td><strong>Label Name</strong></td>
                            <td><strong>Value</strong></td>
                            <td><strong>Variable Name</strong></td>
                            <td><strong>Mandatory</strong></td>
                            <td><strong>Note</strong></td>
                            <td><strong>Sample</strong></td>
                        </tr>
                        
                        <tr>
                            <td>Sub Category ID</td>
                            <td><input type="text" name="sub_category_id" /></td>
                            <td>sub_category_id</td>
                            <td>Yes</td>
                            <td>From Dictionary List API </td>
                            <td>1 (string)</td>
                        </tr>
                        
                        <tr>
                            <td colspan="1" align="center"><input type="submit" value="Submit" /></td>
                        </tr>
                    
                    </table>
                </td>
            </tr>
            </table>
        </form>
    </fieldset>
    <br><br>
    
    <fieldset>
            <form name="form" method="POST" action="{{ url('api/dictionary_detail') }}">
            <table  border="0" width="100%">
            <tr>
                <td height="30" colspan="2" align="left"> <strong style="text-decoration:underline;color:#F00;"> 6 . Dictionary Full Details By Question Id[ Development Mode ] </strong><br>
                    <div><strong>API URL:</strong> {{ url('api/dictionary_detail') }}</div>
                    <div><strong>Method:</strong> POST </div>
                    <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e. x-www-form-urlencoded]</div>
                    <div><strong>API Mode:</strong> Development </div>
                    <div><strong>Notes:</strong> Last Modified at : 05-Oct-2022 </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <table width="100%" border="0" cellspacing="2" cellpadding="2">
                        <tr style="background-color:#162133;  color:#FFF;">
                            <td><strong>Label Name</strong></td>
                            <td><strong>Value</strong></td>
                            <td><strong>Variable Name</strong></td>
                            <td><strong>Mandatory</strong></td>
                            <td><strong>Note</strong></td>
                            <td><strong>Sample</strong></td>
                        </tr>
                        
                        <tr>
                            <td>Dictionary ID</td>
                            <td><input type="text" name="dictionary_id" /></td>
                            <td>dictionary_id</td>
                            <td>Yes</td>
                            <td>From Question List API </td>
                            <td>1 (string)</td>
                        </tr>
                        
                        <tr>
                            <td colspan="1" align="center"><input type="submit" value="Submit" /></td>
                        </tr>
                    
                    </table>
                </td>
            </tr>
            </table>
        </form>
    </fieldset>
    <br><br>

    <fieldset>
        <form name="form" method="POST" action="{{ url('api/dictionary_search') }}">
        <table  border="0" width="100%">
        <tr>
            <td height="30" colspan="2" align="left"> <strong style="text-decoration:underline;color:#F00;"> 7 .Dictionary Details Search Api Development Mode ] </strong><br>
                <div><strong>API URL:</strong> {{ url('api/dictionary_search') }}</div>
                <div><strong>Method:</strong> POST </div>
                <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e. x-www-form-urlencoded]</div>
                <div><strong>API Mode:</strong> Development </div>
                <div><strong>Notes:</strong> Last Modified at : 27-Oct-2022 </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <table width="100%" border="0" cellspacing="2" cellpadding="2">
                    <tr style="background-color:#162133;  color:#FFF;">
                        <td><strong>Label Name</strong></td>
                        <td><strong>Value</strong></td>
                        <td><strong>Variable Name</strong></td>
                        <td><strong>Mandatory</strong></td>
                        <td><strong>Note</strong></td>
                        <td><strong>Sample</strong></td>
                    </tr>
                    
                    <tr>
                        <td>Search</td>
                        <td><input type="text" name="search"/></td>
                        <td>search</td>
                        <td>Yes</td>
                        <td>From your search result </td>
                        <td>array (string)</td>
                    </tr>
                    <tr>
                        <td>app_id</td>
                        <td><input type="text" name="app_id"/></td>
                        <td>app_id</td>
                        <td>Yes</td>
                        <td>From App List API (app_id)  </td>
                        <td>1 (string)</td>
                    </tr>

                    <tr>
                        <td>Page Number</td>
                        <td><input type="text" name="page"/></td>
                        <td>page</td>
                        <td>No</td>
                        <td>From the Pagination for search</td>
                        <td>1 or 2 (string)</td>
                    </tr>
                    
                    <tr>
                        <td colspan="1" align="center"><input type="submit" value="Submit" /></td>
                    </tr>
                
                </table>
            </td>
        </tr>
        </table>
    </form>
    </fieldset>
    <br><br>


    {{-- <fieldset>
        <form name="form" method="POST" action="{{ url('api/common_search')}}">
        <table  border="0" width="100%">
        <tr>
            <td height="30" colspan="2" align="left"> <strong style="text-decoration:underline;color:#F00;"> 8 . Search Api From All the Modules Development Mode] </strong><br>
                <div><strong>API URL:</strong> {{ url('api/common_search') }}</div>
                <div><strong>Method:</strong> POST </div>
                <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e. x-www-form-urlencoded]</div>
                <div><strong>API Mode:</strong> Development </div>
                <div><strong>Notes:</strong> Last Modified at : 27-Oct-2022 </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <table width="100%" border="0" cellspacing="2" cellpadding="2">
                    <tr style="background-color:#162133;  color:#FFF;">
                        <td><strong>Label Name</strong></td>
                        <td><strong>Value</strong></td>
                        <td><strong>Variable Name</strong></td>
                        <td><strong>Mandatory</strong></td>
                        <td><strong>Note</strong></td>
                        <td><strong>Sample</strong></td>
                    </tr>
                    
                    <tr>
                        <td>Search</td>
                        <td><input type="text" name="search"/></td>
                        <td> search </td>
                        <td>Yes</td>
                        <td>From your search result </td>
                        <td>array (string)</td>
                    </tr>
                    
                    
                    <tr>
                        <td>app_id</td>
                        <td><input type="text" name="app_id"/></td>
                        <td>app_id</td>
                        <td>Yes</td>
                        <td>From App List API (app_id)  </td>
                        <td>1 (string)</td>
                    </tr>
                    
                    <tr>
                        <td colspan="1" align="center"><input type="submit" value="Submit" /></td>
                    </tr>
                
                </table>
            </td>
        </tr>
        </table>
    </form>
    </fieldset>
    <br><br>

    <fieldset>
        <form name="form" method="POST" action="{{ url('api/updated_questions')}}">
        <table  border="0" width="100%">
        <tr>
            <td height="30" colspan="2" align="left"> <strong style="text-decoration:underline;color:#F00;"> 9 .Updated Question version check Api Development Mode] </strong><br>
                <div><strong>API URL:</strong> {{ url('api/updated_questions') }}</div>
                <div><strong>Method:</strong> POST </div>
                <div><strong>Content-Type:</strong> application/x-www-form-urlencoded [i.e. x-www-form-urlencoded]</div>
                <div><strong>API Mode:</strong> Development </div>
                <div><strong>Notes:</strong> Last Modified at : 27-Oct-2022 </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <table width="100%" border="0" cellspacing="2" cellpadding="2">
                    <tr style="background-color:#162133;  color:#FFF;">
                        <td><strong>Label Name</strong></td>
                        <td><strong>Value</strong></td>
                        <td><strong>Variable Name</strong></td>
                        <td><strong>Mandatory</strong></td>
                        <td><strong>Note</strong></td>
                        <td><strong>Sample</strong></td>
                    </tr>
                    
                    <tr>
                        <td>question_id</td>
                        <td><input type="text" name="question_id"/></td>
                        <td>question_id</td>
                        <td>Yes</td>
                        <td>From Question Details API (example : question_id)</td>
                        <td>1 (string)</td>
                    </tr>
                    
                    <tr>
                        <td>question_version</td>
                        <td><input type="text" name="question_version"/></td>
                        <td>question_version</td>
                        <td>Yes</td>
                        <td>From the Question Version coloumn in Question Details API</td>
                        <td>1 (string)</td>
                    </tr>

                    <tr>
                        <td colspan="1" align="center"><input type="submit" value="Submit" /></td>
                    </tr>
                
                </table>
            </td>
        </tr>
        </table>
    </form>
    </fieldset>
    <br><br> --}}

</body>

</html>
