<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Dictionary;
use App\Models\Description;
use App\Models\Category;
use App\Models\LetterCount;
use Illuminate\Support\Facades\DB;
class WebController extends Controller
{
    public function dictionaries(Request $request, $slug=null)
    {   
        $from = 'English';
        $to = 'English';
        $letter = $request->letter??'';
        $search = $request->search??'';
        if($slug!=null){
            // dd($slug);
            $value = explode('-to-',$slug);
            $from = $value[0];
            $to = $value[1];
        }


        $list = Dictionary::paginate(10);
        $language = Category::all();
        $letters = LetterCount::where('category_id',2)->get();
        return view('website/english_dictionary',compact('from','to','letter','search', 'list','language','letters'));

    }
    
    public function letters(Request $request)
    {
        $id = $request->category;
        $letters = LetterCount::where('category_id',$id)->get();
        $responseArr = array('result'=>'1', 'data'=> ["letters" => $letters ?? array(),],);
        return response()->json($responseArr);
    }

    public function wordlist(Request $request,$from,$main)
    {
        $lang = explode('-to-',$request->from);
        $from = $lang[0];
        $to = $lang[1];
        $word = explode('-meaning-in-',$request->main);
        $main = $word[0];
        $cat_mean = Category::where('slug',$to)->pluck('id')->first();
        $meaning = Description::whereHas('dictionary', function($q) use($word){
                                $q->where('dictionary_name', 'like', $word[0]."%");
                            })
                            ->whereTranslateCategoryId($cat_mean)
                            ->paginate(10);
         return view('website/dictionary',['from' => $from, 'to' => $to, 'word' => $main, 'meaning' => $meaning] ); 
    }
    
    public function words(Request $request)
    {
        $from_lng = $request->from_lng;
        $to_lng = $request->to_lng;
        $search = $request->search;
        $letter = $request->letter;
        
        if(empty($search) && empty($letter)){
            if(empty($to_lng)){
                $list = Description::whereCategoryId($from_lng)->paginate(10);
                // dd($list);
            }else{
                $list = Description::whereTranslateCategoryId($to_lng)
                                    ->whereCategoryId($from_lng)
                                    ->paginate(10);
                                    // dd($list);
            }
        }else{

            if(!empty($search)){
                if(empty($to_lng)){
                    $list = Description::whereHas('dictionary', function($q) use($search){
                                            $q->where('dictionary_name', 'like',"%". $search."%");
                                        })
                                        ->whereCategoryId($from_lng)
                                        ->paginate(10);
                }else{
                    $list = Description::whereHas('dictionary', function($q) use($search){
                                            $q->where('dictionary_name', 'like',"%".$search."%");
                                            // ->where('dictionary_name', 'like', '%'.$search."%")
                                        })->whereTranslateCategoryId($to_lng)
                                        ->whereCategoryId($from_lng)
                                        ->paginate(10);
                }
            }else{
                if(empty($to_lng)){
                    $list = Description::whereHas('dictionary', function($q) use($letter){
                                            $q->where('dictionary_name', 'like', $letter."%");
                                        })
                                        ->whereCategoryId($from_lng)
                                        ->paginate(10);
                }else{
                    $list = Description::whereHas('dictionary', function($q) use($letter){
                                            $q->where('dictionary_name', 'like',$letter."%");
                                        })->whereTranslateCategoryId($to_lng)
                                        ->whereCategoryId($from_lng)
                                        ->paginate(10);
                }
            }
        }
        $html = view('website.description', compact('list'))->render();
        $responseArr = array('result'=>'1', 
                             'data'=> [
                                    "htmldata" => $html ?? array()
                                ]
                            );  
        return response()->json($responseArr);
    }
}
