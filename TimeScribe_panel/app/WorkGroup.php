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
        return $this->belongsToMany('App\User', 'workgroups_users', 'workgroup_id', 'user_id');
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
