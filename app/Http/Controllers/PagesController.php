<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index ()
    {
        $title = "Welcome To Laravel";
        $description = "This is laravel course for beginners";
        return view('pages.index', compact('title', 'description'));
    }

    public function about() 
    {
        $title = "This is About Us Page";
        return view('pages.about')->with('title', $title);
    }

    public function services()
    {
        $data = [
           'title' => 'Services Page',
           'services' => ['Web Development', 'Programming', 'Machine Learning']
        ];
        return view('pages.services')->with($data);
    }
}
