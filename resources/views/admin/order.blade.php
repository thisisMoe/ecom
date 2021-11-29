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
        <div class="col">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseProfile" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
                    aria-controls="collapseProfile">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $order->user->fullName }} | {{ $order->user->phone }}</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseProfile" style="">
                    <div class="card-body">
                        <div class="d-md-flex flex-wrap justify-content-between">
                            <div>
                                <p>Adresse: {{ $order->user->fullName }}</p>
                                <p>Mobile: <a href="tel:{{ $order->user->phone }}">{{ $order->user->phone }}</a></p>
                                <p>Adresse: {{ $order->user->address }}</p>
                            </div>
                            <div class="text-center">
                                <img style="max-width: 100%; height: 160px; box-shadow: 0px 3px 15px -2px" src="{{ Storage::url($order->proofImage) }}"
                                    alt="Preuve d'achat">
                                <form class="mt-3 text-center" action="{{ route('admin.orders.confirmed', $order->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <input type="file" name="proof_image">
                                    <button type="submit" class="btn btn-info d-block mt-3">Envoyer Image</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4 p-3">
                <h5 class="font-weight-bold">Total: {{ $order->total + $order->totalShipping }} DA</h5>
                <h5 class="font-weight-bold">Revenue: + <span class="text-success">{{ $order->totalFee }} </span>DA</h5>
                <h5 class="font-weight-bold">Tracking: {{ $order->trackingNumber }} </h5>
                <form action="{{ route('admin.orders.update.tracking', $order->id) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="d-flex" style="gap: 1rem">
                        <input type="text" placeholder="Tracking" value="{{ $order->trackingNumber }}" name="trackingNumber" class="form-control">
                        <button type="submit" class="btn btn-info">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row align-items-center">
        @foreach ($order->orderItems as $orderItem)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow mb-4 p-2">
                    <a href="{{ $orderItem->uri }}" class="font-weight-bold text-primary text-uppercase mb-1">
                        {!! html_entity_decode(Str::limit($orderItem->title, 100, '...')) !!}
                    </a>
                    <div class="text-xs text-tertiary text-uppercase">
                        @foreach (json_decode($orderItem->selectedProps, true) as $prop)
                            <p class="mb-1 font-small">{!! $prop['name'] !!}: <span class="font-weight-bold">{!! $prop['selected'] !!}</span></p>
                        @endforeach
                    </div>
                    <div class="text-xs font-weight-bold text-tertiary text-uppercase">
                        total:
                    </div>
                    <div class="font-weight-bold text-tertiary text-uppercase mb-1">
                        {{ $orderItem->totalSum }} DA
                    </div>

                    <div class="text-xs font-weight-bold text-tertiary text-uppercase">
                        Commision:
                    </div>
                    <div class="font-weight-bold text-success text-uppercase mb-1">
                        {{ $orderItem->fee }} DA
                    </div>

                    <div class="text-xs font-weight-bold text-tertiary text-uppercase">
                        Prix Dollar:
                    </div>
                    <div class="font-weight-bold text-uppercase mb-1">
                        ${{ $orderItem->usdP }}
                    </div>

                    <div class="text-xs font-weight-bold text-tertiary text-uppercase">
                        Prix de produit:
                    </div>
                    <div class="font-weight-bold text-uppercase mb-1">
                        {{ $orderItem->totalSum - $orderItem->fee }} DA
                    </div>

                    <div class="text-xs font-weight-bold text-tertiary text-uppercase">
                        Shipping Cost:
                    </div>

                    @if ($orderItem->shippingCost == 0)
                        <form action="{{ route('admin.orderItems.update.shippingCost', $orderItem->id) }}" method="POST">
                        @csrf
                        @method('patch')
                            <div class="input-group mb-3 mt-1">
                                <input type="text" name="shippingCost" class="form-control" style="max-width: 100px" value="{{ $orderItem->shippingCost }}" aria-label="Shipping costs"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-success font-weight-bold" type="submit"><span class="fas fa-check"></span></button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="font-weight-bold text-uppercase">
                            {{ $orderItem->shippingCost }} DA
                        </div>
                    @endif

                    <div class="mt-3 font-weight-bold text-tertiary text-uppercase">
                        Somme (Total + Livraison):
                    </div>
                    <div class="font-weight-bold text-uppercase mb-1">
                        {{ $orderItem->shippingCost + $orderItem->totalSum }} DA
                    </div>

                    <div class="text-xs font-weight-bold text-tertiary text-uppercase">
                        Shipping Time:
                    </div>
                    <div class="font-weight-bold text-uppercase mb-1">
                        {{ $orderItem->shippingTime }}
                    </div>

                    <div class="text-xs font-weight-bold text-tertiary text-uppercase">
                        Lien:
                    </div>
                    <div class="font-weight-bold text-uppercase mb-1">
                        <a href="{{ $orderItem->uri }}" target="_blank">AliExpress</a>
                    </div>
                    <div class="text-xs font-weight-bold w-100 text-uppercase">
                        <a href="{{ route('admin.orderItem', $orderItem->id) }}" class="btn btn-outline-primary w-100 font-weight-bold">Voir</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
