<?php

namespace App\Http\Controllers\Point;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        return view('point.pages.reports');
    }
}
