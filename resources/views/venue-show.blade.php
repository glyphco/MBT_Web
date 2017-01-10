@extends('layouts.app')

@section('title', 'Venue - '. $venue['name'])

@section('content')
	@include('venue-card')
@endsection

