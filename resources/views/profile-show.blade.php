@extends('layouts.app')

@section('title', 'Profile - '. $profile['name'])

@section('content')
	@include('cards.profile')
	@include('cards.events', ['events' => $events])
@endsection

