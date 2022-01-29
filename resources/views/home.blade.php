@extends('base')

@section('content')
@isset($moviesInWatchlist)
<ol>
    @foreach($moviesInWatchlist as $watchlistitem)
    <li>{{ $watchlistitem->movie->title }}</li>
    @endforeach
</ol>
@endisset
@endsection