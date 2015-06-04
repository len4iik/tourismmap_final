<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class User extends Eloquent implements UserInterface, RemindableInterface, StaplerableInterface {

	use UserTrait, RemindableTrait, EloquentTrait;

	//mass-assignable properties
	protected $fillable = [ 'name', 'surname', 'email', 'password'];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	//create new user using $data array
	static public function createUser($data)
	{
		try
		{
			$user = new User();
			$user->name = $data['name'];
			$user->surname = $data['surname'];
			$user->email = $data['email'];
			$user->password = Hash::make($data['password']);
		}
		catch(Exception $e)
		{
			return $e;
		}
		return $user;
	}

	//declare relation between users and profiles tables
	public function profile()
	{
		return $this->hasOne("Profile", "user_id");
	}

	//check if the user is admin
	public function isAdmin()
	{
		return ($this->is_admin == 1);
	}

	//check if the user is blocked
	public function isBlocked()
	{
		return ($this->block_status == 1);
	}

    //declare relation between users and user_countries tables
	public function countries()
    {
        return $this->hasMany("UserCountry", "user_id");
    }
}
