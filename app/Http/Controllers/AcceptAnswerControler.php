<?php

namespace App\Http\Controllers;

use App\Models\Answer;

class AcceptAnswerControler extends Controller
{
    public function __invoke(Answer $answer)
    {
        $this->authorize('accept',$answer);
        $answer->question->acceptBestAnswers($answer);
        return back();
    }
}
