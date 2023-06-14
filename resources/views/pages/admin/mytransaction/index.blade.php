@extends('layouts.parent')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">my-Transaction</h5>

                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name Account</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Total </th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($myTransaction as $row)
                            <tr>
                                <td scope="col">{{ $loop->iteration }}</td>
                                <td scope="col">{{ $row->user->name }}</td>
                                <td scope="col">{{ $row->name }}</td>
                                <td scope="col">{{ $row->email }}</td>
                                <td scope="col">{{ $row->phone }}</td>
                            
                                <td scope="col">{{$row->total_price }}</td>

                                <td scope="col">
                                    <a href="{{ route('dashboard.my-transaction.show', $row->id) }}" class="btn btn-info">
                                        <i class="bi bi-eye"></i>
                                        Show
                                    </a>

                                    <a href={{ route('dashboard.my-transaction.edit', $row->id) }} class="btn btn-warning">
                                        <i class="bi bi-pencil"></i>
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Data Transaction Kosong</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div>
    </div>
@endsection
