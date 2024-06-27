@extends('layout.layout')
@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('shared.left-side-bar')
            </div>
            <div class="col-6">
                @include('shared.success-message')
                <div class="mt-3">
                    @include('shared.user-card')
                    <hr>
                </div>
            </div>
            <div class="col-3">
                @include('shared.search')
                @include('shared.follow-box')
            </div>
        </div>
    </div>
    </div>
@endsection
