<?php

class Country extends Eloquent
{
    protected $table = 'countries';

    public $timestamps = true;

    static public function createCountry($data)
    {
        try
        {
            $country = new Country();
            $country->name = $data['name'];
            $country->capital = $data['capital'];
            $country->languages = $data['languages'];
            $country->area = $data['area'];
            $country->population = $data['population'];
            $country->currency = $data['currency'];
            $country->timezone = $data['timezone'];
            $country->code = $data['code'];
            $country->description = $data['description'];
            $country->facts = $data['facts'];
        }
        catch(Exception $e)
        {
            return $e;
        }
        return $country;
    }

    static public function updateCountry($id, $data)
    {
        try
        {
            $country = Country::find($id);
            $country->name = $data['name'];
            $country->capital = $data['capital'];
            $country->languages = $data['languages'];
            $country->area = $data['area'];
            $country->population = $data['population'];
            $country->currency = $data['currency'];
            $country->timezone = $data['timezone'];
            $country->code = $data['code'];
            $country->description = $data['description'];
            $country->facts = $data['facts'];
        }
        catch(Exception $e)
        {
            return $e;
        }
        return $country;
    }
}