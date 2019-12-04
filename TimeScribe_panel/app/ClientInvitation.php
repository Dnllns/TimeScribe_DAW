<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientInvitation extends Model
{
    //
    protected $table = 'clientinvitations';
    protected $fillable = ['project_id', 'email', 'hash', 'used'];
    public $timestamps = false;

    /** N:N Workgroup **/
    public function projects()
    {
        // return $this->belongsToMany('App\WorkGroup', 'workgroups_workgroupinvitations', 'workgroup_id', 'invitation_id');
        return $this->belongsTo('App\Project', 'clientinvitations', 'project_id', 'id');

    }

}
