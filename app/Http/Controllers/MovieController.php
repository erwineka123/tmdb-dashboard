<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\returnArgument;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::query();
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->genre) {
            $query->where('genre', $request->genre);
        }

        if ($request->filled('release_date')) {
            $query->whereDate('release_date', $request->input('release_date'));
        }

        $allowedSortFields = ['updated_at', 'release_date', 'rating'];
        $sortField = $request->input('sort_field', 'updated_at');
        if (!in_array($sortField, $allowedSortFields, true)) {
            $sortField = 'updated_at';
        }

        $sortDirection = $request->input('sort_direction', 'desc') === 'asc' ? 'asc' : 'desc';
        $query->orderBy($sortField, $sortDirection);

        $movies = $query->paginate(10)
            ->appends($request->query());

        $genres = Movie::select('genre')
            ->distinct()
            ->pluck('genre');

        return view('movies.index', compact(
            'movies',
            'genres'
        ));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:movies,title'],
            'genre' => 'required',
            'release_date' => 'required|date',
            'poster_url' => 'nullable|string',
            'overview' => 'nullable|string',
        ]);

        Movie::create([
            'title' => $validated['title'],
            'genre' => $validated['genre'],
            'release_date' => $validated['release_date'],
            'poster_url' => $validated['poster_url'] ?? null,
            'overview' => $validated['overview'] ?? null,
            'synced_at' => now(),
        ]);

        return redirect()
            ->route('movies.index')
            ->with('success', 'Movie created successfully');
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('movies', 'title')->ignore($movie->id),
            ],

            'genre' => 'required',
            'release_date' => 'required|date',
            'poster_url' => 'nullable|string',
            'overview' => 'nullable|string',
        ]);

        $movie->update([
            'title' => $validated['title'],
            'genre' => $validated['genre'],
            'release_date' => $validated['release_date'],
            'poster_url' => $validated['poster_url'] ?? null,
            'overview' => $validated['overview'] ?? null,
        ]);

        return redirect()
            ->route('movies.index')
            ->with('success', 'Movie updated successfully');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()
            ->route('movies.index')
            ->with('success', 'Movie deleted successfully');
    }
}