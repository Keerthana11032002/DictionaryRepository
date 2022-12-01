<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Models\AppList;
use App\Models\Module;
Use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Question;
use App\Models\Dictionary;
use App\Helpers\LogActivity;
use App\Models\Category;

class DictionaryController extends Controller
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
            $questions = Dictionary::orderBy('id','asc')->where('deleted_at','0')->get();
            return view('admin.dictionary.dictionary_list',['dictionary'=> $questions]);
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
            return view('admin.dictionary.add_dictionary', ['category' => $category]);
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
                $app_active = Dictionary::find($cat_id);
                $app_active->is_active ='1';
                $app_active->save();
                return back()->with('message','Dictionary Disabled Successfully');
            }
            if($status == 1)
            {
                $app_active = Dictionary::find($cat_id);
                $app_active->is_active ='0';
                $app_active->save();
                return back()->with('message','Dictionary Enabled Successfully');
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
            'dictionaryName' => 'required|string|max:255',
        ]);
        $id = Auth::guard('admin')->user()->id;
        $user = new Dictionary;
        $user->category_id = $request['category'];
        // $user->sub_category_id = $request['subcategory'];
        $user->dictionary_name = $request['dictionaryName'];
        $user->updated_at = null;
        $user->admin_id = $id;
        if($request->flexRadioDefault == 1)
        {
            $user->dictionary_type =$request->flexRadioDefault;
            $user->dictionary_description = $request['ques_desc_1'];
        }
        else if($request->flexRadioDefault ==2)
        {
            $user->dictionary_type =$request->flexRadioDefault;
            $user->dictionary_description = $request['ques_desc_2'];
        }
        LogActivity::addToLog();
        $user->save();
        return back()->with('message','Dictionary Created Successfully');
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
            $Q1 = Dictionary::find($id);
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
            $edit = Dictionary::find($id);
            $category = Category::where('deleted_at','0')->get();
            $array = array($edit);
            return view('admin.dictionary.edit_dictionary_list', ['edit_question_id'=> $array],['category_id' => $category]);
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
            'dictionaryName' => 'required|string|max:255',
        ]);
        $user_id = Auth::guard('admin')->user()->id;
        $user =Dictionary::find($id);
        $user->category_id = $request['category'];
        // $user->sub_category_id = $request['subcategory'];
        $user->dictionary_name = $request['dictionaryName'];
        $user->admin_id = $user_id;
        if($request->flexRadioDefault == 1)
        {
            $user->dictionary_type =$request->flexRadioDefault;
            $user->dictionary_description = $request['ques_desc_1'];
        }
        else if($request->flexRadioDefault ==2)
        {
            $user->dictionary_type =$request->flexRadioDefault;
            $user->dictionary_description = $request['ques_desc_2'];
        }
        LogActivity::addToLog();
        $user->save();
        return back()->with('message','Dictionary Edited Successfully');
    }
   
}
