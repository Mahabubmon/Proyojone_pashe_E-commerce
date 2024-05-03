@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Add New Class')}}
                <a  href="{{route('class')}}" class="btn btn-sm btn-primary" style="float:right;">All Class</a>
                </div>
                <div class="card-body">
                    @if(session()->has('success'))
                    <strong class="text-success">{{session()->get('success')}}</strong>

                    @endif
                    <form action="{{route('class.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Class Name</label>
                            <input type="text" class="form-control @error('class_name') is-invalid @enderror" id="class_name" name="class_name" placeholder="Class Name" value="{{old('class_name')}}">
                        @error('class_name')
                        <span class="invalid-feedback" roll="alert">
                            <strong>{{$message}}</strong>
                        </span>

                        @enderror
                        </div>
                        <input type="hidden" name="_method" value="PUT">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
