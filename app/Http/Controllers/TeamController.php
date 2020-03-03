<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Team;

class TeamController extends Controller
{
    public function destroy(Team $team, User $user){

    	if($user instanceOf User){

    		$user->leaveTeam();
    		
    		}
		
    }

    public function delete(Team $team){

    	$team->members()->update(['team_id' => null]);
    }
}
