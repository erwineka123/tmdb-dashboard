@extends('layouts.app')

@section('content')
    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-box">
            <div class="spinner-border text-primary mb-2"></div>
            <div>Syncing data...</div>
        </div>
    </div>

    {{-- HEADER --}}
    <div class="page-header d-print-none mb-3">
        <div class="container-fluid px-0">
            <div class="row g-2 align-items-center justify-content-between">
                <div class="col-md-auto">
                    <div class="page-pretitle">TMDb Dashboard</div>
                    <h2 class="page-title mb-0">Movies Overview</h2>
                </div>
                <div class="col-md-auto mt-2 mt-md-0">
                    <form action="{{ route('sync.movies') }}" method="POST" id="syncForm" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-primary" id="syncButton">
                            <span id="syncText">Sync Data</span>
                            <span id="syncLoading" class="d-none">
                                <span class="spinner-border spinner-border-sm me-2"></span>
                                Syncing...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Filter by Date Range</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('/') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Start Date</label>
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h16" />
                            </svg>
                        </span>
                        <input type="date" name="start_date" class="form-control"
                            value="{{ $startDate ?? request('start_date') }}" placeholder="mm/dd/yyyy">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">End Date</label>
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h16" />
                            </svg>
                        </span>
                        <input type="date" name="end_date" class="form-control"
                            value="{{ $endDate ?? request('end_date') }}" placeholder="mm/dd/yyyy">
                    </div>
                </div>
                <div class="col-md-4 d-flex gap-2 justify-content-md-start justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Apply
                    </button>
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    Total Movies
                    <h3>
                        {{ $totalMovies }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    Last Sync
                    <h3>
                        {{ $lastSync ?? '-' }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row align-items-stretch">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="card chart-equal-height">
                <div class="card-header">
                    Genre Distribution
                </div>
                <div class="card-body">
                    <div id="genreChart"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card chart-equal-height">
                <div class="card-header">
                    Movies Added (Last 30 Days)
                </div>
                <div class="card-body">
                    <div id="dateChart"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Movies by Release Date
                </div>
                <div class="card-body">
                    <div id="releaseChart"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Top 5 Movies by Rating</h3>
                </div>
                <div class="card-body">
                    @if ($topRatedMovies->isEmpty())
                        <p class="text-secondary mb-0">No movies found for the selected period.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-vcenter mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 60px;">No</th>
                                        <th>Title</th>
                                        <th>Genre</th>
                                        <th class="text-center" style="width: 120px;">Rating</th>
                                        <th style="width: 160px;">Release Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topRatedMovies as $index => $movie)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $movie->title }}</td>
                                            <td>{{ $movie->genre }}</td>
                                            <td class="text-center">
                                                <span
                                                    class="badge bg-yellow-lt">{{ number_format($movie->rating, 1) }}</span>
                                            </td>
                                            <td>
                                                @if ($movie->release_date)
                                                    {{ \Carbon\Carbon::parse($movie->release_date)->format('M d, Y') }}
                                                @else
                                                    <span class="text-secondary">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.dashboardData = {
            genres: @json($genres),
            moviesPerDate: @json($moviesPerDate),
            moviesPerReleaseDate: @json($moviesPerReleaseDate)
        };
    </script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endpush
