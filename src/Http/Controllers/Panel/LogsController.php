<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Logs;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        $data = Logs::with('user')->get();

        return view('panel.pages.logs', ['data' => $data]);
    }
}
