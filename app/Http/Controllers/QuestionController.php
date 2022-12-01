<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\AppList;
use App\Models\Module;
Use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Helpers\LogActivity;
use App\Models\Category;

class QuestionController extends Controller
{
    public function show()
    {
        // LogActivity::addToLog();
        $role = Auth::guard('admin')->user()->role;
        $AccessPrivilege = Auth::guard('admin')->user()->accountAccessPrivilege;
        $AccessModule = Auth::guard('admin')->user()->accountAccessModule;
        $explode = explode('|',$AccessModule);
        $explode_1 = explode('|',$AccessPrivilege);
        $module = Module::Select(['module_name'])->whereIn('module_name',$explode)->get();

        $permission=[];
        foreach($module as $row)
        {
            $permission[] = $row->module_name;
        }
        $permis = $permission;
        $array = array_intersect($explode, $permis);
        $array_1= in_array('view',$explode_1);
        if(($role == "SuperAdmin") || ($array == true &&  $array_1 == true))
        {
            $questions =Question::orderBy('id','asc')->where('deleted_at','0')->get();
            return view('admin.question.questions_list',['questions'=> $questions]);
        }
        else
        {
            return redirect()->route('admin/dashboard')->with("error","Access Denied");
        }
    }
    function add()
    {
        $role = Auth::guard('admin')->user()->role;
        $AccessPrivilege = Auth::guard('admin')->user()->accountAccessPrivilege;
        $AccessModule = Auth::guard('admin')->user()->accountAccessModule;
        $explode = explode('|',$AccessModule);
        $explode_1 = explode('|',$AccessPrivilege);
        $module = Module::Select(['module_name'])->whereIn('module_name',$explode)->get();
        $permission=[];
        foreach($module as $row)
        {
            $permission[] = $row->module_name;
        }
        $permis = $permission;
        $array = array_intersect($explode, $permis);
        $array_1= in_array('add',$explode_1);
        if(($role == "SuperAdmin") || ($array  && $array_1== true))
        {
            $category = Category::where('deleted_at','0')->get();
            return view('admin.question.add_question', ['category' => $category]);
        }
        else
        {
            return redirect()->route('admin.question')->with("error","Access Denied");
        }
    }

    public function active(Request $request)
    {
        LogActivity::addToLog();
        $role = Auth::guard('admin')->user()->role;
        $AccessPrivilege = Auth::guard('admin')->user()->accountAccessPrivilege;
        $AccessModule = Auth::guard('admin')->user()->accountAccessModule;
        $explode = explode('|',$AccessModule);
        $explode_1 = explode('|',$AccessPrivilege);
        $module = Module::Select(['module_name'])->whereIn('module_name',$explode)->get();
        $permission=[];
        foreach($module as $row)
        {
            $permission[] = $row->module_name;
        }
        $permis = $permission;
        $array = array_intersect($explode, $permis);
        $array_1= in_array('edit',$explode_1);
        if(($role == "SuperAdmin") || ($array  && $array_1== true))
        {
            $cat_id = $request->question_id;
            $status = $request->status;
            if($status == 0)
            {
                $app_active = Question::find($cat_id);
                $app_active->is_active ='1';
                $app_active->save();
                return back()->with('message','Question Disabled Successfully');
            }
            if($status == 1)
            {
                $app_active = Question::find($cat_id);
                $app_active->is_active ='0';
                $app_active->save();
                return back()->with('message','Question Enabled Successfully');
            }
        }
        else
        {
            return redirect()->route('admin.question')->with("error","Access Denied");
        }
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'category'=>'required',
            'QuestionName' => 'required|string|max:255',
            'ShortNormal' => 'required',
            'file' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);
        $id = Auth::guard('admin')->user()->id;
        // dd($id);
        $user = new Question;
        $user->category_id = $request['category'];
        $user->sub_category_id = $request['subcategory'];
        $user->question_name = $request['QuestionName'];
        $user->question_short_description = $request['ShortNormal'];
        $user->updated_at = null;
        $user->admin_id = $id;
        $user->created_at = date('y-m-d');
        if($request->flexRadioDefault == 1)
        {
            $user->question_type =$request->flexRadioDefault;
            $user->question_description = $request['ques_desc_1'];
        }
        else if($request->flexRadioDefault ==2)
        {
            $user->question_type =$request->flexRadioDefault;
            $user->question_description = $request['ques_desc_2'];
        }
        if($request->file_type == 1)
        {
            $user->image_type = $request->file_type;
            $user->question_image = $request['file'];
            if($request->hasFile('file'))
            { 
                $destination_path = 'public/files/question';
                $image = $request['file'];
                $user->question_image= $request['file'];
                $image_name = $image->getClientOriginalName();
                $extension = pathinfo($image_name, PATHINFO_EXTENSION);
                $encrpt = round(microtime(true)*1000);
                $new_name = ($encrpt).'.'.$extension;
                $path = $request->file('file')->storeAs($destination_path , $new_name , '');
                $new_name = 'files/question/'.$new_name;
            }
            $uploaded_file = $new_name ?? '';        
            $user->question_image = $uploaded_file;
        }
        else if($request->file_type == 2)
        {
            $user->question_image =$request->url_image;
            $user->image_type = $request->file_type;
        }
        LogActivity::addToLog();
        $user->save();
        return back()->with('message','Question Created Successfully');
    }

    public function delete(Request $request, $id)
    {
        LogActivity::addToLog();
        $role = Auth::guard('admin')->user()->role;
        $AccessPrivilege = Auth::guard('admin')->user()->accountAccessPrivilege;
        $AccessModule = Auth::guard('admin')->user()->accountAccessModule;
        $explode = explode('|',$AccessModule);
        $explode_1 = explode('|',$AccessPrivilege);
        $module = Module::Select(['module_name'])->whereIn('module_name',$explode)->get();
        $permission=[];
        foreach($module as $row)
        {
            $permission[] = $row->module_name;
        }
        $permis = $permission;
        $array = array_intersect($explode, $permis);
        $array_1= in_array('delete',$explode_1);
        if(($role == "SuperAdmin") || ($array  && $array_1== true))
        {
            $Q1 = Question::find($id);
            $Q1->deleted_at = '1';
            $Q1->save();
            return back()->with('message','Delete Record Successfully');
        }
        else
        {
            return redirect()->route('admin.question')->with("error","Access Denied");
        }
    }
    public function EditQuestion($id)
    {
        // LogActivity::addToLog();
        $role = Auth::guard('admin')->user()->role;
        $AccessPrivilege = Auth::guard('admin')->user()->accountAccessPrivilege;
        $AccessModule = Auth::guard('admin')->user()->accountAccessModule;
        $explode = explode('|',$AccessModule);
        $explode_1 = explode('|',$AccessPrivilege);
        $module = Module::Select(['module_name'])->whereIn('module_name',$explode)->get();
        $permission=[];
        foreach($module as $row)
        {
            $permission[] = $row->module_name;
        }
        $permis = $permission;
        $array = array_intersect($explode, $permis);
        $array_1= in_array('edit',$explode_1);
        if(($role == "SuperAdmin") || ($array  && $array_1== true))
        {
            $edit = Question::find($id);
            $category = Category::where('deleted_at','0')->get();
            $array = array($edit);
            return view('admin.question.edit_question_list', ['edit_question_id'=> $array],['category_id' => $category]);
        }
        else
        {
            return redirect()->route('admin.question')->with("error","Access Denied");
        }
    }

    public function EditQuestionList(Request $request, $id)
    {
        $request->validate([
            'category'=>'required',
            'QuestionName' => 'required|string|max:255',
            'ShortNormal' => 'required',
            'file' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $question_list = Question::where('id',$id)->get();
        foreach($question_list as $rows)
        {
            $question_description = $rows->question_description;
            $old_version = $rows->question_version;
        }

        $version = $request->version;
        // dd($version);
        if($version == "Changed")
        {
            $user = Question::find($id);
            $update_version = $request->hidden + 1;
            $user->question_version = $update_version;
            $user->category_id = $request['category'];
            $user->sub_category_id = $request['subcategory'];
            $user->question_name = $request['QuestionName'];
            $user->question_short_description = $request['ShortNormal'];
            $user->question_image = $request['file'];
            if($request->flexRadioDefault == 1)
            {
                $user->question_type =$request->flexRadioDefault;
                $user->question_description = $request['ques_desc_1'];
            }
            else if($request->flexRadioDefault ==2)
            {
                $user->question_type =$request->flexRadioDefault;
                $user->question_description = $request['ques_desc_2'];
            }
            if($request->file_type == 1)
            {
                $user->image_type = $request->file_type;
                $user->question_image = $request['file'];
                if($request->hasFile('file'))
                { 
                    $destination_path = 'public/files/question';
                    $image = $request['file'];
                    $user->question_image= $request['file'];
                    $image_name = $image->getClientOriginalName();
                    $extension = pathinfo($image_name, PATHINFO_EXTENSION);
                    $encrpt = round(microtime(true)*1000);
                    $new_name = ($encrpt).'.'.$extension;
                    $path = $request->file('file')->storeAs($destination_path , $new_name , '');
                    $new_name = 'files/question/'.$new_name;
                }
                $uploaded_file = $new_name ?? '';        
                $user->question_image = $uploaded_file;
            }
            else if($request->file_type == 2)
            {
                $user->question_image =$request->url_image;
                $user->image_type = $request->file_type;
            }
            LogActivity::addToLog();
            $user->save();
            return back()->with('message','Question Edit Successfully');
        }
        else 
        {   
            $update_version = $request->hidden;
            if($request->flexRadioDefault ==2)
            {    
                    if($question_description != $request['ques_desc_2'])
                    {
                        if($old_version == $update_version)
                        {
                            $user = Question::find($id);
                            $update_version = $request->hidden + 1;
                            $user->question_version = $update_version + 1;
                            $user->question_type =$request->flexRadioDefault;
                            $user->question_description = $request['ques_desc_2'];
                            $user->save();
                            return back()->with('message','Question Edit Successfully');
                        }  
                    }
            }
            else
            {   
                return back()->with('message','no changes has been made');
            }
        }
    }
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) 
        {
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filenametostore = $filename.'_'.time().'.'.$extension;
            $filename_change = $request->file('upload')->storeAs('public/files/ckeditor_image',$filenametostore);
            $new_name = 'files/ckeditor_image/'.$filenametostore;
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/'.$new_name); 
            $msg = 'Image successfully uploaded'; 
            LogActivity::addToLog();
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8'); 
            echo $re;
        }
    }
}
