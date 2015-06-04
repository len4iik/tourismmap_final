<?php

class UserController extends BaseController
{
    //new user registration
    public function createUser()
    {
        //collect all POST data
        $data = Input::all();
        //validation rules
        $rules = array(
            'name' => 'required|min:4|max:100',
            'surname' => 'required|min:4|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:30',
            'password_confirmation' => 'required|same:password'
        );
        //validate input data using rules
        $validator = Validator::make($data, $rules);
        //if validation detects mistakes, return errors with user input data
        if ($validator->fails())
        {
            return Redirect::route('createUser')->withErrors($validator)->withInput();
        }
        //if input data is correct
        else
        {
            //create new user using User model
            $user = User::createUser($data);
            //if user is saved successfully
            if($user->save())
            {
                //create a new profile record connected to this user, send him "welcome" e-mail and redirect to user main page
                $profile = new Profile;
                $profile->user_id = $user->id;
                $profile->about = '';
                $profile->save();
                Mail::send('emails.welcome', array('key' => 'value'), function($message) use ($data)
                {
                    $message->to($data['email'], $data['name'])->subject('Welcome to Tourismmap.net!');
                });
                Auth::login($user);
                return Redirect::route('userMainPage')->with('success', 'Successful registration');
            }
            //if database connection fails, show error message
            else
            {
                return Redirect::route('createUser')->with('fail', 'An error occurred');
            }
        }
    }

    public function mainPage()
    {
        $user = Auth::user();
        $countries = DB::table('user_countries')->where('user_id', $user->id)->get();
        $country_count = DB::table('user_countries')->where('user_id', $user->id)->count();
        return View::make('inner.usermainpage')->with('countries', $countries)->with('country_count', $country_count);
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::route('auth');
    }

    public function loginUser()
    {
        $data = Input::all();
        if (Auth::attempt(array('email' => $data['email'], 'password' => $data['password'])))
        {
            if(Auth::user()->isBlocked()) return View::make('auth.authdenied');
            else return Redirect::intended('/main');
        }
        //authentification failed
        return Redirect::route('auth')->with('fail', 'Your email/password combination was incorrect.')->withInput();
    }

}