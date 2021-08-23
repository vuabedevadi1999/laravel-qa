<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AcceptAnswerControler extends Controller
{
    public function __invoke(Answer $answer)
    {
        dd('accepts');
    }
}
