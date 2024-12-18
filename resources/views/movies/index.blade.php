@extends('layouts.master')
@section('content')

    <h1>Popular Movies</h1>
    <ul>
        @foreach($response['results'] as $movie)
            <li>
                <a href="{{ route('movies.show', $movie['id']) }}">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}">
                </a>
                <h3>{{ $movie['title'] }}</h3>
                <h5>Rate {{ round($movie['vote_average'], 2) }}</h5>
            </li>
        @endforeach
    </ul>

@endsection
