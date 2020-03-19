<?php

namespace App\Http\Controllers;

use App\Question;

class VoteQuestionController extends Controller
{
    //
    /**
     * VoteQuestionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Question $question)
    {
        $vote = (int)request()->vote;

        $votesCount = auth()->user()->voteQuestion($question, $vote);

        if ( request()->expectsJson()
        ) {
            return response()

                ->json(                [
                    'message'=>'Thanks for voting',
                    'votesCount' => $votesCount

                ]
            );
        }

        return back();

    }
}
