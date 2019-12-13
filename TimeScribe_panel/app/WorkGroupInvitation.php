<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkGroupInvitation extends Model
{
    //
    protected $table = 'workgroupinvitations';
    protected $fillable = ['workgroup_id', 'email', 'hash', 'used'];
    public $timestamps = false;

    /** N:N Workgroup **/
    public function workgroups()
    {
        // return $this->belongsToMany('App\WorkGroup', 'workgroups_workgroupinvitations', 'workgroup_id', 'invitation_id');
        return $this->belongsTo('App\WorkGroup', 'workgroupinvitations', 'workgroup_id', 'id');

    }




}
