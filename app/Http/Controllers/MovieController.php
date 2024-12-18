<?php

namespace App\Http\Controllers;

use App\Services\TMDbService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    protected TMDbService $tmdbService;

    public function __construct(TMDbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function index(): Factory|View|Application|RedirectResponse
    {
        $page = request()->input('page', 1);

        try {
            $response = $this->tmdbService->getPopularMovies($page);
        } catch (\Exception $e) {
            Log::error('Error while getting PopularMovies: ' . $e);

            return view('errors.500');
        }

        return view('movies.index', compact('response'));
    }

    public function show(int $id): Factory|View|Application|RedirectResponse
    {
        try {
            $movieData = $this->tmdbService->getMovieDetails($id);
        } catch (\Exception $e) {
            Log::error('Error while getting Popular Movie details: ' . $e);
            request()->session()->flash('message', 'Error getting Popular Movie details!');

            return redirect()->route('movies.index');
        }

        return view('movies.show', compact('movieData'));
    }
}
