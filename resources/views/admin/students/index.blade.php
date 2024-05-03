@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{ __(' All Students')}}
            <a href="{{route('students.create')}}" class="btn btn-sm btn-primary" style="float:right;">Add Student</a>            
            </div>

                <div class="card-body">              
                    <table class="table">
                        <thead style="text-align: center;">
                            <tr>
                                <th>SL</th>
                                <th>Roll</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Class Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;"> <!-- Added inline style -->
                            @foreach($class as $key => $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->roll }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{ $row->class_name }}</td>
                                <td>
                                    <a href="{{route('students.edit',$row->id)}}" class="btn btn-info">Edit</a>

                                    <form action="{{route('students.destroy',$row->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
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
