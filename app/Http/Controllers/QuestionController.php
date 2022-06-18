<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of all questions with options based on assessment id.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'assessment_id' => 'required',
        ]);
        $questions = Question::with(['options' => function ($query) {
            //maybe need id in the $query->select
            $query->select(['title', 'question_id']);
        }])->where('assessment_id', $validatedData['assessment_id'])->get();

        return $questions;
    }

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
            'assessment_id' => 'required',
            // 'options' => 'required'
        ]);

        // $options = [];
        // foreach ($request->options as $option) {
        //     $createdOption = Option::create($option);
        //     array_push($options, $createdOption);
        // }

        $question = Question::create($validatedData);
        // $question->options()->saveMany($options);
    }

    /**
     * Update the specified question in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, Request $request)
    {
        $question->update($request->all());
    }

    /**
     * Remove the specified question from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
    }
}
