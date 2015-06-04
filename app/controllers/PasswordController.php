<?php

class PasswordController extends BaseController
{
    public function remind()
    {
        return View::make('password.remind');
    }

    public function remindSend()
    {
        $data = Input::all();
        $user = User::where('email', '=', $data['email'])->first();
        if (!$user)
        {
            return Redirect::to('/password/reset')->with('bad', 'Sorry, but there is no user with such email!')->withInput();
        }

        $passwordReminder = new PasswordReminder;
        $passwordReminder->user_id = $user->id;
        $passwordReminder->email = $user->email;
        $passwordReminder->token = str_random(40);
        $token = $passwordReminder->token;
        $passwordReminder->save();
        $passwordId = $passwordReminder->id;
        Mail::send('emails.password', array('token' => $token, 'id' => $passwordId), function($message) use ($data)
        {
            $message->to($data['email'])->subject('Password reset!');
        });
        return Redirect::to('/password/reset')->with('good', 'Check your email for the link!')->withInput();
    }

    public function remindForm($id, $token)
    {
        $passwordReminder = PasswordReminder::whereRaw('id = ? and token = ?',array($token,$id))->firstOrFail();
        $user = $passwordReminder->user;
        if(Request::isMethod('post'))
        {
            $data = Input::all();
            $rules = array(
                'new_password' => 'required|min:6|max:50',
                'confirm_new_password' => 'required|same:new_password',
            );
            $validator = Validator::make($data, $rules);
            if($validator->fails())
            {
                return Redirect::route('remindForm', array($id, $token))->withErrors($validator)->withInput();
            }
            $user->password = Hash::make($data['new_password']);
            $user->save();
            $passwordReminder->delete();
            return Redirect::route('loginUser')->with('good', 'Password has been changed');
        }
        if (!$passwordReminder)
        {
            return Redirect::to('/password/reset')->with('bad', 'Sorry, but something goes wrong. Try resubmit your request!');
        }
        if ($passwordReminder->created_at < (new \DateTime('24 hours ago')))
        {
            return Redirect::to('/password/reset')->with('bad', 'Sorry, your link has expired!');
        }
        return View::make('password.forms');
    }
}