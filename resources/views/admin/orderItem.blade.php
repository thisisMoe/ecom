@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Order item details
        </h1>
        <a href="{{ route('admin.order.view', ['id' => $orderItem->shopping_session_id]) }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Commande #{{ $orderItem->shopping_session_id }}</a>
    </div>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3 d-flex justify-content-between align-items-center" style="padding-right: 1rem;" role="alert">
            <div>{!! Session::get('success') !!}</div>
            <button type="button" class="btn btn-default" data-dismiss="alert" aria-label="Close">X
            </button>
        </div>
    @endif
    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header">
                    <a href="{{ $orderItem->uri }}" target="_blank" class="text-primary font-weight-bold">
                        #{{ $orderItem->id }} - {!! html_entity_decode($orderItem->title) !!}
                    </a>
                </div>
                <div class="card-body text-dark">
                    <div class="">
                        <h5 class="mb-3">Total: {{ $orderItem->totalSum + $orderItem->shippingCost }} DA</h5>
                        @foreach (json_decode($orderItem->selectedProps, true) as $prop)
                            <p class="mb-1">{{ $prop['name'] }}: <span class="font-weight-bold">{{ $prop['selected'] }}</span></p>
                        @endforeach
                    </div>

                    <hr class="my-4">

                    <form role="form" action="{{ route('admin.orderItem.update', $orderItem->id) }}" method="POST">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label>Total (Produit + Commision):</label>
                            <input name="totalSum" type="number" class="form-control @error('totalSum') is-invalid @enderror" value="{{ $orderItem->totalSum }}">
                            @error('totalSum')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Commission: </label>
                            <input name="fee" type="number" class="form-control @error('fee') is-invalid @enderror" value="{{ $orderItem->fee }}">
                            @error('fee')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>USD Price ($):</label>
                            <input name="usdP" type="number" class="form-control @error('usdP') is-invalid @enderror" value="{{ $orderItem->usdP }}">
                            @error('usdP')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>
                        <h4>Livraison</h4>
                        <div class="form-group">
                            <label>Frais (DA):</label>
                            <input name="shippingCost" type="number" value="{{ $orderItem->shippingCost }}"
                                class="form-control @error('shippingCost') is-invalid @enderror">
                            @error('shippingCost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Shipping Time (Jours):</label>
                            <input name="shippingTime" value="{{ $orderItem->shippingTime }}" class="form-control @error('shippingTime') is-invalid @enderror">
                            @error('shippingTime')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
