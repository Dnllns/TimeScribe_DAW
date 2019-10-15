<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{

    protected $fillable = [
        'price', 'project_id'
    ];


    public function project()
    {
        return $this->belongsTo('App\Project');
    }



}
