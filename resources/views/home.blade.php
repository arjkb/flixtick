@extends('base')

@section('content')
<div>
    <dl class="row mt-5">
        <dt class="col-sm-3">Unseen count</dt>
        <dd class="col-sm-9">{{ count($unwatchedMovies) }}</dd>

        <dt class="col-sm-3">Seen count</dt>
        <dd class="col-sm-9">{{ count($watchedMovies) }}</dd>

        <dt class="col-sm-3">Total</dt>
        <dd class="col-sm-9">{{ count($unwatchedMovies) + count($watchedMovies) }}</dd>
    </dl>
</div>

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

@if(isset($unwatchedMovies) || isset($watchedMovies))
<table class="table table-hover mt-3">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col" class="d-none d-md-table-cell">Added On</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($unwatchedMovies as $watchlistitem)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>
                <a href="{{ route('watchlist.show', ['id' => $watchlistitem->id]) }}">{{ $watchlistitem->movie->title }}</a>
            </td>
            <td class="d-none d-md-table-cell">{{ $watchlistitem->movie->created_at?->diffForHumans() }}</td>
            <td>
                <form action="{{ route('watchlist.mark-watched', ['id' => $watchlistitem->id]) }}" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                    @csrf
                    <div class="col-12">
                        <button type="submit" class="btn btn-sm btn-outline-primary">Mark as watched</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach

        @foreach($watchedMovies as $watchlistitem)
        <tr class="text-muted">
            <th scope="row">{{ $loop->iteration + count($unwatchedMovies) }}</th>
            <td>
                <a class="link-secondary" href="{{ route('watchlist.show', ['id' => $watchlistitem->id]) }}">{{ $watchlistitem->movie->title }}</a>
                <br><span class="text-muted"><small>Marked seen {{ $watchlistitem->marked_seen_at->diffForHumans() }}</small></span>
            </td>
            <td class="d-none d-md-table-cell">{{ $watchlistitem->movie->created_at?->diffForHumans() }}</td>
            <td>
                <form action="{{ route('watchlist.mark-unwatched', ['id' => $watchlistitem->id]) }}" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                    @csrf
                    <div class="col-12">
                        <button type="submit" class="btn btn-sm btn-outline-warning">Mark as unwatched</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection