@extends('layouts.master')
@section('content')

<div class="movies__head">
    <h2 class="main-title">Popular Movies</h2>

    <div class="movies__select">
        <a href=""  class="main-btn {{ Request::query('top_rated') ? 'main-btn--white' : '' }}">Popular Movies</a>
      
        <a class="main-btn {{ Request::query('top_rated') ? '' : 'main-btn--white' }}" href="">Top Rated</a>
    </div>

</div>

<section class="movies">
    @foreach($response['results'] as $movie)
        <article class="movies__card">

            <figure class="movies__img-wrap">
                <img class="movies__img" loading="lazy" src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                    alt="{{ $movie['title'] }}">
                <div class="movies__overlay">
                    <a class="main-btn" href="{{ route('movies.show', $movie['id']) }}">
                        See More
                    </a>
                </div>

            </figure>

            @include('_partials.rating', ['voteAverage' => $movie['vote_average']])

            <h3 class="movies__title">{{ $movie['title'] }}</h3>

        </article>
    @endforeach
    </ul>

    @endsection