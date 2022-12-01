<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class InsertCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'InsertCron:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Description values are updated into null';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $category = DB::table('categories')->where('category_description','basic programming')->update(array('category_description' => null)); 
    }
}
