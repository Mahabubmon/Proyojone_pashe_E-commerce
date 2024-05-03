@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{ __('Dashboard')}}
            <a href="{{route('class')}}" class="btn btn-sm btn-primary" style="float:right;">All Class</a>
            <a href="{{route('students.index')}}" class="btn btn-sm btn-danger" style="float:right;">All Student</a>
            
            </div>

                <div class="card-body">              
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
