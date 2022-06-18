<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    /**
     * Display a listing of all assessments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { //maybe need id in the $query->select
        $assessments = Assessment::with(['personalities' => function ($query){
            $query->select(['title', 'description', 'assessment_id']);
        }])->get();

        return $assessments;
    }

    /**
     * Store a newly created assessment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'unique:assessments', 'max:255'],
            'description' => 'required',
        ]);
        Assessment::create($validatedData);
    }

    /**
     * Update the specified assessment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Assessment $assessment, Request $request)
    {
        $assessment->update($request->all());
    }

    /**
     * Remove the specified assessment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assessment $assessment)
    {
        $assessment->delete();
    }
}
