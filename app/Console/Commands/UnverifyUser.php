<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class UnverifyUser extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:unverify {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unverify a user email based on ID';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $user = User::find($this->argument('id'));
        $user->markEmailAsUnverified();
        $user->save();
        $this->info('User:' . $user->name . ' with email: ' . $user->email . ' was unverified');
    }

}
