<?php

namespace App\Services;

use GuzzleHttp\Client;

use Illuminate\Support\Facades\Http;

class TMDbService
{

    protected Client $client;
    protected string $apiKey;
    protected string $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('TMDB_API_KEY');
        $this->baseUrl = env('TMDB_API_BASE_URL');
    }

    public function getPopularMovies(int $page)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get("{$this->baseUrl}/movie/popular", [
                    'page' => $page,
                ]);

        return $response->json();
    }

    public function getMovieDetails($id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get("{$this->baseUrl}/movie/{$id}");

        return $response->json();
    }

    public function getComments($id, $page = 1)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get("{$this->baseUrl}/movie/{$id}/reviews", [
                    [
                        'page' => $page,
                    ]
                ]);

        return $response->json();
    }
}
