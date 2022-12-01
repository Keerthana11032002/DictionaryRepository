<?php

namespace App\Http\Controllers;
use App\Models\AppList;
use App\Models\MappedAppCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Helpers\LogActivity;
class MappedApp extends Controller
{
    public function insert(Request $request, $id)
    {
        $app_id = $id; 
        $res = MappedAppCategory::where('app_id',$app_id)->delete();
        $count = $request->input('countries');
        $countlist = $count ?? '';
        if (is_array($countlist) || is_object($countlist))
        {
            foreach($count as $count)
            {
                        
                LogActivity::addToLog();
                MappedAppCategory::create([
                    'app_id' => $id,
                    'category_id' =>$count
                ]);
            }
        }
        return back()->with('message','Category Mapped Successfully');
    }
}
