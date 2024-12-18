@extends('layouts.master')
@section('content')

    <h1>{{ $movieData['title'] }}</h1>
    <img src="https://image.tmdb.org/t/p/w500{{ $movieData['poster_path'] }}" alt="{{ $movieData['title'] }}">
    <p>{{ $movieData['overview'] }}</p>
    <p>{{ 'Rate:' . round($movieData['vote_average'], 2) }}</p>

    <h2>Comments</h2>
    <ul>
    </ul>

    <h3>Add a Comment</h3>
    <form action="{{ route('comments.store', $movieData['id']) }}" method="POST">
        @csrf
        <input type="hidden" name="movie_id" value="{{ $movieData['id'] }}">
        <input type="text" name="user_name" placeholder="Your Name" required>
        <input type="text" name="comment" placeholder="Comment" required>
        <input type="number" name="rating" min="1" max="5" placeholder="" required>
        <input type="submit" value="Submit">
    </form>

@endsection
