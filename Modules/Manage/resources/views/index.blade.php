@extends('manage::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('manage.name') !!}</p>
@endsection
