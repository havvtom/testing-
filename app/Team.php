<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Team extends Model
{
   protected $fillable = ['name', 'size',];

   public function members(){

   	return $this->hasMany(User::class);
   }

   public function addUser($users){

      $this->guardAgainstTooManyUsers($users);

      if($users instanceOf User){
            
            return $this->members()->save($users);

         }else{
         	return $this->members()->saveMany($users);
         }

   }

   public function count(){

   	return count($this->members);
   }

   public function guardAgainstTooManyUsers($users){

   	$numberOfUsersToAdd = $users instanceOf User ? 1 : $users->count();

   	$numberOfUsers = 0; 

   	$numberOfUsers = $this->count() + $numberOfUsersToAdd;

      if($numberOfUsers >= $this->size){

        throw new \Exception;
      }
   }

}
