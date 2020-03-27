@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center" style="margin-top: 15rem; margin-bottom: 15rem;">
	<h1 class="mx-auto mb-5 text-uppercase">Your account has been banned!</h1>
	<a href="{{ route('contact') }}"><h1  class="mx-auto mb-5 text-uppercase">Contact Admin</h1></a>
</div>
@endsection

@section('footer')
@endsection