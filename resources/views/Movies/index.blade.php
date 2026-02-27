@extends('layouts.app')

@push('styles')
    @vite(['resources/css/movies.css'])
@endpush

@section('content')
    {{-- HEADER --}}
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        TMDb Dashboard
                    </div>
                    <h2 class="page-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon me-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                            <path d="M8 4l0 16" />
                            <path d="M16 4l0 16" />
                            <path d="M4 8l4 0" />
                            <path d="M4 16l4 0" />
                            <path d="M4 12l16 0" />
                            <path d="M16 8l4 0" />
                            <path d="M16 16l4 0" />
                        </svg>
                        Movies Management
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('movies.create') }}" class="btn btn-primary d-none d-sm-inline-block"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; box-shadow: 0 4px 15px 0 rgba(116, 79, 168, 0.4);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon me-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Add New Movie
                        </a>
                        <a href="{{ route('movies.create') }}" class="btn btn-primary d-sm-none btn-icon"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; box-shadow: 0 4px 15px 0 rgba(116, 79, 168, 0.4);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BODY --}}
    <div class="page-body">
        <div class="container-xl">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon alert-icon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="alert-title">Success!</h4>
                            <div class="text-secondary">{{ session('success') }}</div>
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon me-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" />
                        </svg>
                        Filter Movies
                    </h3>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('movies.index') }}">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Search</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M21 21l-6 -6" />
                                        </svg>
                                    </span>
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Search by title..." value="{{ request('search') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Release Date</label>
                                <input type="date" name="release_date" class="form-control"
                                    value="{{ request('release_date') }}">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Genre</label>
                                <select name="genre" class="form-select">
                                    <option value="">All Genres</option>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre }}"
                                            {{ request('genre') == $genre ? 'selected' : '' }}>
                                            {{ $genre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div class="btn-list d-flex gap-2">
                                    <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary"
                                        data-bs-toggle="tooltip" title="Reset Filter">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                        </svg>
                                    </a>
                                    <button type="submit" class="btn btn-primary flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon me-1">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M21 21l-6 -6" />
                                        </svg>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Movies List</h3>
                    <div class="card-actions">
                        <span class="text-secondary">
                            Total: <strong>{{ $movies->total() }}</strong> movies
                        </span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                        <thead>
                            <tr>
                                <th>Poster</th>
                                <th>Title</th>
                                <th>Genre</th>
                                <th>
                                    @php
                                        $isReleaseSorted = request('sort_field') === 'release_date';
                                        $currentReleaseDirection = request('sort_direction', 'desc');
                                        $nextReleaseDirection = $isReleaseSorted && $currentReleaseDirection === 'asc' ? 'desc' : 'asc';

                                        $releaseSortUrl = route('movies.index', array_merge(request()->query(), [
                                            'sort_field' => 'release_date',
                                            'sort_direction' => $nextReleaseDirection,
                                        ]));
                                    @endphp

                                    <a href="{{ $releaseSortUrl }}" class="text-decoration-none text-body">
                                        Release Date
                                        @if ($isReleaseSorted)
                                            @if ($currentReleaseDirection === 'asc')
                                                <span class="ms-1">&uarr;</span>
                                            @else
                                                <span class="ms-1">&darr;</span>
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th class="text-center">
                                    @php
                                        $isRatingSorted = request('sort_field') === 'rating';
                                        $currentRatingDirection = request('sort_direction', 'desc');
                                        $nextRatingDirection = $isRatingSorted && $currentRatingDirection === 'asc' ? 'desc' : 'asc';

                                        $ratingSortUrl = route('movies.index', array_merge(request()->query(), [
                                            'sort_field' => 'rating',
                                            'sort_direction' => $nextRatingDirection,
                                        ]));
                                    @endphp

                                    <a href="{{ $ratingSortUrl }}" class="text-decoration-none text-body">
                                        Rating
                                        @if ($isRatingSorted)
                                            @if ($currentRatingDirection === 'asc')
                                                <span class="ms-1">&uarr;</span>
                                            @else
                                                <span class="ms-1">&darr;</span>
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th>Last Update</th>
                                <th class="text-center" width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        <tbody>
                            @forelse($movies as $movie)
                                <tr>
                                    <td>
                                        <div class="avatar avatar-lg"
                                            style="background-image: url({{ $movie->poster_url ?? 'https://via.placeholder.com/92x138?text=No+Poster' }})">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="font-weight-medium">{{ $movie->title }}</div>
                                            <div class="text-secondary">
                                                <small>{{ Str::limit($movie->overview ?? 'No description', 50) }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        @foreach (explode(', ', $movie->genre) as $genre)
                                            <span class="badge bg-azure-lt mb-1">{{ trim($genre) }}</span>
                                        @endforeach
                                    </td>

                                    <td>
                                        <div class="text-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon me-1">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                <path d="M16 3v4" />
                                                <path d="M8 3v4" />
                                                <path d="M4 11h16" />
                                                <path d="M11 15h1" />
                                                <path d="M12 15v3" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($movie->release_date)->format('M d, Y') }}
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="currentColor" class="icon text-yellow me-1">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                                            </svg>
                                            <strong>{{ number_format($movie->rating, 1) }}</strong>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="text-secondary">
                                            <small>{{ $movie->updated_at->format('Y-m-d H:i:s') }}</small>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-sm btn-white"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="View Details">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon text-azure">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path
                                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-sm btn-white"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Movie">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon text-warning">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-white" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete Movie"
                                                onclick="confirmDelete({{ $movie->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon text-danger">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </button>
                                        </div>
                                        <form id="delete-form-{{ $movie->id }}"
                                            action="{{ route('movies.destroy', $movie->id) }}" method="POST"
                                            class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty">
                                            <div class="empty-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                                    <path d="M8 4l0 16" />
                                                    <path d="M16 4l0 16" />
                                                    <path d="M4 8l4 0" />
                                                    <path d="M4 16l4 0" />
                                                    <path d="M4 12l16 0" />
                                                    <path d="M16 8l4 0" />
                                                    <path d="M16 16l4 0" />
                                                </svg>
                                            </div>
                                            <p class="empty-title">No movies found</p>
                                            <p class="empty-subtitle text-secondary">
                                                Try adjusting your search or filter to find what you're looking for.
                                            </p>
                                            <div class="empty-action">
                                                <a href="{{ route('movies.index') }}" class="btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                                    </svg>
                                                    Clear filters
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($movies->hasPages())
                    <div class="card-footer">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <div class="mb-3 mb-md-0">
                                <p class="m-0 text-secondary small">
                                    Showing
                                    <strong>{{ $movies->firstItem() }}</strong>
                                    to
                                    <strong>{{ $movies->lastItem() }}</strong>
                                    of
                                    <strong>{{ $movies->total() }}</strong>
                                    entries
                                </p>
                            </div>
                            <div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination m-0">
                                        @if ($movies->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M15 6l-6 6l6 6" />
                                                    </svg>
                                                    Previous
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $movies->previousPageUrl() }}"
                                                    rel="prev">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M15 6l-6 6l6 6" />
                                                    </svg>
                                                    Previous
                                                </a>
                                            </li>
                                        @endif

                                        @foreach (range(1, $movies->lastPage()) as $page)
                                            @if ($page == $movies->currentPage())
                                                <li class="page-item active"><span
                                                        class="page-link">{{ $page }}</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $movies->url($page) }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach

                                        @if ($movies->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $movies->nextPageUrl() }}" rel="next">
                                                    Next
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M9 6l6 6l-6 6" />
                                                    </svg>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    Next
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M9 6l6 6l-6 6" />
                                                    </svg>
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        function confirmDelete(movieId) {
            if (confirm('Are you sure you want to delete this movie?')) {
                document.getElementById('delete-form-' + movieId).submit();
            }
        }
    </script>
@endpush