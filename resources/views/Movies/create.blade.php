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
						Add New Movie
					</h2>
				</div>
			</div>
		</div>
	</div>

	{{-- BODY --}}
	<div class="page-body">
		<div class="container-xl">
			@if ($errors->any())
				<div class="alert alert-danger mb-3">
					<strong>The title has already been taken !</strong>
				</div>
			@endif

			<form action="{{ route('movies.store') }}" method="POST" class="card" enctype="multipart/form-data">
				@csrf

				<div class="card-header">
					<h3 class="card-title">Movie Information</h3>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							@php
								$poster = old('poster_url');
							@endphp
							<div class="mb-3 text-center">
								<div class="mb-3">
									<img src="{{ $poster ?: 'https://via.placeholder.com/300x450?text=No+Poster' }}"
										 alt="Poster preview"
										 class="img-fluid rounded shadow-sm"
										 style="max-height: 320px; width: 100%; object-fit: cover;">
								</div>
								<label class="form-label">Poster URL</label>
								<input type="text" name="poster_url" class="form-control" placeholder="https://image.tmdb.org/..." value="{{ old('poster_url') }}">
								<small class="form-hint">Masukkan URL gambar poster. (Saat ini belum upload file.)</small>
							</div>
						</div>

						<div class="col-md-8">
							<div class="mb-3">
								<label class="form-label">Judul</label>
								<input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
							</div>

							<div class="mb-3">
								<label class="form-label">Genre</label>
								<input type="text" name="genre" class="form-control" placeholder="Contoh: Mystery, Drama, Horror" value="{{ old('genre') }}">
								<small class="form-hint">Pisahkan beberapa genre dengan koma.</small>
							</div>

							<div class="mb-3">
								<label class="form-label">Release Date</label>
								<input type="date" name="release_date" class="form-control" value="{{ old('release_date') }}">
							</div>

							<div class="mb-3">
								<label class="form-label">Overview</label>
								<textarea name="overview" rows="6" class="form-control" placeholder="Ringkasan cerita film...">{{ old('overview') }}</textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="card-footer text-end">
					<a href="{{ route('movies.index') }}" class="btn btn-link">Cancel</a>
					<button type="submit" class="btn btn-primary">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-1">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
							<path d="M12 5l0 14" />
							<path d="M5 12l14 0" />
						</svg>
						Create Movie
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection

