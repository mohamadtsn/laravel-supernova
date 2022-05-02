<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Supernova\Theme\MenuManagerService;
use Cache;

class DashboardController extends Controller
{
    public function index()
    {
//        dd(app(MenuManagerService::class)->getCacheKey());
        $page_title = 'داشبورد';
        $page_description = 'داشبورد';

        return view('admin-panel.pages.dashboard', compact('page_title', 'page_description'));
    }
}
