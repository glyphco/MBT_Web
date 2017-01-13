@extends('layouts.mbt')

@section('title', 'Home')

@section('content')
	@include('cards.events', ['events' => $events])
@endsection



