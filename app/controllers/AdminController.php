<?php

class AdminController extends BaseController
{
    public function main()
    {
        $users = User::all();
        return View::make('inner.admin')->with('users', $users);
    }

    public function setAdmin($id)
    {
        $user = User::find($id);
        if($user == null)
        {
            return Redirect::route('admin')->with('fail', 'The user doesn\'t exist.');
        }

        if(!$user->isAdmin())
            $user->is_admin = 1;
        else $user->is_admin = 0;
        if($user->save())
        {
            return Redirect::route('admin')->with('success', 'The user\'s admin status changed!');
        }
        //if database connection fails
        else
        {
            return Redirect::route('admin')->with('fail', 'An error occurred.');
        }
    }

    public function blockUser($id)
    {
        $user = User::find($id);
        if($user == null)
        {
            return Redirect::route('admin')->with('fail', 'The user doesn\'t exist.');
        }

        if(!$user->isBlocked())
            $user->block_status = 1;
        else $user->block_status = 0;
        if($user->save())
        {
            return Redirect::route('admin')->with('success', 'The user\'s block status changed!');
        }
        //if database connection fails
        else
        {
            return Redirect::route('admin')->with('fail', 'An error occurred.');
        }
    }
}