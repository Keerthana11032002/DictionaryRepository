<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\AppList;
use App\Models\Module;
Use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\MappedAppCategory;
use App\Helpers\LogActivity;

use Illuminate\Database\Eloquent\Relations\HasMany;

class AppController extends Controller
{
    //
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
            $app = AppList::orderBy('id','asc')->where('deleted_at','0')->get();
            $active = AppList::where('is_active','1')->get();
            return view('admin.applist.app_list', ['apps' => $app],['app_active'=>$active]);
        }
        else
        {
            return redirect()->route('admin/dashboard')->with("error","Access Denied");
        }
    }

    function Add_list()
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
        $array_1= in_array('add',$explode_1);
        if(($role == "SuperAdmin") || ($array  && $array_1== true))
        {
            return view('admin.applist.add_app');
        }
        else
        {
            return redirect()->route('admin/dashboard')->with("error","Access Denied");
        }
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'app_name' => 'required|string|max:255',
            'app_description' => 'required',
            'file' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);

        $user = new AppList;
        $user->app_name = $request['app_name'];
        $user->app_description = $request['app_description'];
        $user->app_image = $request['file'];

        if($request->file_type == 1)
        {
            $user->image_type = $request->file_type;
            $user->app_image = $request['file'];
            if($request->hasFile('file'))
            { 
                $destination_path = 'public/files/app';
                $image = $request['file'];
                $user->app_image= $request['file'];
                $image_name = $image->getClientOriginalName();
                $extension = pathinfo($image_name, PATHINFO_EXTENSION);
                $encrpt = round(microtime(true)*1000);
                $new_name = ($encrpt).'.'.$extension;
                $path = $request->file('file')->storeAs($destination_path , $new_name , '');
                $new_name = 'files/app/'.$new_name;
            }
            $uploaded_file = $new_name ?? '';        
            $user->app_image = $uploaded_file;
        }
        else if($request->file_type == 2)
        {
            $user->app_image = $request->url_image;
            $user->image_type = $request->file_type;
        }
        LogActivity::addToLog();
        $user->save();
        return back()->with('message','App Created Successfully');
    }

    public function edit($id)
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
            $edit = AppList::find($id);
            $category = Category::where('deleted_at','0')->get();
            $mapped_res = MappedAppCategory::select(['category_id'])->where('app_id',$id)->get();
            $mapped_app=[];
            foreach($mapped_res as $row)
            {
                    $mapped_app[] = $row->category_id;
            }
            return view('admin.applist.mapped_app_category', ['edit'=> $edit,'category_list'=>$category,'mapped_app'=>$mapped_app]);
        }
        else
        {
            return redirect()->route('admin.dashboard')->with("error","Access Denied");
        }

    }

    public function active(Request $request)
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
            $parent_id = $request->app_id;
            $status = $request->status;
            if($status == 0)
            {
                $app_active = AppList::find($parent_id);
                $app_active->is_active ='1';
                $app_active->save();
                return back()->with('message','App Disabled Successfully');
            }
            if($status == 1)
            {
                $app_active = AppList::find($parent_id);
                $app_active->is_active ='0';
                $app_active->save();
                return back()->with('message','App Enabled Successfully');
            }
        }
        else
        {
            return redirect()->route('admin.dashboard')->with("error","Access Denied");
        }
        
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
            $Q1 = AppList::find($id);
            $Q1->deleted_at = '1';
            $Q1->save();
            return back()->with('message','Delete Record Successfully');
        }
        else
        {
            return redirect()->route('admin.dashboard')->with("error","Access Denied");
        }
    }

    public function EditApp($id)
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
            $edit = AppList::find($id);
            $array = array($edit);
            return view('admin.applist.edit_app_list', ['edit_app_id'=> $array]);
        }
        else
        {
            return redirect()->route('admin.dashboard')->with("error","Access Denied");
        }
    }
    
    public function EditAppList(Request $request, $id)
    {
        
        $request->validate([
            'edited_app_name' => 'required|string|max:255',
            'edited_app_description' => 'required',
            'file' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);
        $app_version = $request->hidden;
        $app = AppList::all();
        foreach($app as $row)
        {
            $app_name = $row->app_name;
            $app_description = $row->app_description;
            $app_image = $row->app_image;
            $old_version = $row->app_version;
        }
        $user = AppList::find($id);
        // dd($user);
        $user->app_version = $app_version + 1;
        $user->app_name = $request->input('edited_app_name');
        $user->app_version = $app_version + 1;
        $user->app_description = $request->input('edited_app_description');
        if($request->file_type == 1)
        {
            $user->image_type = $request->file_type;
            $user->app_image = $request['file'];
            if($request->hasFile('file'))
            { 
                $destination_path = 'public/files/app';
                $image = $request['file'];
                $user->app_image= $request['file'];
                $image_name = $image->getClientOriginalName();
                $extension = pathinfo($image_name, PATHINFO_EXTENSION);
                $encrpt = round(microtime(true)*1000);
                $new_name = ($encrpt).'.'.$extension;
                $path = $request->file('file')->storeAs($destination_path , $new_name , '');
                $new_name = 'files/app/'.$new_name;
            }
            $uploaded_file = $new_name ?? '';        
            $user->app_image = $uploaded_file;
        }
        else if($request->file_type == 2)
        {
                $user->app_image = $request->url_image;
                $user->image_type = $request->file_type;
        }
        LogActivity::addToLog();
        $user->save();
        return back()->with('message','App Edit Successfully');
    }
}
