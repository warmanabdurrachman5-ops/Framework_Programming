<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $student = ['Anas', 'Budi', 'Asep', 'Nisa'];

        return view('student', ['student' => $student]);
    }
}
