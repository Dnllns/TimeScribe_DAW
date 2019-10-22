<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimeRecord;


class TimeRecordController extends Controller
{

    public function removeLastTimerecord($task_id)
    {

        $user_id = auth()->user()->id;

        //SELECT * from timerecords where user_id=1 AND task_id=1 ORDER BY id DESC LIMIT 1;

        //ELoquent query
        $lastTimerecord = TimeRecord::
            where('user_id', $user_id)->
            where('task_id', $task_id)->
            orderBy('id', 'desc')->
            take(1);

        $lastTimerecord->forceDelete();
    }

}
