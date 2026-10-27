<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Staff;
use App\Models\Achievement;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total data untuk ditampilkan di dashboard
        $totalNews = News::count();
        $totalStaff = Staff::count();
        $totalAchievements = Achievement::count();

        return view('admin.dashboard', compact('totalNews', 'totalStaff', 'totalAchievements'));
    }
}
