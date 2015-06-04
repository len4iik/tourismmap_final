<?php

class NewsComment extends Eloquent
{
    protected $table = 'news_comments';

    public function news()
    {
        return $this->belongsTo('News');
    }

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    static public function createComment($data, $news_id)
    {
        try
        {
            $comment = new NewsComment();
            $comment->user_id = Auth::user()->id;
            $comment->news_id = $news_id;
            $comment->comment = $data['comment'];
        }
        catch(Exception $e)
        {
            return $e;
        }
        return $comment;
    }
}