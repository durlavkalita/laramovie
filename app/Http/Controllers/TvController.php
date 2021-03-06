<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $key = env('TMDB_KEY');
        $popularTv = Http::
            get('https://api.themoviedb.org/3/tv/popular?api_key='.$key)
            ->json()['results'];
        
        $topRatedTv = Http::
            get('https://api.themoviedb.org/3/tv/top_rated?api_key='.$key)
            ->json()['results'];

        $genres = Http::
            get('https://api.themoviedb.org/3/genre/tv/list?api_key='.$key)
            ->json()['genres'];

        // return view('index', compact('popularMovies', 'genres', 'nowPlayingMovies'));
        $viewModel = new TvViewModel(
            $popularTv,
            $topRatedTv,
            $genres
        );

        return view('tv.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $key = env('TMDB_KEY');
        $tvshow = Http::
            get('https://api.themoviedb.org/3/tv/'.$id.'?api_key='.$key.'&append_to_response=credits,videos,images')
            ->json();

        $viewModel = new TvShowViewModel(
            $tvshow
        );

        return view('tv.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
