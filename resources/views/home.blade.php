@extends('layouts.app')
@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header text-center">
            <h5>CRUD Application</h5>
        </div>
        <div class="card-body">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
                    {{session()->get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                    {{session()->get('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="float-end mb-5">
                <a href="{{ route('add_new_student') }}" class="btn btn-dark btn-sm">Add New Student</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td style="width: 10%">
                            <img src="{{ asset('storage/'.$student->profile_image) }}" alt="" style="width: 50%">
                        </td>
                        <td>{{ $student->full_name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>{{ $student->address }}</td>
                        <td>
                            @if ($student->status == 'Active')
                                <span class="badge bg-success rounded-pill">Active</span>
                            @else
                            <span class="badge bg-danger rounded-pill">InActive</span>            
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('edit_student',['id'=>$student->id]) }}" class="text-dark p-3"><i class="fa-solid fa-pen-to-square"></i></a>
                            @if ($student->status == 'Active')
                                <a href="{{ route('inactive_student',['id'=>$student->id]) }}"><i class="fa-solid fa-toggle-on"></i></a>    
                            @else
                                <a href="{{ route('active_student',['id'=>$student->id]) }}"><i class="fa-solid fa-toggle-off"></i></a>            
                            @endif
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
            </table>
        </div>
    </div>        
@endsection