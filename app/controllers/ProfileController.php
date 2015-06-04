<?php

class ProfileController extends BaseController
{
    public function getProfile()
    {
        $countries = Auth::user()->countries()->get();
        //variable for user visited countries
        $userCountries = array();
        foreach($countries as $country)
        {
            $userCountries[] = Country::find($country->country_id)->name;
        }
        return View::make('inner.profile.profilemainpage')->with('userCountries', $userCountries);
    }

    public function editProfile()
    {
        $countriesList = Country::lists('name', 'id');
        return View::make('inner.profile.edit', array('countries' => $countriesList));
    }

    public function updateProfile()
    {
        $userId = $user = Auth::user()->id;
        $data = Input::all();
        $rules = array(
            'name' => 'required|min:4|max:50',
            'surname' => 'required|min:4|max:100',
            'profilePicture' => 'mimes:jpeg,jpg,png|image|max:6500',
            'about' => 'max:600'
        );
        $validator = Validator::make($data, $rules);
        if($validator->fails())
        {
            return Redirect::to('editProfile')->withErrors($validator)->withInput();
        }
        $profile = Profile::Where('user_id', '=', Auth::user()->id)->firstOrFail();
        $profile->about = Input::get('about');
        $user = User::find(Auth::user()->id);
        $user->name = Input::get('name');
        $user->surname = Input::get('surname');
        $user->birth_date = Input::get('Birth_Date');
        $file = Input::file('profilePicture');
        if($file)
        {
            //using md5 algorithm, generate file name
            $fileName = md5_file($file->getRealPath());
            $extension = $file->getClientOriginalExtension();
            $name = $fileName.'.'.$extension;
            $profile->profilePic = '/img/'.$name;
            $file->move(public_path()."/img", $name);
        }
        $countries = Input::get('select-items');
        UserCountry::where('user_id', '=', $userId)->delete();
        if(is_array($countries))
        {
            foreach($countries as $countryId)
            {
                $country = Country::findOrFail($countryId);
                $userCountry = new UserCountry();
                $userCountry->user_id = $user->id;
                $userCountry->country_id = $countryId;
                $userCountry->country_short_name = $country->code;
                $userCountry->save();
            }
        }
        $profile->save();
        $user->save();
        return Redirect::to('profile');
    }

    public function changePassword()
    {
        if(Request::isMethod('post'))
        {
            $user = Auth::user();
            $data = Input::all();
            $rules = array(
                'password' => 'required|min:6|max:50',
                'new_password' => 'required|min:6|max:50',
                'confirm_new_password' => 'required|same:new_password|min:6|max:50',
            );
            $validator = Validator::make($data, $rules);
            if($validator->fails())
            {
                return Redirect::to('changePassword')->withErrors($validator)->withInput();
            }
            if (!Hash::check(Input::get('password'), $user->password))
            {
                return Redirect::to('/changePassword')->with('badmessage', 'Your old password does not match');
            }
            $user->password = Hash::make(Input::get('new_password'));
            $user->save();
            return Redirect::to('/changePassword')->with('goodmessage', 'Password has been changed');
        }
        return View::make('inner.profile.changepassword');
    }
}