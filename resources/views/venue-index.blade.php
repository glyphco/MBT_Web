@extends('layouts.app')

@section('title', 'Venues')

@section('content')
	@include('cards.venues', ['venues' => $venues])
@endsection

