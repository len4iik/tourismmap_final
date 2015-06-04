<?php

class Profile extends Eloquent {

    protected $fillable = array('user_id', 'about', 'profilePic');
    protected $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongsTo('User');
    }
}