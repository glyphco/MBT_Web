@extends('layouts.app')

@section('title', 'Venues')

@section('content')
	@include('venue._venuelist', ['venues' => $venues])
@endsection
