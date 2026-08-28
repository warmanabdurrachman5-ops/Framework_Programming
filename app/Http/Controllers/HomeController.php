<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home', [
            'Judul' => 'Belajar_Laravel',
            'Pesan' => 'Enviroment Sudah Siap Untuk Digunakan',]);
    }
}
