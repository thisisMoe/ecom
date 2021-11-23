@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {!! $category->name !!}
        </h1>
        <a class="btn btn-primary" href="{{ route('admin.mainCategory', ['id' => $mainCategory->id]) }}">{!! $mainCategory->name !!}</a>
    </div>

    <!-- Content Row -->
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3 d-flex justify-content-between align-items-center" style="padding-right: 1rem;"
            role="alert">
            <div>{!! Session::get('success') !!}</div>
            <button type="button" class="btn btn-default" data-dismiss="alert" aria-label="Close">X
            </button>
        </div>
    @endif
    <div class="row">
        @foreach ($subCategories as $cat)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <div>
                            <h6 class="m-0 mb-2 font-weight-bold text-primary">
                                <a href="{{ route('admin.mainCategory', ['id' => $cat->id]) }}">{!! $cat->name !!}</a>
                            </h6>
                            <h6>{{ $cat->arabicName }}</h6>
                        </div>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Actions:</div>
                                <button data-toggle="modal" data-target="#arabicNameModal-{{ $cat->id }}" class="dropdown-item" type="button">Arabic
                                    Name</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        {{ $cat->products->count() }}
                    </div>
                    <div class="card-footer">
                        {{ $cat->created_at->diffForHumans() }}
                    </div>
                </div>
                {{-- delete modal --}}
                <div class="modal fade" id="arabicNameModal-{{ $cat->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Change arabic name</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.subCatArabicNaming', ['id' => $cat->id]) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <input type="text" class="form-control" name="arabicName" value="{{ $cat->arabicName }}">
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                    @method('post')
                                    <button type="submit" class="btn btn-success" href="">Valider</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
