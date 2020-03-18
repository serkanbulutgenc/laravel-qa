<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class VoteAnswerController extends Controller
{
    //
    /**
     * VoteAnswerController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Answer $answer)
    {
        // TODO: Implement __invoke() method.

        $vote = request()->vote;

        $votesCount = auth()->user()->voteAnswer($answer,$vote);

        if( request()->expectsJson() ){
            return response()->json([
                'message'=>'Thanks for the feedback',
                'votesCount'=>$votesCount
            ]);
        }
        return back();

    }


}
