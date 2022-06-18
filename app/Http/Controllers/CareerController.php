<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display a listing of all careers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $careers = Career::with(['comments' => function ($query){
             //maybe need id in the $query->select
            $query->select(['message', 'career_id', 'user_id']);
            $query->with(['user', function($query){
                 //maybe need id in the $query->select
                $query->select('name');
            }]);
        }])->get();

        return $careers;
    }

    /**
     * Store a newly created career in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:careers', 'max:255'],
            'salary' => 'required',
        ]);

        if ($request->description)
            array_push($validatedData, ["description" => $request->description]);
        if ($request->work_routine)
            array_push($validatedData, ["work_routine" => $request->work_routine]);
        Career::create($validatedData);
    }

    /**
     * Update the specified career in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Career $career, Request $request)
    {
        $career->update($request->all());
    }

    /**
     * Remove the specified career from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Career $career)
    {
        $career->delete();
    }
}
