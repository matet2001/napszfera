<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function terms() {
        return view('legal.terms');
    }
    public function privacy() {
        return view('legal.privacy');
    }

    public function claim() {
        return view('legal.claim');
    }

    public function contact() {
        return view('static.contact');
    }

    public function about() {
        return view('static.about');
    }
}
