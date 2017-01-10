@extends('layouts.app')

@section('title', 'Home')

@section('content')
	@include('showlisting', ['events' => $events])
@endsection



