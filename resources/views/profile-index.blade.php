@extends('layouts.app')

@section('title', 'Profiles')

@section('content')
	@include('cards.profiles', ['profiles' => $profiles])
@endsection

