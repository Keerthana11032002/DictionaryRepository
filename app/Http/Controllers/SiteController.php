<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dictionary;
use App\Models\Description;
use App\Models\Category;
use App\Models\LetterCount;

class SiteController extends Controller
{
    public function category($from=null)
    {
        $languages=Category::all();
        return response()->view('sitemap.dictionary_site_language', compact('languages','from'))->header('Content-Type', 'text/xml');
    }

    public function dictionary($from=null)
    {
        $searchs=Dictionary::whereHas('category', function($q) use($from){
                                $q->whereSlug($from);
                            })->get();
        $languages=Category::all();
        return response()->view('sitemap.dictionary_site_search', compact('languages','searchs','from'))->header('Content-Type', 'text/xml');
    }

    public function letter($from=null)
    {
        $letters=LetterCount::whereHas('category', function($q) use($from){
                                $q->whereSlug($from);
                            })->get();
        $languages=Category::all();
        return response()->view('sitemap.dictionary_site_letter', compact('languages','letters','from'))->header('Content-Type', 'text/xml');
    }

    public function word($from=null)
    {
        $meanings=Dictionary::whereHas('category', function($q) use($from){
                                $q->whereSlug($from);
                            })->get();
        $languages=Category::all();
        return response()->view('sitemap.dictionary_site_word', compact('from','languages','meanings'))->header('Content-Type', 'text/xml');
    }

    public function map()
    {
        $languages=Category::all();
        return response()->view('sitemap.sitemap', compact('languages'))->header('Content-Type', 'text/xml');
    }
}