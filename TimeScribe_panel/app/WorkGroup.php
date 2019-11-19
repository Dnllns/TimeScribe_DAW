<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkGroup extends Model
{
    //
    protected $table = 'workgroups';
    protected $fillable = ['name'];
    public $timestamps = false;


    // -------------------------------RELATIONS--------------------------------------

    #region Relations 

    /** N:N users **/
    public function users()
    {
        // return $this->hasMany('App\User', 'workgroups_users', 'workgroup_id', 'user_id');
        return $this->hasMany('App\User');

    }

    public function projects()
    {
        // return $this->hasMany('App\User', 'workgroups_users', 'workgroup_id', 'user_id');
        return $this->hasMany('App\Project', 'workgroup_id', 'id');

    }


    /** N:N workgroupinvitations **/
    public function workGroupInvitations()
    {
        return $this->belongsToMany('App\WorkGroupInvitation', 'workgroups_workgroupinvitations', 'workgroup_id', 'invitation_id');
    }


    #endregion 


    // -------------------------------FUNCTIONS--------------------------------------
    #region Functions

    /**
     * Obtener los desarrolladores que pertenecen al Workgroup
     * @return Collection[User] 
     */
    public function getAllDevelopers(){
        return $this->users()->get();
    }

    #region



}
