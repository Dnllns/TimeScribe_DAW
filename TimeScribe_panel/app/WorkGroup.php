<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkGroup extends Model
{
    //

    protected $fillable = ['name', 'admin_id'];

    // -------------------------------RELATIONS--------------------------------------

    #region Relations 

    /** 1:N users **/
    public function users()
    {
        return $this->hasMany('App\User');
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
