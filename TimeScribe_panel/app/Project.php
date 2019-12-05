<?php

namespace App;

use App\WorkGroup;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    // -------------------------------MODELDATA--------------------------------------
    // ------------------------------------------------------------------------------

    #region data

        //PROJECT STATUSS
        const STATUS_TODO = 0;
        const STATUS_DOING = 1;
        const STATUS_DONE = 2;

        //PROJECT PERMISSIONS
        const PERM_ALL = 0;
        const PERM_WORK = 1;
        const PERM_VIEW = 2;

        //VISIBILITY
        const INVISIBLE = 0;
        const VISIBLE = 1;

        //DB TABLE
        protected $table = 'projects';
        public $timestamps = false;

        protected $fillable = [
            'name',
            'description',
            'status',
            'visible',
            'client_id',
            'workgroup_id',
            'start_date',
            'finish_date',
        ];

    #endregion

    // -------------------------------RELATIONS--------------------------------------
    // ------------------------------------------------------------------------------

    #region relations

        // 1:N
        public function workgroups()
        {
            return $this->belongsTo('App\WorkGroup', 'workgroup_id', 'id');
            // return $this->belongsTo('App\WorkGroup');

        }

        //N:N USERS
        public function users()
        {
            return $this->belongsToMany('App\User', 'users_projects', 'project_id', 'user_id');
        }

        //1:N TASKGROUP
        public function taskGroups()
        {
            return $this->hasMany('App\TaskGroup');
        }

        //1:1 BILLS
        public function bill()
        {
            return $this->hasOne('App\Bill');
        }

    #endregion

    // -------------------------------FUNCTIONS--------------------------------------
    // ------------------------------------------------------------------------------

    #region functions

        /**
         * GET PORCENTAJE
         * ----------------
         * Obtiene el porcentaje de completado para este proyecto basandose
         * en el porcentaje de completado que tienen sus grupos de tarea.
         * @return Integer, el porcentaje calculado
         */
        public function getPercentCompleted()
        {

            $taskGroups = $this->taskGroups;
            $percent = 0;
            $result = 0;
            $count = 0;

            foreach ($taskGroups as $taskgroup) {

                if (count($taskgroup->tasks) != 0) {
                    $percent += $taskgroup->getPercentCompleted();
                    $count += 1;
                }
            }

            try {
                $result = $percent / $count;
            } catch (\Exception $e) {
                //posible division por 0
            }

            return $result;
        }


        /**
         * GET DESARROLLADORES
         * ----------------------
         * Obtiene los desarrolladores que pueden participar en el proyecto
         * @return Collection[User], una coleccion con los usuarios
         */
        public function getDevelopers()
        {
            return $this->users()->where('permissions', Project::PERM_WORK)->orWhere('permissions', Project::PERM_ALL)->get();
        }



        /**
         * Obtiene los permisos que tiene el usuario en este proyecto
         * @param Integer $userId, el id del usuario
         */
        public function getUserPermission($userId){

            $relationData = $this->users()->where('user_id', $userId)->withPivot('permissions')->get()->toArray();
            $permissions = $relationData[0]["pivot"]["permissions"];
            return $permissions;

        }


        public function getBreadCrumbs(){


            $wgroup_name = $this->workgroups()->first()->name;
            $wgroup_id = $this->workgroups()->first()->id;

            $wg_route = "<a class='text-info' href='/workgroup-show/" . $wgroup_id . "'>" . $wgroup_name  . "</a>";

            return $wg_route . "<span class='text-secondary'>/</span>" . $this->name;
        }

    #endregion

}
