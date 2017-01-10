@extends('layouts.app')

@section('title', 'Venue - '. $venue['name'])

@section('content')
	@include('cards.venue')
	@include('cards.events', ['events' => $events])
@endsection

