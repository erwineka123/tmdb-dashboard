<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Services\TMDbService;

class SyncController extends Controller
{
    public function syncMovies(TMDbService $tmdb)
    {
        $movies = $tmdb->getMovies();
        foreach ($movies as $movie) {
            $posterUrl = null;
            if (!empty($movie['poster_path'])) {
                $posterUrl = 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'];
            }

            Movie::updateOrCreate(
                ['tmdb_id' => $movie['id']],
                [
                    'title' => $movie['title'],
                    'overview' => $movie['overview'] ?? null,
                    'poster_url' => $posterUrl,
                    'genre' => $movie['genre'],
                    'release_date' => $movie['release_date'],
                    'rating' => $movie['vote_average'],
                    'synced_at' => now()
                ]
            );
        }
        // return redirect()->route('index')->with('success', 'Sync berhasil');
        return back()->with('success', 'Sync berhasil');
    }
}