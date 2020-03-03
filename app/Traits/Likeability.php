<?php

namespace App\Traits;
use App\Like;

trait Likeability{

	public function like()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

  	public function likes(){

  		$like = new Like(['user_id' => Auth()->user()->id]);

  		$this->like()->save($like);
  	}

  	public function isLiked(){

  		return !! $this->like()->where(['user_id' => Auth()->user()->id])->count();
  	}

  	public function unlike(){

  		return $this->like()->where(['user_id' => Auth()->user()->id])->delete();
  	}

  	public function toggle(){

  		if (!$this->isLiked()){
  			$this->likes();
  		}else{
  			$this->unlike();
  		}
  	}

  	public function getLikesCountAttribute(){

  		return $this->like()->count();
  	}
}