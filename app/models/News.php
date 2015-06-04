<?php

class News extends Eloquent
{
    protected $table = 'news';

    public function comments()
    {
        return $this->hasMany('NewsComment', 'news_id');
    }
}