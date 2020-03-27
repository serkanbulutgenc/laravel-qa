<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Http\Controllers\Controller;

class VoteAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        // TODO: Implement __invoke() method.

        $vote = request()->vote;

        $votesCount = auth()->user()->voteAnswer($answer, $vote);


        return response()->json(
            [
                'message'    => 'Thanks for the feedback',
                'votesCount' => $votesCount
            ]
        );

        return response()->json(
            [
                'message'    => 'Thanks for the feedback',
                'votesCount' => $votesCount
            ]
        );

    }


}
