<?php

namespace App\Http\Controllers;

use App\Models\Answer;

class AcceptAnswerControler extends Controller
{
    public function __invoke(Answer $answer)
    {
        $this->authorize('accept',$answer);
        $answer->question->acceptBestAnswers($answer);
        if(request()->expectsJson()){
            return response()->json([
                'message' => 'You have answer accept'
            ]);
        }
        return back();
    }
}
