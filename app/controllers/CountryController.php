<?php

class CountryController extends BaseController
{
    public function mainPage()
    {
        $countries = Country::orderBy('name', 'ASC')->get();
        return View::make('inner.countries.countriesmainpage')->with('countries', $countries);
    }

    public function countryPage($countryName)
    {
        $country = Country::where('name', '=', $countryName)->first();
        return View::make('inner.countries.countrypage')->with('country', $country);
    }

    public function delete($id)
    {
        $country = Country::find($id);
        if($country == null)
        {
            return Redirect::route('countries')->with('fail', 'The country doesn\'t exist.');
        }
        if($country->delete())
        {
            return Redirect::route('countries')->with('success', 'The country was deleted!');
        }
        return Redirect::route('countries')->with('fail', 'An error occurred.');
    }

    public function edit($countryName)
    {
        $country = Country::where('name', '=', $countryName)->first();
        if(Request::isMethod('post') && $country)
        {
            $data = Input::all();
            $rules = array(
                //'name' => 'required|min:2|max:200',
                'capital' => 'required|min:2|max:100',
                'area' => 'required|digits_between:1,10',
                'population' => 'required|digits_between:1,10|integer',
                'code' => 'required|min:2|max:3',
                'guide' => 'url',
                'languages' => 'required|min:2|max:200',
                'currency' => 'required|max:50',
                'timezone' => 'required|max:20',
                'description' => 'required|min:10|max:10000',
                'facts' => 'max:2000',
                'flag' => 'mimes:jpeg,jpg,png|image|max:6500',
            );
            $validator = Validator::make($data, $rules);
            if($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            //$country->name = $data['name'];
            $country->capital = $data['capital'];
            $country->area = $data['area'];
            $country->population = $data['population'];
            $country->code = $data['code'];
            $country->languages = $data['languages'];
            $country->currency = $data['currency'];
            $country->facts = $data['facts'];
            $country->timezone = $data['timezone'];
            $country->description = $data['description'];
            $country->guide = $data['guide'];
            $file = Input::file('flag');
            if($file)
            {
                $fileName = md5_file($file->getRealPath());
                $extension = $file->getClientOriginalExtension();
                $name = $fileName.'.'.$extension;
                $country->flag = '/img/flags/'.$name;
                $file->move(public_path()."/img/flags/", $name);
            }
            if($country->save())
            {
                return Redirect::route('countryPage', $countryName)->with('success', 'The country has been updated!');
            }
            //if database connection fails
            else
            {
                return Redirect::route('countryPage', $countryName)->with('fail', 'An error occurred.');
            }
        }
        return View::make('inner.countries.editCountry')->with('country', $country);
    }

    public function create()
    {
        if(Request::isMethod('post'))
        {
            $data = Input::all();
            $rules = array(
                'name' => 'required|min:2|max:200',
                'capital' => 'required|min:2|max:100',
                'area' => 'required|digits_between:1,10',
                'population' => 'required|digits_between:1,10|integer',
                'code' => 'required|min:2|max:3',
                'guide' => 'url',
                'languages' => 'required|min:2|max:200',
                'currency' => 'required|max:50',
                'timezone' => 'required|max:20',
                'description' => 'required|min:10|max:10000',
                'facts' => 'max:2000',
                'flag' => 'mimes:jpeg,jpg,png|image|max:6500',
            );
            $validator = Validator::make($data, $rules);
            if($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $country = new Country;
            $country->name = $data['name'];
            $country->capital = $data['capital'];
            $country->area = $data['area'];
            $country->population = $data['population'];
            $country->code = $data['code'];
            $country->languages = $data['languages'];
            $country->currency = $data['currency'];
            $country->facts = $data['facts'];
            $country->timezone = $data['timezone'];
            $country->description = $data['description'];
            $country->guide = $data['guide'];
            $file = Input::file('flag');
            if($file)
            {
                $fileName = md5_file($file->getRealPath());
                $extension = $file->getClientOriginalExtension();
                $name = $fileName.'.'.$extension;
                $country->flag = '/img/flags/'.$name;
                $file->move(public_path()."/img/flags/", $name);
            }
            if($country->save())
            {
                return Redirect::route('countryPage', $country->name)->with('success', 'The country has been created!');
            }
            //if database connection fails
            else
            {
                return Redirect::route('countries')->with('fail', 'An error occurred.');
            }
        }
        return View::make('inner.countries.newcountry');
    }
}