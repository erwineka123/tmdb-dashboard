<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $baseQuery = Movie::query();

        if ($startDate && $endDate) {
            $baseQuery->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay(),
            ]);
        } elseif ($startDate) {
            $baseQuery->where('created_at', '>=', Carbon::parse($startDate)->startOfDay());
        } elseif ($endDate) {
            $baseQuery->where('created_at', '<=', Carbon::parse($endDate)->endOfDay());
        }

        $totalMovies = (clone $baseQuery)->count();
        $lastSync = (clone $baseQuery)->max('synced_at');

        // Note: Pie Chart
        $genres = (clone $baseQuery)
            ->selectRaw('genre, COUNT(*) as total')
            ->groupBy('genre')
            ->pluck('total', 'genre');

        $dateQuery = clone $baseQuery;

        if (!$startDate && !$endDate) {
            $dateQuery->where('created_at', '>=', Carbon::now()->subDays(30));
        }

        $moviesPerDate = $dateQuery
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        // Note: Column Chart
        $moviesPerReleaseDate = (clone $baseQuery)
            ->whereNotNull('release_date')
            ->selectRaw('release_date as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        // Note: Top 5 movies
        $topRatedMovies = (clone $baseQuery)
            ->whereNotNull('rating')
            ->orderByDesc('rating')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalMovies',
            'lastSync',
            'genres',
            'moviesPerDate',
            'moviesPerReleaseDate',
            'topRatedMovies',
        ))->with([
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                ]);
    }
}