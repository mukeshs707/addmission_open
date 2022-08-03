@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 pt-1">
                            <h4>{{ __('Classes') }}</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">Class</th>
                                <th scope="col">Description</th>
                                <th class="text-center" scope="col">Seats</th>
                                <th class="text-center" scope="col">Available Seats</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($classes->count() > 0)
                            @foreach($classes as $cls)
                            <tr>
                                <th scope="row">{{$cls->id}}</th>
                                <th>{{$cls->name}}</th>
                                <th>{{$cls->desription}}</th>
                                <th class="text-center">{{$cls->seats}}</th>
                                <th class="text-center">{{$cls->seats-$cls->enroll_count}}</th>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <th colspan="4">No Record Found</th>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
