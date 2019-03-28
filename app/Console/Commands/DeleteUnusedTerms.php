<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\User;
use \App\Term;

class DeleteUnusedTerms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'terms:delete_unused';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unused terms from database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();
        $used_terms_id = $users->unique('terms_id');
        $terms = Term::orderBy('published_at', 'desc')->where('published_at', '!=', null)->get();
        
        foreach($terms as $term){
            if(count($used_terms_id->whereIn('terms_id', $term->id))==0){
                $term->delete();
            }
        }
    }
}
