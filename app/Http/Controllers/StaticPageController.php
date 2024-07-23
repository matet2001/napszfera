<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function terms() {
        return view('static.terms');
    }
    public function privacy() {
        return view('static.privacy');
    }

    public function claim() {
        return view('static.claim');
    }

    public function contact() {
        return view('static.contact');
    }

    public function about() {
        return view('static.about');
    }
}
