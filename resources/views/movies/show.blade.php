@extends('layouts.master')
@section('content')


<section class="movie">
    <figure class="movie__img-wrap">
        <img class="movie__img" src="https://image.tmdb.org/t/p/w500{{ $movieData['poster_path'] }}"
            alt="{{ $movieData['title'] }}">
    </figure>
    <div class="movie__description">
        <h2 class="main-title">{{ $movieData['title'] }}</h2>
        <p class="movie__text">{{ $movieData['overview'] }}</p>
        @include('_partials.rating', ['voteAverage' => $movieData['vote_average']])      
    </div>

</section>
@include('_partials.comments')
@endsection