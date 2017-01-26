@extends('layouts.app')

@section('title', 'Venue - '. $venue['name'])

@section('content')
	@include('venue._venuedetails')
	@include('cards.events', ['events' => $events])
@endsection
