<?php

namespace App\Http\Controllers;

use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalPosts'     => Post::count(),
            'totalPublished' => Post::published()->count(),
            'totalDraft'     => Post::draft()->count(),
            'totalTrashed'   => Post::onlyTrashed()->count(),
            'latestPosts'    => Post::latest()->take(5)->get(),

            'perBulan' => Post::pluck('created_at')
            ->groupBy(fn ($tgl) => $tgl->format('Y-m'))
            ->map->count()
            ->sortKeysDesc()
            ->take(6),
        ]);
    }
}

