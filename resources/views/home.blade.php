@extends('base')

@section('content')
<form class="row row-cols-lg-auto g-3 align-items-center mt-3" action="{{ url('watchlist') }}" method="post">
    @csrf
    <div class="col-12">
        <label class="visually-hidden" for="title">Title</label>
        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" placeholder="Movie title" aria-describedby="validationServerTitleFeedback">
        @error('title')
        <div id="validationServerTitleFeedback" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- TODO: add the year field -->

    <div class="col-12">
        <button type="submit" class="btn btn-sm btn-outline-primary">Add movie to watchlist</button>
    </div>
</form>

@isset($moviesInWatchlist)
<ol>
    @foreach($moviesInWatchlist as $watchlistitem)
    <li>{{ $watchlistitem->movie->title }}</li>
    @endforeach
</ol>
@endisset
@endsection