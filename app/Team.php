<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Team extends Model
{
   protected $fillable = ['name', 'size', ''];

   public function members(){

   	return $this->hasMany(User::class);
   }

   public function addUser($user){

      $this->guardAgainstTooManyUsers();

      if($user instanceOf User){
            
            return $this->members()->save($user);

         }else{

            foreach($user as $member){
               $this->guardAgainstTooManyUsers();
               return $this->members()->save($member);
            }
         }

   }

   public function count(){

   	return count($this->members);
   }

   public function guardAgainstTooManyUsers(){

      if($this->count() >= $this->size){

        throw new \Exception;
      }
   }

}
