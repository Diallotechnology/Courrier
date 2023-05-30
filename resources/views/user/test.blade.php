@extends('layouts.app')
@section('content')
@if (!$user->hasBeenSigned())
<form action="{{ $user->getSignatureRoute() }}" method="POST">
    @csrf
    <div style="text-align: center">
        <x-creagia-signature-pad />
    </div>
</form>
<script src="{{ asset('vendor/sign-pad/sign-pad.min.js') }}"></script>
@endif
@endsection