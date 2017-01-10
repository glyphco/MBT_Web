@extends('layouts.app')

@section('title', 'Profile - {{$profile['name']}}')

@section('content')
	@include('profile-card')
@endsection

