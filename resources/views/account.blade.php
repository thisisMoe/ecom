@extends('layouts.custom')

@section('content')
    <div class="container pt-7 d-lg-flex gap-4">
        <div class="border p-3 mb-5" style="border-radius: 10px">
            <h4 class="mb-3">{{ Auth::user()->fullName }}</h4>
            <hr class="opacity-1">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="fas fa-phone-alt"></span>
                <p class="fw-bold mb-0">{{ Auth::user()->phone }}</p>
            </div>
            <hr class="opacity-1">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="fas fa-map-marked-alt"></span>
                <p class="mb-0">{{ Auth::user()->address }}</p>
            </div>
            <hr class="opacity-1">
            <div class="d-flex align-items-center justify-content-center mt-4">
                <a href="{{ route('user.edit', Auth::user()->id) }}" class="btn btn-primary w-100">Modifier</a>
            </div>
        </div>
        <div>
            <h1 class="mb-5">Mes commandes ({{ Auth::user()->orders->count() }})</h1>
            <div class="row mb-3">
                @foreach ($orders as $order)
                    <div class="col-12 col-md-6 col-lg-6 mb-5 mb-md-7 mb-lg-0">
                        <div class="card border-0 overflow-hidden">
                            <div class="position-relative">
                                <img src="./assets/img/team/profile-picture-1.jpg" class="card-img-top" alt="Neil Portrait">
                            </div>
                            <div class="card-body position-relative mt-n6 mx-2 bg-white border border-gray-300 text-center rounded pb-3">
                                <p class="text-light"> <span class="fw-bold">{{ $order->created_at->diffForHumans() }}</span></p>
                                <h3 class="h5 card-title">Total: {{ $order->total + $order->totalShipping }}DA</h3>
                                <div class="mb-4">
                                    <span class="text-gray">
                                        <span class="fas fa-map-marker-alt me-2"></span>
                                        {{ Auth::user()->address }}
                                    </span>
                                </div>
                                @foreach ($order->orderItems as $item)
                                    <div class="d-flex justify-content-between align-items-center border-top">
                                        <p class="mb-1 mt-1">{!! html_entity_decode(Str::limit($item->title, 20, '...')) !!}</p>
                                        <p class="mt-1 mb-1 fw-bold">{{ $item->totalSum }}DA</p>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-between align-items-center border-top">
                                    <p class="mb-1 mt-1">Total Shipping:</p>
                                    <p class="mt-1 mb-1 fw-bold">{{ $order->totalShipping }}DA</p>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <span class="text-capitalize fs-5 badge bg-info">{{ $order->orderStatus }}</span>
                                </div>
                                @if ($order->confirmations->count() == 0)
                                    <div class="btn-group mt-3">
                                        <button type="button" class="btn btn-secondary btn-icon" data-bs-toggle="modal" data-bs-target="#modal-{{ $order->id }}">
                                            <span class="me-1"><span class="fas fa-check"></span></span> Confirmer Commande
                                        </button>
                                    </div>
                                    <div class="modal fade" id="modal-{{ $order->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-{{ $order->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="h6 modal-title">Confirmation de paiement</h2>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <form action="{{ route('image.upload.order', ['id' => $order->id]) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>With less than a month to go before the European Union enacts new consumer privacy laws for its citizens,
                                                            companies around the world
                                                            are updating their terms of service agreements to comply.</p>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="form-label">Ajouter votre reçu de paiement ici:
                                                            </label>
                                                            <input class="form-control" name="confirmation_image" type="file" id="formFile">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-secondary">Envoyer</button>
                                                        <button type="button" class="btn btn-link ms-auto" data-bs-dismiss="modal">
                                                            Fermer
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-4 fw-bold fst-italic">Confirm your order by uploading your payment receipt.</p>
                                @else
                                    <div class="my-3 pb-3" style="">
                                        <p class="mb-3 fs-5"><span class="fas fa-check text-success"></span> En attente de confirmation</p>
                                        <a href="{{ Storage::url($order->confirmations->first()->path) }}" target="_blank">
                                            <img class="mb-3 d-block m-auto" style="max-width: 100%; height: 350px;"
                                                src="{{ Storage::url($order->confirmations->first()->path) }}" alt="Confirmation image">
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
