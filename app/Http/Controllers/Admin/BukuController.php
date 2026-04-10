<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BukuController extends Controller
{
    public function index()
    {
        return view('admin.buku.index');
    }
}
