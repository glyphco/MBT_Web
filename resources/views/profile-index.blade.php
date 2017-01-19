@inject('request','\Illuminate\Http\Request')
@extends('layouts.app')

@section('title', 'Profiles')

@section('content')
	@include('cards.profiles', ['profiles' => $profiles])
@endsection

@has(create-profiles)

@endhas
