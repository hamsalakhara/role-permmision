@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Student</h2>
            </div>
            <div class="pull-right mb-3">
                <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Username:</strong>
                <input type="text" name="username" value="{{ $student->username }}" class="form-control" placeholder="Username">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>First Name:</strong>
                <input type="text" name="first_name" value="{{ $student->first_name }}" class="form-control" placeholder="First Name">
            </div>
        </div>
        <!-- Add other fields for updating -->
        <!-- Example: Last Name -->
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Last Name:</strong>
                <input type="text" name="last_name" value="{{ $student->last_name }}" class="form-control" placeholder="Last Name">
            </div>
        </div>
        <!-- Example: Email -->
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email_id" value="{{ $student->email_id }}" class="form-control" placeholder="Email">
            </div>
        </div>
        <!-- Example: Date of Birth with Date Picker -->
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Date of Birth:</strong>
                <input type="date" name="date_of_birth" value="{{ $student->date_of_birth }}" class="form-control" placeholder="Date of Birth">
            </div>
        </div>
        <!-- Add other fields -->
        <!-- Example: Standard -->
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Standard:</strong>
                <input type="text" name="standard" value="{{ $student->standard }}" class="form-control" placeholder="Standard">
            </div>
        </div>
        <!-- Example: Gender -->
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Gender:</strong>
                <select name="gender" class="form-control">
                    <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $student->gender == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
        </div>
        <!-- Example: Entry Year -->
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Entry Year:</strong>
                <input type="text" name="entry_year" value="{{ $student->entry_year }}" class="form-control" placeholder="Entry Year">
            </div>
        </div>
        <div class="col-xs-12 col-sm-10 col-md-10">
            <div class="form-group">
                <strong>Profile Image:</strong>
                <input type="file" name="profile" class="form-control" accept="image/*">
                @if ($student->profile)
                <img src="{{ asset('storage/' . $student->profile) }}" alt="Profile Image" style="max-width: 100px;">
                @else
                <p>No Image</p>
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>


@endsection