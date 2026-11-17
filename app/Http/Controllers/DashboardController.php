<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Contact;

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
            'totalMessages'  => Contact::count(),
            'unreadMessages' => Contact::where('is_read', false)->count(),

            'perBulan' => Post::pluck('created_at')
            ->groupBy(fn ($tgl) => $tgl->format('Y-m'))
            ->map->count()
            ->sortKeysDesc()
            ->take(6),
        ]);
    }
}

