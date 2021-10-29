@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users</h1>
        <p class="mb-4">List all users</p>

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3 d-flex justify-content-between align-items-center" style="padding-right: 1rem;"
                role="alert">
                <div>{!! Session::get('success') !!}</div>
                <button type="button" class="btn btn-default" data-dismiss="alert" aria-label="Close">X
                </button>
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Registred Users</h6>
                <a href="{{ route('admin.users') }}" class="btn btn-primary">Tous</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div id="dataTable_filter" class="dataTables_filter">
                                    <form action="{{ route('admin.users') }}">
                                        <label>Search:<input type="search" class="form-control" placeholder="0558XXXXXX" name="phone"
                                                aria-controls="dataTable"></label>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid"
                                    aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                                aria-label="Name: activate to sort column ascending" style="width: 50px;">#</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending" style="width: 200px;">Nom Complet</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                                aria-label="Office: activate to sort column ascending" style="width: 80px;">Mobile</th>
                                            <th class="sorting sorting_desc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                                aria-label="Age: activate to sort column ascending" aria-sort="descending" style="width: 250px;">Adresse</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                                aria-label="Start date: activate to sort column ascending" style="width: 139px;">Date d'inscription</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                                aria-label="Start date: activate to sort column ascending" style="width: 139px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">#</th>
                                            <th rowspan="1" colspan="1">Nom Complet</th>
                                            <th rowspan="1" colspan="1">Mobile</th>
                                            <th rowspan="1" colspan="1">Adresse</th>
                                            <th rowspan="1" colspan="1">Date d'inscription</th>
                                            <th rowspan="1" colspan="1">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="">{{ $user->id }}</td>
                                                <td>{{ $user->fullName }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->created_at->format('d/m/Y') }} - {{ $user->created_at->diffForHumans() }}</td>
                                                <td>
                                                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-outline-primary">Edit</a>
                                                    <button data-toggle="modal" data-target="#deleteModal-{{ $user->id }}" type="button"
                                                        class="btn btn-outline-danger">Delete</button>
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
        </div>

        @foreach ($users as $user)
            <div class="modal fade" id="deleteModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this user?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Supprimer" below if you are ready to end delete this user.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                            <form action="{{ route('admin.user.delete', $user->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" href="">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-end">
            {{ $users->links() }}
        </div>

    </div>
@endsection
