@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{ __('Classes')}}
            <a href="{{route('create.class')}}" class="btn btn-sm btn-primary" style="float:right;">Add Class</a>            
            </div>

                <div class="card-body">              
                    <table class="table">
                        <thead style="text-align: center;">
                            <tr>
                                <th>ID</th>
                                <th>Class Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;"> <!-- Added inline style -->
                            @foreach($class as $key => $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->class_name }}</td>
                                <td>
                                    <a href="{{route('class.edit',$row->id)}}" class="btn btn-info">Edit</a>
                                    <a href="{{route('class.delete',$row->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
