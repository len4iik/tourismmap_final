<?php

class UserCountry extends Eloquent {

    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function country()
    {
        return $this->belongsTo('Country');
    }
}