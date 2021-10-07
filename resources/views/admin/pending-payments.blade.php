@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
          <span class="badge bg-warning text-white py-2 px-4">Pending Orders With Payments ({{$ordersCount}})</span>
        </h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>
            Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        @foreach ($orders as $order)
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card 
                @if ($order->orderStatus == 'pending')
                border-left-warning
                @else
                border-left-primary
                @endif
                shadow h-100 py-2">
                    <div class="card-body">
                        <div>
                            <p class="font-weight-bold mb-0">{{ $order->user->fullName }}</p>
                            <p class="font-weight-bold">{{ $order->user->phone }}</p>
                        </div>
                        <div class="row align-items-center">
                            @foreach ($order->orderItems as $orderItem)
                                <div class="col-6">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">
                                        {!! html_entity_decode(Str::limit($orderItem->title, 50, '...')) !!}
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
                                        <div class="input-group mb-3 mt-1">
                                            <input type="text" class="form-control" style="max-width: 100px" placeholder="0" aria-label="Shipping costs"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-success font-weight-bold" type="button"><span class="fas fa-check"></span></button>
                                            </div>
                                        </div>
                                    @else
                                        <div class="font-weight-bold text-uppercase">
                                            {{ $orderItem->shippingCost }} DA
                                        </div>
                                    @endif

                                    <div class="mt-3 font-weight-bold text-tertiary text-uppercase">
                                        Somme:
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
                                        <button class="btn btn-outline-primary w-75 font-weight-bold">Voir</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if ($order->confirmations->count() == 0)
                            <div class="border border-danger py-3 mt-4 mb-2 width-100" style="border-radius: 6px">
                                <p class="text-danger text-center mb-0 text-lg">This order is not confirmed yet</p>
                            </div>
                        @else
                            <div class="mt-4 mb-2 border border-success" style="border-radius: 6px; background-color: #eeffee">
                                <a href="{{ Storage::url($order->confirmations->last()->path) }}" target="_blank">
                                    <img src="{{ Storage::url($order->confirmations->last()->path) }}" class="mb-3 d-block m-auto" style="max-width: 100%; height: 350px;" alt="Confirmation Image">
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="text-xs font-weight-bold text-tertiary text-uppercase">
                            total:
                        </div>
                        <div class="font-weight-bold text-tertiary text-uppercase mb-1">
                            {{ $order->total }} DA
                        </div>
                        <div class="text-xs font-weight-bold text-tertiary text-uppercase">
                            Commision:
                        </div>
                        <div class="font-weight-bold text-tertiary text-uppercase mb-1">
                            {{ $order->totalFee }} DA
                        </div>
                        <div class="text-xs font-weight-bold text-tertiary text-uppercase">
                            Total Shipping Costs:
                        </div>
                        <div class="font-weight-bold text-tertiary text-uppercase mb-1">
                            {{ $order->totalShipping }} DA
                        </div>
                        <div class="text-xs font-weight-bold w-100 text-uppercase my-3">
                            <button class="btn btn-outline-primary w-100 font-weight-bold">Voir</button>
                        </div>
                        <div class="text-xs font-weight-bold w-100 text-uppercase my-3">
                            <button class="btn btn-success w-100 font-weight-bold">Confirmer Paiement</button>
                        </div>
                        <div class="text-xs font-weight-bold w-100 text-uppercase my-3">
                            <button class="btn btn-danger w-100 font-weight-bold">Supprimer</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end">
        {{ $orders->links() }}
    </div>
@endsection
