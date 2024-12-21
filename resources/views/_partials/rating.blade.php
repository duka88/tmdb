@props(['voteAverage'])

@php
    $rating = round($voteAverage, 1);
    $fullStars = floor($rating);
    $halfStars = ceil($rating - $fullStars);
    $emptyStars = 10 - ($fullStars + $halfStars); 
@endphp

<div class="rating">
    @for ($i = 0; $i < $fullStars; $i++)
        <i class="fa-solid fa-star"></i>
    @endfor

    @if ($halfStars > 0)
        <i class="fa-solid fa-star-half-stroke"></i>
    @endif

    @for ($i = 0; $i < $emptyStars; $i++)
        <i class="fa-regular fa-star"></i>
    @endfor
    <span class="rating__grade">({{ $rating }})</span>
</div>
