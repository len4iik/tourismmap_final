<?php

class ForumComment extends Eloquent
{
    protected $table = 'forum_comments';

    public function group()
    {
        return $this->belongsTo('ForumGroup');
    }

    public function category()
    {
        return $this->belongsTo('ForumCategory');
    }

    public function post()
    {
        return $this->belongsTo('ForumPost');
    }

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    static public function createComment($data, $group_id, $category_id, $post_id)
    {
        try
        {
            $comment = new ForumComment();
            $comment->user_id = Auth::user()->id;
            $comment->group_id = $group_id;
            $comment->category_id = $category_id;
            $comment->post_id = $post_id;
            $comment->comment = $data['comment'];
        }
        catch(Exception $e)
        {
            return $e;
        }
        return $comment;
    }
}