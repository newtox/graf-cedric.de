@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-8 p-4 bg-gray-800 shadow-md rounded-lg max-w-lg">
        <h1 class="text-2xl font-bold text-white text-center mb-4">About Me</h1>
        <img src="{{ asset('storage/images/Profile.png') }}" alt="" class="w-full h-auto rounded-lg shadow-lg mb-4 md:max-w-md lg:max-w-lg"> <!-- Full width on mobile, limited size on larger screens -->
        <div class="text-gray-300">
            <p class="mb-4">
                Hi, I'm Graf Cedric and I have been active as a beta tester for various companies and games since 2009.
                <br>
                I've been playing video games since I was very young (~2/3 years old) and I'm always fascinated by the great and different games I get to experience.
                <br>
                Over the years I have had the honor of working with great game developers, publishers and of course gamers.
                <br>
                I hope that I will continue to work with the great people and meet new great people in the future!
            </p>
        </div>
    </div>
@endsection
