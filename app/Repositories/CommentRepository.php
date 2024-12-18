<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository
{
    public function getCommentsByMovieId(int $movieId): Collection
    {
        return Comment::where('movie_id', $movieId)->get();
    }

    public function storeComment(array $commentData): Comment
    {
        $comment = new Comment();
        $comment->movie_id = $commentData['movie_id'];
        $comment->user_name = $commentData['user_name'];
        $comment->rating  = $commentData['rating'];
        $comment->comment = $commentData['comment'];
        $comment->save();

        return $comment;
    }
}
