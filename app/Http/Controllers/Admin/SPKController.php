<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\SPK;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SPKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('spks.index');
    }
}
