<section class="comments">
    <div class="comments__head">
        <h2 class="main-title">Comments</h2>
        <button id="addCommentBtn" class="main-btn">add comment</button>
    </div>

    <div id="addComment" class="comments__add d-none">
        <div class="comments__add-wrap">
            <h3 class="comments__title">Add a Comment</h3>
            <form id="commentsForm" class="comments__form">
                <input type="hidden" name="movie_id" value="{{ $movieData['id'] }}">


                <div id="inputRating" class="comments__input-wrap">
                    <div class="comments__rating">
                        @for ($i = 10; $i >= 1; $i--)
                            <label>
                                <input type="radio" name="rating" class="jsRadio" value="{{ $i }}" required>
                                <i class="fa fa-star"></i>
                            </label>
                        @endfor
                    </div>
                    <span class="comments__input-error comments__input-error--center  jsError"></span>
                </div>
                <div id="inputName" class="comments__input-wrap">
                    <input type="text" class="comments__input jsInput" name="user_name" placeholder="Your Name" required>
                    <span class="comments__input-error jsError"></span>
                </div>
                <div id="inputComment" class="comments__input-wrap">
                    <textarea class="comments__input comments__input--textarea jsInput" name="comment" placeholder="Comment"
                        required></textarea>
                    <span class="comments__input-error jsError"></span>
                </div>

                <button id="submitComment" type="submit" class="main-btn">submit  </button>
            </form>
        </div>


    </div>




    <div id="commentList" class="commnets__list">
        @foreach ($comments['results'] as $comment)
            <article class="commnts__box">
                <div class="commnts__info">
                    <div class="comments__author">
                        <figure class="comments__author-img-wrap">
                            <img class="comments__author-img" loading="lazy" src="{{ $comment['author_details']['avatar_path']
            ? 'https://image.tmdb.org/t/p/w500' . $comment['author_details']['avatar_path']
            : asset('images/user.webp') }}" alt="user image">
                        </figure>

                        <p class="comments__author-name"> {{$comment['author']}}</p>
                    </div>
                    @include('_partials.rating', ['voteAverage' => $comment['author_details']['rating']])    
                </div>

                <p class="comments__text">
                    {!! $comment['content'] !!}
                </p>
            </article>

        @endforeach
    </div>
</section>