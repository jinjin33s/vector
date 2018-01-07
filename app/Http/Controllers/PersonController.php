<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests; 
use App\Person;
use App\interest;
use App\Http\Requests\StorePerson;
use App\Http\Resources\Person as PersonResource;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Persons
        $person = Person::paginate(10);

        //Return collection of person as a resource
        return PersonResource::collection($person);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // If methoud is 'put' update with requested inputs
        // If not(=>'post'), create a new person record
        $params = $request->all();

        if (
            !array_key_exists("first_name",$params) ||
            !array_key_exists("last_name",$params) ||
            !array_key_exists("age",$params) ||
            !array_key_exists("email",$params) ||
            !array_key_exists("admission_date",$params) ||
            !array_key_exists("admission_time",$params) ||
            !array_key_exists("interests",$params) ||
            !array_key_exists("is_active",$params)
        ){
            return "Make sure all required keys are present";
        }

        $person = $request->isMethod('put') ? Person::findOrFail($request->person_id) : new Person;

        $interestsArray = $request->input('interests');
        $person->id = $request->input('person_id');
        $person->first_name = $request->input('first_name');
        $person->last_name = $request->input('last_name');
        $person->age = $request->input('age');
        $person->email = $request->input('email');
        $person->admission_date = $request->input('admission_date');
        $person->admission_time = $request->input('admission_time');
        $person->is_active = $request->input('is_active');

        if($person->save()) {
            for ($i = 0 ; $i < count($interestsArray); $i++){
                $interest = new interest([
                    'person_id' => $person->id,
                    'name' => $interestsArray[$i]
                ]);
                $interest->save();
            }

            return new PersonResource($person);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get single person
        $person = Person::findOrFail($id);

        // Return single person as a resource
        return '<h1>Person Number '.$id.'</h1><br>'.json_encode(new PersonResource($person));
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get person
        $person = Person::findOrFail($id);

        // Delete the person record
        if($person->delete()){
            return new PersonResource($person);
        }
    }
}
