<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AnswerResource;

class AnswersController extends Controller
{
    public function index(Question $question)
    {
        $answers =  $question->answers()
            ->with('user')
            ->where(function($q){
                if(request()->has('excludes')){
                    $q->whereNotIn('id', request()->query('excludes'));
                }
            })
            ->simplePaginate(3);

        return AnswerResource::collection($answers);
      }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        //
        $answer = $question->answers()->create($request->validate([
            'body'=>'required'
        ])+ ['user_id'=>Auth::id()]);

            return response()->json([
                'message'=>'Your answer has been submiited successfully',
                'answer'=>new AnswerResource( $answer->load('user') )
            ]);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        //
        $this->authorize('update',$answer);

        return  view('answers.edit',compact('question','answer'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        //
        $this->authorize('update',$answer);

        $answer->update($request->validate([
            'body'=>'required'
        ]));


            return response()->json([
                'message'=>'your answer has been updated',
                'body_html'=>$answer->body_html
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        //
        $this->authorize('delete',$answer);

        $answer->delete();


            return response()->json([
                'message'=>'Your answer has been deleted'
            ]);

    }
}
