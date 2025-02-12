<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('Admin.admindashboard');
    }
}
