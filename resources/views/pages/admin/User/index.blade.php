@extends('layouts.parent')

@section('content')
    <div class="container">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {!! \Session::get('success') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            {!! \Session::get('error') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                   List User
                </h5>

                <table class="table table-striped table-bordered datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $row)
                        <tr>
                            <td scope="col">{{$loop->iteration}}</td>
                            <td scope="col">{{$row->name}}</td>
                            <td scope="col">
                                @if ($row->roles =='ADMIN')
                                <span class="badge bg-warning">{{$row->roles}}</span>
                                @else
                                <span class="badge bg-secondary">{{$row->roles}}</span>
                                @endif</td>

                            <td scope="col">
                                <a href="{{route('dashboard.user.edit', $row->id)}}" class="btn btn-warnig btn-sm">Edit</a>
                                <form action="{{route('dashboard.user.destroy', $row->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger bnt-sm" onclick="return confirm('Are you Sure')">
                                    Delete
                                </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
