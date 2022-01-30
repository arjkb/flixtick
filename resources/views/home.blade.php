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
        @foreach($moviesInWatchlist as $watchlistitem)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>
                {{ $watchlistitem->movie->title }}
                @isset($watchlistitem->marked_seen_at)
                <br><span class="text-muted"><small>Marked seen at {{ $watchlistitem->marked_seen_at }}</small></span>
                @endisset
            </td>
            <td class="d-none d-md-table-cell">{{ $watchlistitem->movie->created_at?->diffForHumans() }}</td>
            <td>
                <form action="{{ route('mark-watched', ['id' => $watchlistitem->id]) }}" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-primary" @isset($watchlistitem->marked_seen_at) disabled @endisset>Mark as watched</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endisset
@endsection