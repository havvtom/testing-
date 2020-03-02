<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Like;
use App\Traits\Likeability;

class Post extends Model
{
	use Likeability;
}
