<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
       /**
     * The databae table .
     *
     * @var string[]
     */
    protected $table = "cells";
    use HasFactory;

   /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'leader',
    ];


    public function members()
    {
        return $this->hasMany(Member::class);
    }
    
    public function leader()
    {
        return Member::find($this->leader);
    }


}
