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

   	$this->members()->save($user);
   }

   public function count(){

   	return count($this->members);
   }
}
