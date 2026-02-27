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
                        <a href="{{ route('movies.index') }}" class="text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l14 0" />
                                <path d="M5 12l6 6" />
                                <path d="M5 12l6 -6" />
                            </svg>
                            Back to Movies
                        </a>
                    </div>
                    <h2 class="page-title">
                        Movie Details
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                <path d="M16 5l3 3" />
                            </svg>
                            Edit Movie
                        </a>
                        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="d-inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this movie?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BODY --}}
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <img src="{{ $movie->poster_url ?? 'https://via.placeholder.com/300x450?text=No+Poster' }}"
                                    alt="{{ $movie->title }}" class="img-fluid rounded shadow-sm"
                                    style="max-height: 450px; width: 100%; object-fit: cover;">
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="text-center">
                                            <div class="h1 mb-0 d-flex align-items-center justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                    viewBox="0 0 24 24" fill="currentColor" class="icon text-yellow me-2">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                                                </svg>
                                                {{ number_format($movie->rating, 1) }}
                                            </div>
                                            <div class="text-secondary">Rating</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                @foreach (explode(', ', $movie->genre) as $genre)
                                    <span class="badge bg-azure-lt me-1 mb-1">{{ trim($genre) }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title mb-0">{{ $movie->title }}</h3>
                                <div class="card-subtitle text-secondary">Information</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="datagrid mb-4">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Release Date</div>
                                    <div class="datagrid-content">
                                        {{ \Carbon\Carbon::parse($movie->release_date)->format('F d, Y') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Last Synced</div>
                                    <div class="datagrid-content">
                                        {{ $movie->synced_at ? \Carbon\Carbon::parse($movie->synced_at)->diffForHumans() : 'Never' }}
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Last Updated</div>
                                    <div class="datagrid-content">{{ $movie->updated_at->diffForHumans() }}</div>
                                </div>
                            </div>

                            <div>
                                <h3 class="mb-3">Overview</h3>
                                <p class="text-secondary mb-0">
                                    {{ $movie->overview ?? 'No overview available for this movie.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
