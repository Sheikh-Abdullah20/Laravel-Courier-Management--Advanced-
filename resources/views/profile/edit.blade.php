@extends('layouts.app')

@section('title')
Profile
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/profile-Button.css') }}">
@endsection

@section('content')
<x-alert/>
<section class="content-main">
    <div class="content-header">
        <div class="row">
            <h2 class="content-title">Profile setting</h2>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
    </div>


    <div class="row my-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
