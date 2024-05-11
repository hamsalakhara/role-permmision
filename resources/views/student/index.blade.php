@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Student</h2>
            </div>
            <div class="pull-right mb-3">
                @can('student-create')
                <a class="btn btn-success" href="{{ route('students.create') }}"> Add New Student</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
             <th>Profile</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Date of Birth</th>
            <th>Standard</th>
            <th>Gender</th>
            <th>Entry Year</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($students as $student)
        <tr>
            <td>{{ ++$i }}</td>
            <td>
                @if ($student->profile)
                <img src="{{ asset('storage/' . $student->profile) }}" alt="Profile Image" style="max-width: 50px;">
                @else
                <p>No Image</p>
                @endif
            </td>
            <td>{{ $student->username }}</td>
            <td>{{ $student->first_name }}</td>
            <td>{{ $student->last_name }}</td>
            <td>{{ $student->email_id }}</td>
            <td>{{ $student->date_of_birth }}</td>
            <td>{{ $student->standard }}</td>
            <td>{{ $student->gender }}</td>
            <td>{{ $student->entry_year }}</td>
            <td>
                <form action="{{ route('students.destroy',$student->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('students.show',$student->id) }}">Show</a>
                    @can('student-edit')
                    <a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('student-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach

    </table>

    {!! $students->links() !!}


@endsection