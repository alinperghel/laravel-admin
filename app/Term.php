<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Term extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'content', 'user_id', 'phone_number', 'published_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];
    
    public function getUserName(){
        return User::find($this->user_id)->name;     
    }

}
