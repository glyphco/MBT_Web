@extends('layouts.mbt')

@section('title', 'Home')

@section('content')
<style>
.mbt-events img.mbt-image-lg{
    z-index: 0;
    width: 100%;
    margin-bottom: 10px;
}
</style>

<div>
    <div class="mbt-events">
        <img align="left" class="mbt-image-lg" src="http://lorempixel.com/850/280/nightlife" alt="venue image example"/>
    </div>
</div>
<div style="clear: both;"></div>
	@include('cards.events', ['events' => $events])
@endsection
