<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'workgroup_id', 'is_customer'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    const DEVELOPER = 0;
    const CUSTOMER = 1;

    // -------------------------------RELATIONS--------------------------------------

    /** N:N Workgroup **/
    public function workgroups()
    {
        return $this->belongsToMany('App\WorkGroup', 'workgroups_users', 'workgroup_id', 'user_id');

    }

    //N:N PROJECTS
    public function projects()
    {
        return $this->belongsToMany('App\Project', 'users_projects', 'user_id', 'project_id');

    }

    //N:N TAREAS
    public function tasks()
    {
        return $this->belongsToMany('App\Tasks');
    }

    //---------------------------------Methods------------------------------------

    public function getProjectPermissions($id)
    {

        $project_user = $this->projects()->where('project_id', $id)->get();
        $perm = $project_user->permissions;

    }

}
