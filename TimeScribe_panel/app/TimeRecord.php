<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeRecord extends Model
{

    /**
     * --------------------------Class--------------------------------
     * ---------------------------------------------------------------
     */

    #region Class

        //DB TABLE
        protected $table = 'timerecords';

        public $timestamps = false;
    
        protected $fillable = [
            'user_id',
            'task_id',
            'start_date',
            'finish_date',
            'status'
        ];
    
        const STATUS_DRAFT = 0;
        const STATUS_FINAL = 1;

    #enregion


    
    /**
     * --------------------------RELATIONS----------------------------
     * ---------------------------------------------------------------
     */

    
    #region relations
    
        public function task()
        {
            return $this->belongsTo('App\Task');
        }

    #endregion

}
