<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Cache;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin-panel.pages.dashboard', [
            'page_title' => 'داشبورد',
            'page_description' => 'داشبورد مدیریت'
        ]);
    }
}
