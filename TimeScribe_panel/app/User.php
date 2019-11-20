<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    
    /**
     * --------------------------CLASS--------------------------------
     * ---------------------------------------------------------------
     */

    #region class

        protected $fillable = ['name', 'email', 'password', 'workgroup_id', 'is_admin'];
        protected $hidden = ['password', 'remember_token'];
        protected $casts = ['email_verified_at' => 'datetime'];

        const DEVELOPER = 0;
        const CUSTOMER = 1;

    #endregion

    /**
     * --------------------------RELATIONS----------------------------
     * ---------------------------------------------------------------
     */

     #region relations

        /** N:N Workgroup **/
        public function workgroups()
        {
            return $this->belongsTo('App\WorkGroup', 'workgroup_id', 'id');
        }

        //N:N PROJECTS
        public function projects()
        {
            return $this->belongsToMany('App\Project', 'users_projects', 'user_id', 'project_id');
        }

        //N:N TAREAS
        public function tasks()
        {
            return $this->belongsToMany('App\Tasks', 'tasks_users', 'task_id', 'user_id');
        }

    #endregion

    /**
     * --------------------------FUNCIONES----------------------------
     * ---------------------------------------------------------------
     */

    #region funciones



    #endregion

}
