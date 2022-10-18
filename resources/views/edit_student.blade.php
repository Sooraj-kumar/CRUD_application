@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-sm-6">
        <a href="/"><i class="fa-solid fa-house"></i> Home</a>
        <h4 class="text-center mb-5">CRUD Application</h4>

        <form action="{{ route('edit_student_record',['id'=>$student->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf    
            <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Steve Jobs" id="validationCustom01" required name="full_name" tabindex="1" value="{{ $student->full_name }}">
                <div class="invalid-feedback">
                    Please Input Full Name.
                </div>
                <label for="floatingInput">Full Name</label>
                @error('full_name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" placeholder="name@example.com" id="validationCustom02" required name="email" tabindex="2" value="{{ $student->email }}">
                <div class="invalid-feedback">
                    Please Input Email Address.
                </div>
                <label for="floatingInput">Email address</label>
                @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="phone" class="form-control" placeholder="Phone" id="validationCustom03" required name="phone" tabindex="3" value="{{ $student->phone }}">
                <div class="invalid-feedback">
                    Please Input Phone.
                </div>
                <label for="floatingInput">Phone Number</label>
                @error('phone')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Address" id="validationCustom04" required name="address" tabindex="4" value="{{ $student->address }}">
                <div class="invalid-feedback">
                    Please Input Address.
                </div>
                <label for="floatingInput">Address</label>
                @error('address')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="file" class="form-control" name="profile_image" tabindex="5">
                <div class="invalid-feedback">
                    Please Upload Profile Image.
                </div>
                @error('profile_image')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <img src="{{ asset('storage/'.$student->profile_image) }}" alt="" style="width: 20%">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-dark" tabindex="6">Update</button>
            </div>
        </form>   
    </div>
</div> 
@endsection
