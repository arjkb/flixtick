@extends('base')

@section('content')
<h1>{{ $watchlistItem->movie->title }}</h1>

<dl class="row mt-5">
    @isset($watchlistItem->marked_seen_at)
    <dt class="col-sm-3">Marked watched at</dt>
    <dd class="col-sm-9">{{ Carbon\Carbon::parse($watchlistItem->marked_seen_at)->diffForHumans() }}, on {{ $watchlistItem->marked_seen_at }} UTC</dd>
    @endisset

    <dt class="col-sm-3">Created at</dt>
    <dd class="col-sm-9">{{ $watchlistItem->created_at->diffForHumans() }}, on {{ $watchlistItem->created_at }} UTC</dd>

    <dt class="col-sm-3">Updated at</dt>
    <dd class="col-sm-9">{{ $watchlistItem->updated_at->diffForHumans() }}, on {{ $watchlistItem->updated_at }} UTC</dd>

    <dt class="col-sm-3"></dt>
    <dd class="col-sm-9">
        @if(isset($watchlistItem->marked_seen_at))
        <form action="" method="post">
            <!-- TODO: add form action -->
            <button type="submit" class="btn btm-sm btn-outline-warning">Mark <em>'{{ $watchlistItem->movie->title }}'</em> as unwatched</button>
        </form>
        @else
        <form action="{{ route('watchlist.mark-watched', ['id' => $watchlistItem->id]) }}" method="post">
            @csrf
            <button type="submit" class="btn btm-sm btn-outline-success">Mark <em>'{{ $watchlistItem->movie->title }}'</em> as watched</button>
        </form>
        @endif
    </dd>

    <dt class="col-sm-3"></dt>
    <dd class="col-sm-9">
        <form action="" method="post">
            <button type="submit" class="btn btm-sm btn-outline-danger">Remove <em>'{{ $watchlistItem->movie->title }}'</em> from watchlist</button>
        </form>
    </dd>
</dl>
@endsection