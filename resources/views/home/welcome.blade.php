@extends('layouts.home')
@section('content')     
<div class="container d-flex h-100 align-items-center">
    <div class="mx-auto text-center">
        <h1 class="mx-auto my-0 text-uppercase">Robot Galaxy</h1>
        <h2 class="text-white-50 mx-auto mt-2 mb-5">A free crowdsourcing robots and AIs catalog.
    @guest
			<span style="color:Pink;">Login</span> or <span style="color:Pink;">Register</span> to get <span style="color:Pink;"><b>FULL ACCESS</b></span> to the website, features, and resources.
        </h2>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        <a href="{{ route('register') }}" class="btn btn-warning">Register</a>
        <a href="{{ route('source') }}" class="btn btn-secondary">Continue as Guest</a>
    @else
    		<span style="color: yellow;">Welcome {{ Auth::user()->name }}</span>
    	</h2>    	
    	<a href="{{ route('source') }}" class="btn btn-success">Get Started</a>
    	@if(Auth::user()->privilege == 100)
    		<a href="{{ route('dashboard') }}" class="btn btn-primary">Admin Dashboard</a>
    	@endif
    @endguest
    </div>
</div> 
@endsection
 
