<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppList;
use App\Models\Category;
use App\Models\MappedAppCategory;
use App\Models\SubCategory;
use App\Models\Dictionary;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function App()
    {
        $resArr=[];
        $responseArr = array('result' => '0' ,'message'=>'failed','data'=> []);
        
        $app = AppList::Select('id','app_name','app_description','app_image')->where('deleted_at','0')->get();
        
        if(!empty($app) && count($app) )
        {
            foreach($app as $row)
            {   
                $temp['app_id'] = (string) $row->id ?? '';
                $temp['app_name'] = $row->app_name ?? '';
                $temp['app_image'] = $row->app_image ?? 'https://picsum.photos/200'; 
                $temp['app_description'] = $row->app_description ?? '' ;
                array_push($resArr, $temp);
            }
            
            if(!empty($resArr)){
                $responseArr = array('result'=>'1', 'data'=> $resArr, 'message'=>'Success');
            }else{
                $responseArr = array('result'=>'0', 'data'=> $resArr, 'message'=>'No Data Found');
            }
        }
        else
        {
            $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found',);
        }   
        return response()->json($responseArr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Category(Request $request)
    {
        $page = $request->page;
        $app_id = $request->app_id;

        $app = MappedAppCategory::select(['app_id','category_id'])->where('app_id', $app_id)->get();
        $mapped_app=[];
        foreach($app as $row)
        {
            $mapped_app[] = $row->category_id;
        }
        $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found',);
        if(!empty($app) && count($app))
        {
            $category = Category::Select(['id as category_id','category_name','category_description','category_image'])->whereIn('id', $mapped_app)->paginate(5);
            foreach($category as $row)
            {   
                $row['category_id'] = (string) $row->category_id ?? '';
                $row['category_name'] = $row->category_name ?? '';
                $row['category_image'] = $row->category_image ?? 'https://picsum.photos/200'; 
                $row['category_description'] = $row->category_description ?? '' ;
            }
            if(!empty($category))
            {
                $responseArr = array('result'=>'1', 'data'=> $category->items(),'total'=>(string) $category->total(),'currentPage'=>(string) $category->currentPage(),'perPage'=> (string) $category->perPage(),'lastPage'=> (string) $category->lastPage(), 'message'=>'Success');
            }
            else
            {
                $responseArr = array('result'=>'0', 'data'=> $resArr, 'message'=>'No Data Found');
            }
        }
        
        return response()->json($responseArr);
    }


    public function SubCategory(Request $request)
    {
        $category = $request->category_id;
        $resArr=[];
        $responseArr = array('result' => '0' ,'message'=>'failed','data'=> []);
        
        $sub_category = SubCategory::select(['id','sub_category_name','sub_category_description','sub_category_image'])->where('category_id',$category)->paginate(5);
        
        if(!empty($sub_category) && count($sub_category) )
        {
            foreach($sub_category as $row)
            {   
                $temp['sub_category_id'] = (string) $row->id ?? '';
                $temp['sub_category_name'] = $row->sub_category_name ?? '';
                $temp['sub_category_image'] = $row->sub_category_image ?? 'https://picsum.photos/200'; 
                $temp['sub_category_description'] = $row->sub_category_description ?? '' ;
                array_push($resArr, $temp);
            }
            
            if(!empty($resArr)){
                $responseArr = array('result'=>'1', 'data'=> $resArr,'total'=>(string) $sub_category->total(),'currentPage'=>(string) $sub_category->currentPage(),'perPage'=> (string) $sub_category->perPage(),'lastPage'=> (string) $sub_category->lastPage(), 'message'=>'Success');
            }else{
                $responseArr = array('result'=>'0', 'data'=> $resArr, 'message'=>'No Data Found');
            }
        }
        else
        {
            $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found',);
        }  
        
        return response()->json($responseArr);
    }

    public function DictionaryCategoryList(Request $request)
    {
        $category = $request->dictionary_category_id;
        $resArr=[];
        $responseArr = array('result' => '0' ,'message'=>'failed','data'=> []);
        
        $sub_category = Dictionary::select('id','dictionary_name','dictionary_description','category_id')->where('category_id',$category)->get();
        
        if(!empty($sub_category) && count($sub_category) )
        {
            foreach($sub_category as $row)
            {   
                $temp['dictionary_id'] = (string) $row->id ?? '';
                $temp['dictionary_name'] = $row->dictionary_name ?? '';
                $temp['dictionary_description'] = $row->dictionary_description ?? '' ;
                $temp['category_id'] = $row->category_id ?? '' ;
                array_push($resArr, $temp);
            }
            
            if(!empty($resArr)){
                $responseArr = array('result'=>'1', 'data'=> $resArr, 'message'=>'Success');
            }else{
                $responseArr = array('result'=>'0', 'data'=> $resArr, 'message'=>'No Data Found');
            }
        }
        else
        {
            $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found',);
        }  
        
        return response()->json($responseArr);
    }

    public function DictionarySubCategoryList(Request $request)
    {
        $sub_category = $request->sub_category_id;

        $resArr=[];
        $responseArr = array('result' => '0' ,'message'=>'failed','data'=> []);
        
        $question = Dictionary::select(['id','dictionary_name','dictionary_description','category_id'])->where('sub_category_id',$sub_category)->get();
        
        if(!empty($question) && count($question) )
        {
            foreach($question as $row)
            {   
                $temp['dictionary_id'] = (string) $row->id ?? '';
                $temp['dictionary_name'] = $row->dictionary_name ?? '';
                $temp['dictionary_description'] = $row->dictionary_description ?? '' ;
                $temp['category_id'] = (string) $row->category_id ?? '';
                array_push($resArr, $temp);
            }
            
            if(!empty($resArr)){
                $responseArr = array('result'=>'1', 'data'=> $resArr, 'message'=>'Success');
            }else{
                $responseArr = array('result'=>'0', 'data'=> $resArr, 'message'=>'No Data Found');
            }
        }
        else
        {
            $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found',);
        }  
        
        return response()->json($responseArr);
    }

    public function Dictionary(Request $request)
    {
        $Dictionary_id = $request->dictionary_id;
        // dd($Dictionary_id);
        $resArr=[];
        // $temp=[];
        $responseArr = array('result' => '0' ,'message'=>'failed','data'=> []);
        
        $Dictionary = Dictionary::select('id','dictionary_name','dictionary_description')->where('id',$Dictionary_id)->get();
        // dd($Dictionary);
        if(!empty($Dictionary) && count($Dictionary) )
        {
            foreach($Dictionary as $row)
            {   
                $temp['dictionary_id'] = (string) $row->id ?? '';
                $temp['dictionary_name'] = $row->dictionary_name ?? '';
                $temp['dictionary_description'] = $row->dictionary_description ?? '' ;
                array_push($resArr, $temp);
            }
            if(!empty($resArr)){
                $responseArr = array('result'=>'1', 'data'=> $resArr, 'message'=>'Success');
            }else{
                $responseArr = array('result'=>'0', 'data'=> $resArr, 'message'=>'No Data Found');
            }
        }
        else
        {
            $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found',);
        }  
        
        return response()->json($responseArr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     if(!empty(($request->app_name) && !empty($request->app_description)))
    //     {
    //         $add_app = AppList::create([
    //             'app_name' => $request->input('app_name'),
    //             'app_description' => $request->input('app_description')
    //         ]);
    //         if($add_app)
    //         {
    //             $array = array('status' => '200','message'=>'Create App Successfully','data'=>$add_app);
    //             return response()->json([$array]);
    //         }
    //         else
    //         {
    //             $array = array('status' => '404','message'=>'Something Went Wrong','data'=>'');
    //             return response()->json([$array]);
    //         }
    //     }
    //     else
    //     {
    //         if(!isset($request->app_name) && empty($request->app_name) === True)
    //         {			
    //             $value_e = array("status" => "400","message" => "App Name is required","data" => "");
    //             return response()->json([$value_e]);
    //         }
    //         else if(!isset($request->app_description) && empty($request->app_description))
    //         {
    //             $value_e = array("status" => "400","message" => "App Description is Required","data" => "");
    //             return response()->json([$value_e]);			
    //         }
    //         else
    //         {
    //             $value_e = array("status" => "400","message" => "Required fields are missing","data" => "");
    //             return response()->json([$value_e]);	
    //         }
    //     }
    // }

    // public function search(Request $request)
    // {
    //     $app_id = $request->app_id;
    //     $resArr = [];
    //     $map = MappedAppCategory::select('category_id')->where('app_id',$app_id)->get();
    //     $category_id = [];
    //     foreach($map as $row)
    //     {
    //         $category_id[]= $row->category_id;
    //     }
    //     $search = $request->search;
    //     $resArr = [];
    //     $resArr_1= [];
    //     $resArr_2 = [];
    //     $responseArr = array('result'=>'0', 'data'=> $resArr, 'message'=>'required field are missing');
    //     if(!empty($search) && !empty($category_id))
    //     {
    //         $users = Question::select(['id','question_name','question_description','question_short_description','category_id','sub_category_id'])
    //         ->whereIn('category_id',$category_id)
    //         ->where([['question_name', '!=', Null],
    //             [function ($query) use ($search) {
    //                         $query->Where('question_name', 'LIKE', '%' . $search . '%');
    //                 }]])->limit(15)->get();

    //         $category = Category::select(['id','category_name','category_description'])
    //         ->where([['category_name', '!=', Null],
    //         [function ($query) use ($search) {
    //                     $query->Where('category_name', 'LIKE', '%' . $search . '%');
    //             }]])->limit(15)->get();
            
    //         $sub_category = SubCategory::select(['id','sub_category_name','sub_category_description','category_id'])
    //         ->whereIn('category_id',$category_id)
    //         ->where([['sub_category_name', '!=', Null],
    //         [function ($query) use ($search) {
    //                     $query->Where('sub_category_name', 'LIKE', '%' . $search . '%');
    //             }]])->limit(15)->get();

    //         $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found');

    //         if(!empty($users) && count($users) || !empty($category) && count($category) || !empty($sub_category) && count($sub_category))
    //         {  
    //             foreach($users as $row)
    //             {   
    //                 $temp['question_id'] = (string) $row->id ?? '';
    //                 $temp['question_name'] = $row->question_name ?? '';
    //                 $temp['category_id'] = (string) $row->category_id ?? '';
    //                 $temp['sub_category_id'] = (string) $row->sub_category_id ?? '';
    //                 array_push($resArr, $temp);
    //             }

    //             foreach($category as $row_1)
    //             {   
    //                 $temp_1['category_id'] = (string) $row_1->id ?? '';
    //                 $temp_1['category_name'] = $row_1->category_name ?? '';
    //                 array_push($resArr_1, $temp_1);
    //             }
    //             foreach($sub_category as $row_2)
    //             {   
    //                 $temp_2['sub_category_id'] = (string) $row_2->id ?? '';
    //                 $temp_2['sub_category_name'] = $row_2->sub_category_name ?? '';
    //                 $temp_2['category_id'] = (string) $row_2->category_id;
    //                 array_push($resArr_2, $temp_2);
    //             }
    //             $responseArr = array('result'=>'1', 'data'=> ["category" => $resArr_1 ?? [], "subcategory"=> $resArr_2 ?? [], "question" => $resArr ?? []], 'message'=>'Success');  
    //         }            
    //     }
    //     return response()->json($responseArr);
    // }


    public function paginate(Request $request)
    {
        $app_id = $request->app_id;
        $search = $request->search;
        $page = $request->page;
        if($page == Null && !empty($search) && !empty($app_id))
        {
            $resArr=[];
            $map = MappedAppCategory::select('category_id')->where('app_id',$app_id)->get();
            $category_id = [];
            foreach($map as $row)
            {
                $category_id[] = $row->category_id;
            }
            // dd($category_id);
            $responseArr = array('result'=>'0', 'data'=> [], 'message'=>'required field are missing');
            if(!empty($search) && !empty($category_id))
            {
                
                $users = Dictionary::select(['id','dictionary_name','dictionary_description','category_id'])
                ->whereIn('category_id',$category_id)
                ->where([['dictionary_name', '!=', Null],
                    [function ($query) use ($search) {
                                $query->Where('dictionary_name', 'LIKE', '%' . $search . '%');
                        }]])->get();
                $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found',);
                if(!empty($users) && count($users))
                {  
                    foreach($users as $row)
                    {
                        $temp['dictionary_id'] = (string) $row->id ?? '';
                        $temp['dictionary_name'] = $row->dictionary_name ?? '';
                        $temp['dictionary_description'] = $row->dictionary_description ?? '' ;
                        $temp['category_id'] =(string) $row->category_id ?? '' ;
                        array_push($resArr, $temp);
                    }
                    $responseArr = array('result'=>'1', 'data'=> $resArr, 'message'=>'Success');
                }
            }
            return response()->json($responseArr);
        }
        else
        {
            $app_id = $request->app_id;
            $search = $request->search;
            $map = MappedAppCategory::select('category_id')->where('app_id',$app_id)->get();
            $category_id = [];
            foreach($map as $row)
            {
                $category_id[] = $row->category_id;
            }
            $resArr=[];
            $responseArr = array('result'=>'0', 'data'=> [], 'message'=>'required field are missing');

            if(!empty($search) && !empty($category_id))
            {
                
                $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found');

                $users = Dictionary::select(['id','dictionary_name','dictionary_description','category_id'])
                ->whereIn('category_id',$category_id)
                ->where([['dictionary_name', '!=', Null],
                    [function ($query) use ($search) {
                                $query->Where('dictionary_name', 'LIKE', '%' . $search . '%');
                        }]])->paginate(5);
                if(!empty($users) && count($users))
                {  
                    foreach($users as $row)
                    {
                        $temp['dictionary_id'] = (string) $row->id ?? '';
                        $temp['dictionary_name'] = $row->dictionary_name ?? '';
                        $temp['dictionary_description'] = $row->dictionary_description ?? '' ;
                        $temp['category_id'] =(string) $row->category_id ?? '' ;
                        array_push($resArr, $temp);
                        
                    }
                    $responseArr = array('result'=>'1', 'data'=> $resArr,'total'=>(string) $users->total(),'currentPage'=>(string) $users->currentPage(),'perPage'=> (string) $users->perPage(),'lastPage'=> (string) $users->lastPage(), 'message'=>'Success');
                }
            }   
            return response()->json($responseArr);
        }
    }

    // public function version(Request $request)
    // {   
    //     $question_id = $request->question_id;
    //     $updated_questions = $request->question_version;

    //     $responseArr = array('result'=>'0', 'data'=> [], 'message'=>'required field are missing');

    //     $question = Question::find($question_id);        

    //     if($updated_questions)
    //     {
    //         $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found',);
    //         if(!empty($question))
    //         { 
    //             $data= [];
                
    //             $responseArr = array('result'=>'0', 'data'=> $data, 'message'=>'No Changes Update');

    //             if($question->question_version > $updated_questions ) 
    //             { 
    //                 $data['question_id'] = (string) $question->id ?? '';
    //                 $data['question_name'] = $question->question_name ?? ''; 
    //                 $data['question_description'] = $question->question_description ?? '' ;
    //                 $data['question_short_description'] = $question->question_short_description ?? "75 Questions in array and 105 questions are hard";
    //                 $data['question_version'] = $question->question_version ?? '1' ;

    //                 $responseArr = array('result'=>'1', 'data'=> $data, 'message'=>'Question Update');
    //             }
    //         }
    //     }
    //     return response()->json($responseArr);

    // }
}
