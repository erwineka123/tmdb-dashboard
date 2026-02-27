<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TMDbService
{
    public function getMovies()
    {
        $url = config('services.tmdb.base_url') . '/movie/now_playing';
        $response = Http::get($url, [
            'api_key' => config('services.tmdb.api_key')
        ]);

        $movies = $response->json()['results'];
        $genres = $this->getGenres();
        
        foreach ($movies as &$movie) {
            $genreNames = [];
            foreach ($movie['genre_ids'] as $genreId) {
                if (isset($genres[$genreId])) {
                    $genreNames[] = $genres[$genreId];
                }
            }
            $movie['genre'] = implode(', ', $genreNames);
        }
        return $movies;
    }

    public function getGenres()
    {
        $response = Http::get(
            config('services.tmdb.base_url') . '/genre/movie/list',
            [
                'api_key' => config('services.tmdb.api_key')
            ]
        );

        $genres = [];
        foreach ($response->json()['genres'] as $genre) {
            $genres[$genre['id']] = $genre['name'];
        }
        return $genres;
    }
}