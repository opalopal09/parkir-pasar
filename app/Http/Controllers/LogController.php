<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;

class LogController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::latest()->get();
        return view('log.index', compact('logs'));
    }
}
