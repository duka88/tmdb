<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(StoreCommentRequest $request)
    {
        try {
            $this->commentRepository->storeComment($request->validated());
        } catch (\Exception $e) {
            Log::error('Error while storing comments for a movie: ' . $e->getMessage());
            request()->session()->flash('message', 'Error while storing comments for a movie!');

            return redirect()->route('movies.show', ['id' => $request->movie_id]);
        }

        request()->session()->flash('message', 'Successfully stored comment!');

        return redirect()->back();
    }

    public function getCommentsForMovie(int $movieId)
    {
        try {
            $comments = $this->commentRepository->getCommentsByMovieId($movieId);
        } catch (\Exception $e) {
            Log::error('Error while getting comments for a movie: ' . $e);

            return response()->json(['error' => 'Error while getting comments for a movie'], 500);
        }

        return response()->json($comments);
    }
}
