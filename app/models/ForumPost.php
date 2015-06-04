<?php

class ForumPost extends Eloquent
{
    protected $table = 'forum_posts';

    public function group()
    {
        return $this->belongsTo('ForumGroup');
    }

    public function category()
    {
        return $this->belongsTo('ForumCategory');
    }

    public function comments()
    {
        return $this->hasMany('ForumComment', 'post_id');
    }

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    static public function createPost($data, $group_id, $category_id)
    {
        try
        {
            $post = new ForumPost();
            $post->user_id = Auth::user()->id;
            $post->group_id = $group_id;
            $post->category_id = $category_id;
            $post->title = $data['title'];
            $post->body = $data['body'];
        }
        catch(Exception $e)
        {
            return $e;
        }
        return $post;
    }

    static public function updatePost($id, $data)
    {
        try
        {
            $post = ForumPost::find($id);
            $post->title = $data['title'];
            $post->body = $data['body'];
        }
        catch(Exception $e)
        {
            return $e;
        }
        return $post;
    }
}