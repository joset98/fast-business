@extends('layouts.app')
@section('title', 'Dashboard - fast business')

@section('content')
<!-- Page Heading -->
<div class="container">

@authadmin
    <div>gola</div>
@endauthadmin

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{route('dashboard')}}">Dashboard</a>
            </h2>
        </div>
    </header>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</div>

@endsection