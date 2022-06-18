<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Personality;
use Illuminate\Http\Request;

class PersonalityController extends Controller
{
    /**
     * Store a newly created question in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'assessment_id' => 'required',
            'careers' => 'required'
        ]);
        $careers = [];
        foreach ($request->careers as $career) {
            $createdCareer = Career::create($career);
            array_push($careers, $createdCareer);
        }
        $personality = Personality::create($validatedData);
        $personality->careers()->attach($careers);
    }

    /**
     * Update the specified question in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Personality $personality, Request $request)
    {
        $personality->update($request->all());
    }

    /**
     * Remove the specified question from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personality $personality)
    {
        $personality->delete();
    }
}
