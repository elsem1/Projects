<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class TickerStatusController extends Controller
{
    public function index()
    {
        return DB::table('ticket_statuses')->select('id', 'name')->get();
    }
}
