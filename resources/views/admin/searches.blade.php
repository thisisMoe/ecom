@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Dashboard
        </h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>
            Generate Report</a>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3 d-flex justify-content-between align-items-center" style="padding-right: 1rem;"
            role="alert">
            <div>{!! Session::get('success') !!}</div>
            <button type="button" class="btn btn-default" data-dismiss="alert" aria-label="Close">X
            </button>
        </div>
    @endif
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        @foreach ($products as $product)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto mb-3 text-center">
                                <a href="{{ $product->link }}" target="_blank">
                                    <img style="max-width: 100%" src="{{ $product->image }}" alt="Product image">
                                </a>
                            </div>
                            <div class="col-auto mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Hits
                                </div>
                                <div class="h5 mb-2 font-weight-bold text-gray-800">{{ $product->hits }}</div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Title
                                </div>
                                <div class="h5 mb-2 font-weight-bold text-gray-800">{!! $product->title !!}</div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Prix
                                </div>
                                <div class="h5 mb-2 font-weight-bold text-gray-800">
                                    @if (!$product->equalPrice)
                                        {{ $product->minPrice }}DA - {{ $product->maxPrice }}DA
                                    @else
                                        {{ $product->equalPrice }}DA
                                    @endif
                                </div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Main Category
                                </div>
                                <div class="h5 mb-2 font-weight-bold text-gray-800">
                                    {!!$product->mainCategory->name ?? ''!!}
                                </div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Category
                                </div>
                                <div class="h5 mb-2 font-weight-bold text-gray-800">
                                    {!!$product->category->name ?? '' !!}
                                </div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Sub Category
                                </div>
                                <div class="h5 mb-2 font-weight-bold text-gray-800">
                                    {!!$product->subCategory->name ?? '' !!}
                                </div>
                                <div class="text-xs font-weight-bold text-center text-dark text-uppercase mb-1">
                                    {{ $product->created_at->diffForHumans() }}
                                </div>
                                <div class="text-center">
                                    <a href="#" data-toggle="modal" data-target="#deleteModal-{{ $product->id }}" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                                <!-- delete Modal-->
                                <div class="modal fade" id="deleteModal-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">I strongly advice
                                                against it.</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                                <form action="{{ route('admin.searches.delete', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger" href="">Supprimer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end">
        {{ $products->links() }}
    </div>
@endsection
