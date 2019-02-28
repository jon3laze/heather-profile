@extends('layouts.app')

@section('page-name', "{$profileOwner->name}")

@section('content')
<div class="max-w-md w-full lg:flex mx-auto">
    @foreach($activities as $activity)
        @if(view()->exists("profiles.activities.{$activity->type}"))
            @include("profiles.activities.{$activity->type}")
        @endif
    @endforeach
</div>
@endsection
