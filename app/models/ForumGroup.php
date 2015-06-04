<?php

class ForumGroup extends Eloquent
{
    protected $table = 'forum_groups';

    public function categories()
    {
        return $this->hasMany('ForumCategory', 'group_id');
    }

    public function posts()
    {
        return $this->hasMany('ForumPost', 'group_id');
    }

    public function comments()
    {
        return $this->hasMany('ForumComment', 'group_id');
    }

    static public function createGroup($data)
    {
        try
        {
            $group = new ForumGroup();
            $group->user_id = Auth::user()->id;
            $group->title = $data['group_name'];
        }
        catch(Exception $e)
        {
            return $e;
        }
        return $group;
    }

    public function isHidden()
    {
        return ($this->is_hidden == 1);
    }
}