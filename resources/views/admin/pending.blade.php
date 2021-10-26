@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            @if (request()->filter['orderStatus'] == 'pending')
                <span class="badge bg-warning text-white py-2 px-4">Pending ({{ $ordersCount }})</span>
            @elseif (request()->filter['orderStatus'] == 'confirmed')
                <span class="badge bg-danger text-white py-2 px-4">Confirmed ({{ $ordersCount }})</span>
            @elseif (request()->filter['orderStatus'] == 'shipped')
                <span class="badge bg-info text-white py-2 px-4">Shipped ({{ $ordersCount }})</span>
            @elseif (request()->filter['orderStatus'] == 'delivered')
                <span class="badge bg-success text-white py-2 px-4">Delivered ({{ $ordersCount }})</span>
            @endif
        </h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>
            Generate Report</a>
    </div>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3 d-flex justify-content-between align-items-center" role="alert">
            <div>{!! Session::get('success') !!}</div>
            <button type="button" class="btn btn-default" data-dismiss="alert" aria-label="Close">X
            </button>
        </div>
    @endif
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        @foreach ($orders as $order)
            <div class="col-xl-6 col-md-6 mb-4">
                <div
                    class="card 
                @if ($order->orderStatus == 'pending')
                border-left-warning
                @elseif ($order->orderStatus == 'confirmed')
                border-left-danger
                @elseif ($order->orderStatus == 'shipped')
                border-left-info
                @elseif ($order->orderStatus == 'delivered')
                border-left-success
                @endif
                shadow h-100 py-2">
                    <div class="card-body">
                        <div>
                            <div class="font-weight-bold mb-1 d-flex align-items-center">
                                {{ $order->created_at->diffForHumans() }}
                            </div>
                            <div class="font-weight-bold mb-1 d-flex align-items-center">
                                <div class="mr-2 far fa-user"></div>
                                <div>{{ $order->user->fullName }}</div>
                            </div>
                            <div class="font-weight-bold d-flex align-items-center">
                                <div class="mr-2 fas fa-mobile-alt"></div>
                                <div>{{ $order->user->phone }}</div>
                            </div>
                        </div>
                        @if ($order->confirmations->count() == 0)
                            <div class="border border-danger py-3 my-auto mb-2 width-100" style="border-radius: 6px">
                                <p class="text-danger text-center mb-0 text-lg">This order is not confirmed yet</p>
                            </div>
                        @else
                            <div class="mt-4 mb-2 border border-success" style="border-radius: 6px; background-color: #eeffee">
                                <a href="{{ Storage::url($order->confirmations->last()->path) }}" target="_blank">
                                    <img src="{{ Storage::url($order->confirmations->last()->path) }}" class="mb-3 d-block m-auto"
                                        style="max-width: 100%; height: 350px;" alt="Confirmation Image">
                                </a>
                                <hr style="">
                                @if ($order->proofImage)
                                    <a href="{{ Storage::url($order->proofImage) }}" target="_blank">
                                        <img src="{{ Storage::url($order->proofImage) }}" class="mb-3 d-block m-auto" style="max-width: 100%; height: 350px;"
                                            alt="Preuve d'achat">
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="text-xs font-weight-bold text-tertiary text-uppercase">
                            total (Prix + Shipping + Commiss.):
                        </div>
                        <div class="font-weight-bold text-tertiary text-uppercase mb-1">
                            {{ $order->total + $order->totalShipping }} DA
                        </div>
                        <div class="text-xs font-weight-bold text-tertiary text-uppercase">
                            Commision:
                        </div>
                        <div class="font-weight-bold text-tertiary text-uppercase mb-1">
                            <span class="text-success">{{ $order->totalFee }}</span> DA
                        </div>
                        <div class="text-xs font-weight-bold text-tertiary text-uppercase">
                            Total Shipping Costs:
                        </div>
                        <div class="font-weight-bold text-tertiary text-uppercase mb-1">
                            {{ $order->totalShipping }} DA
                        </div>
                        <div class="text-xs font-weight-bold w-100 text-uppercase my-3 d-flex" style="gap: 1rem;">
                            <a href="{{ route('admin.order.view', $order->id) }}" class="btn btn-outline-primary w-100 font-weight-bold">Voir</a>
                            @if (request()->filter['orderStatus'] == 'pending')
                                <button data-toggle="modal" data-target="#confirmModal-{{ $order->id }}"
                                    class="btn btn-success w-100 font-weight-bold">Confirmer
                                </button>
                            @endif
                            @if (request()->filter['orderStatus'] == 'confirmed')
                                <button data-toggle="modal" data-target="#shippedModal-{{ $order->id }}" class="btn btn-primary w-100 font-weight-bold">Shipped
                                </button>
                            @endif
                            @if (request()->filter['orderStatus'] == 'shipped')
                                <button data-toggle="modal" data-target="#deliveredModal-{{ $order->id }}"
                                    class="btn btn-success w-100 font-weight-bold">Delivered
                                </button>
                            @endif
                            <a href="#" data-toggle="modal" data-target="#deleteModal-{{ $order->id }}"
                                class="btn btn-danger w-100 font-weight-bold">Supprimer</a>
                        </div>
                    </div>
                </div>
                <!-- delete Modal-->
                <div class="modal fade" id="deleteModal-{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this order?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Select "Supprimer" below if you are ready to end delete this order (I strongly advice against it).</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" href="">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shipped Modal-->
                <div class="modal fade" id="shippedModal-{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="shippedModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">You are about to change the status of this order to Shipped (Expédié).</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                               Please don't forget to add the tracking number.
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                <form action="{{ route('admin.orders.shipped', $order->id) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="btn btn-success" href="">Okay</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- confirmed Modal-->
                <div class="modal fade" id="confirmModal-{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to confirm this order?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.orders.confirmed', $order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="modal-body">
                                    Take a screenshot of the order from AliExpress and add the photo here
                                    <div class="form-group my-3">
                                        <input type="file" name="proof_image" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-success">Confirmer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- delivered Modal-->
                <div class="modal fade" id="deliveredModal-{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="deliveredModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">You are about to change the status of this order to Delivered (Livré).</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                               Please don't forget to ask the client for proof of delivery
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                <form action="{{ route('admin.orders.delivered', $order->id) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="btn btn-success" href="">Okay</button>
                                </form>
                            </div>
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
