<?php

namespace App\Http\Controllers\Admin;

use App\Models\Game;
use App\Models\Question;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard(){
        $users = User::count();
        $questions = Question::where('status', 'active')->count();
        $games = Game::count();
        return view('admin.index', compact('users', 'questions', 'games'));
    }
}

