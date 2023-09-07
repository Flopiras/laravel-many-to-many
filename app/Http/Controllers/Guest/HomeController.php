<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $projects = Project::orderBy('updated_at', 'DESC')->get();

        return view('guest.home', compact('projects'));
    }
}
