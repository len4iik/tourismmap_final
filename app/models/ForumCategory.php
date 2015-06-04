<?php

class ForumCategory extends Eloquent
{
    protected $table = 'forum_categories';

    public function group()
    {
        return $this->belongsTo('ForumGroup');
    }

    public function posts()
    {
        return $this->hasMany('ForumPost', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany('ForumComment', 'category_id');
    }

    static public function createCategory($data, $category_id)
    {
        try
        {
            $category = new ForumCategory();
            $category->user_id = Auth::user()->id;
            $category->group_id = $category_id;
            $category->title = $data['category_name'];
        }
        catch(Exception $e)
        {
            return $e;
        }
        return $category;
    }

    static public function updateCategory($id, $data)
    {
        try
        {
            $category = ForumCategory::find($id);
            $category->title = $data['category_name'];
        }
        catch(Exception $e)
        {
            return $e;
        }
        return $category;
    }
}