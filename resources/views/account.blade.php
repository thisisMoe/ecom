@extends('layouts.custom')

@section('content')
    <div class="container pt-7 d-lg-flex flex-column gap-4">
        <div class="border p-3 mb-3" style="border-radius: 10px">
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
                <a href="{{ route('user.edit', Auth::user()->id) }}" style="background: #eeeeee" class="btn btn-light w-100">{{ __('Modifier') }}</a>
            </div>
        </div>
        <div>
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
                    {!! Session::get('success') !!}
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            @endif
            <h1 class="mb-3 mt-3">{{ __('Mes commandes') }} ({{ Auth::user()->orders->count() }})</h1>
            <div class="d-flex gap-2 align-items-center mb-4 py-3 px-4" style="overflow-x: auto; white-space: nowrap; background: #efefefef; border-radius: 10px">
                <div style="background:#fff" class="text-capitalize badge p-2 fs-5 bg-light text-primary">
                    <a href="{{ route('account') }}">Tous</a>
                </div>
                <div class="text-capitalize badge p-2 fs-5 bg-danger text-white">
                    <a href="{{ route('account', ['status' => 'pending']) }}">En Attente</a>
                </div>
                <div class="text-capitalize badge p-2 fs-5 bg-info text-white">
                    <a href="{{ route('account', ['status' => 'confirmed']) }}">Confirmé</a>
                </div>
                <div class="text-capitalize badge p-2 fs-5 bg-success text-white">
                    <a href="{{ route('account', ['status' => 'shipped']) }}">Expédié</a>
                </div>
                <div style="background:#2D4059;" class="p-2 text-capitalize badge fs-5 text-white">
                    <a href="{{ route('account', ['status' => 'delivered']) }}">Livré</a>
                </div>
            </div>
            <div class="row mb-3">
                @foreach ($orders as $order)
                    <div class="col-12 col-md-6 col-lg-6 mb-5 mb-md-7 mb-lg-5">
                        <div class="card border-0 overflow-hidden">
                            <div class="position-relative">
                                {{-- <img src="./assets/img/team/profile-picture-1.jpg" class="card-img-top" alt="Neil Portrait"> --}}
                                <div class="w-100 pb-6 px-4 pt-4 text-center" style="background: #ffeeee; min-height: 150px">
                                    <p>
                                        @if ($order->orderStatus == 'pending')
                                            <span class="mb-0 text-capitalize badge bg-danger fs-6">
                                                En Attente
                                            </span>
                                        @elseif ($order->orderStatus == 'confirmed')
                                            <span class="mb-0 text-capitalize badge fs-6 bg-info">
                                                Confirmé
                                            </span>
                                        @elseif ($order->orderStatus == 'shipped')
                                            <span class="mb-0 text-capitalize badge fs-6 bg-success">
                                                Expédié
                                            </span>
                                        @elseif ($order->orderStatus == 'delivered')
                                            <span style="background:#2D4059;" class="mb-0 text-capitalize badge fs-6">
                                                Livré
                                            </span>
                                        @endif
                                    </p>
                                    @if ($order->orderStatus == 'pending')
                                        <p class="fw-bold">
                                            {{ __('Nous avons reçu votre commande, pour confirmer votre commande veuillez nous envoyer le reçu de paiement') }}
                                        </p>
                                    @elseif ($order->orderStatus == 'confirmed')
                                        <p class="fw-bold">
                                            {{ __('Nous avons confirmé votre paiement et commandé votre produit, vous serez averti une fois votre produit expédié') }}
                                        </p>
                                    @elseif ($order->orderStatus == 'shipped')
                                        <p class="fw-bold">
                                            {{ __('Le produit a été expédié officiellement') }}
                                        </p>
                                    @elseif ($order->orderStatus == 'delivered')
                                        <p class="fw-bold">
                                            {{ __('Le produit a été Livré, Merci de nous faire confiance') }}
                                            <i class="far fa-smile-beam"></i>
                                        </p>
                                    @endif
                                    @if ($order->proofImage !== '')
                                        <p class="fw-bold text-italic">{{ __('Cliquez sur l’image pour l’agrandir') }}</p>
                                        <a href="{{ Storage::url($order->proofImage) }}" target="_blank">
                                            <img class="d-block m-auto" style="max-width: 100%; height: 160px; border-radius: 6px; box-shadow: 0px 3px 15px -2px;"
                                                src="{{ Storage::url($order->proofImage) }}" alt="Preuve d'achat">
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body position-relative mt-n6 mx-2 bg-white border border-gray-300 text-center rounded pb-3">
                                <div class="d-flex justify-content-end align-items-center">
                                    @if ($order->orderStatus == 'pending')
                                        <button class="text-danger btn btn-light" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $order->id }}">
                                            <span class="fs-4 far fa-times-circle"></span>
                                        </button>
                                    @endif
                                </div>
                                <h3 class="h5 card-title">@lang('Total') : {{ $order->total + $order->totalShipping }}{{ __('DA') }}</h3>
                                <div class="mb-4">
                                    <span class="text-gray">
                                        <span class="fas fa-map-marker-alt me-2"></span>
                                        {{ Auth::user()->address }}
                                    </span>
                                </div>
                                @foreach ($order->orderItems as $item)
                                    <div class="d-flex justify-content-between align-items-center border-top">
                                        <p class="mb-1 mt-1">{!! html_entity_decode(Str::limit($item->title, 20, '...')) !!}</p>
                                        <p class="mt-1 mb-1 fw-bold">{{ $item->totalSum }}{{ __('DA') }}</p>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-between align-items-center border-top">
                                    <p class="mb-1 mt-1">{{ __('Frais de Livraison') }}:</p>
                                    <p class="mt-1 mb-1 fw-bold">{{ $order->totalShipping }}{{ __('DA') }}</p>
                                </div>
                                <hr>
                                @if ($order->orderStatus == 'pending')
                                    <div class="btn-group mt-3">
                                        <button type="button" class="btn-sm btn-secondary btn-icon" data-bs-toggle="modal"
                                            data-bs-target="#modal-{{ $order->id }}">
                                            <span class="me-1"><span class="fas fa-check"></span></span> {{ __('Confirmer Commande') }}
                                        </button>
                                    </div>
                                    <div class="modal fade" id="modal-{{ $order->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-{{ $order->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="h6 modal-title">{{ __('Confirmation de paiement') }}</h2>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <form id="fileForm" action="{{ route('image.upload.order', ['id' => $order->id]) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>{{ __('Pour Confirmer votre paiement, Veuillez prendre une photo du reçu de paiement et nous envoyer la photo
                                                            pour que nous puissions la confirmer le plus rapidement possible. Merci :)') }}
                                                        </p>
                                                        <div class="mb-3 mt-4">
                                                            <label for="imageUpload-{{ $order->id }}"
                                                                class="btn btn-outline-secondary btn-lg fs-4">{{ __('Ajouter Photo') }}</label>
                                                            <input type="file" id="imageUpload-{{ $order->id }}" accept="image/*" name="confirmation_image"
                                                                style="display: none">
                                                        </div>
                                                        <div class="progress-wrapper" style="display: none;">
                                                            <div class="progress-info">
                                                                <div class="progress-label">
                                                                    <div class="spinner-border text-success" role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                    <span class="text-success">Téléchargement:</span>
                                                                </div>
                                                                <div class="progress-percentage"><span>60%</span>
                                                                </div>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-secondary">{{ __('Envoyer') }}</button>
                                                        <button type="button" class="btn btn-link ms-auto" data-bs-dismiss="modal">
                                                            {{ __('Fermer') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-4 fw-bold fst-italic">{{ __('Confirmez votre commande en envoyant votre reçu de paiement.') }}</p>
                                    <div class="mb-3">
                                        <h4 class="fw-bol">CCP</h4>
                                        <p class="mb-1">Kadem Azzeddine</p>
                                        <p>0019258375 clé 27</p>
                                        <h4 class="fw-bol">BaridiMob</h4>
                                        <p class="mb-1">00799999001925837527</p>
                                    </div>
                                @endif
                                @if ($order->confirmations->count() != 0)
                                    <div class="my-3 pb-3" style="">
                                        @if ($order->confirmations && $order->orderStatus == 'pending')
                                            <p class="mb-3 fs-5"><span class="fas fa-check text-success"></span> {{ __('En attente de confirmation') }}</p>
                                        @elseif ($order->orderStatus != 'pending')
                                            <p class="mb-3 fs-5"><span class="fas fa-check text-success"></span> {{ __('Paiement Confirmé') }}</p>
                                        @endif
                                        <div class="border border-success" style="border-radius: 6px; background-color: #eeffee;">
                                            <a href="{{ Storage::url($order->confirmations->first()->path) }}" target="_blank">
                                                <img class="d-block m-auto" style="max-width: 100%; height: 160px;"
                                                    src="{{ Storage::url($order->confirmations->first()->path) }}" alt="Confirmation image">
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <div class="d-flex flex-column justify-content-end">
                                    <p class="text-light text-italic"> <span class="fw-bold">{{ $order->created_at->diffForHumans() }}</span></p>
                                    @if ($order->orderStatus == 'pending')
                                        <p class="font-small">{{ __('votre commande sera supprimée après 24 heures si non confirmée.') }}</p>
                                    @endif
                                </div>
                                <div class="modal fade" id="modal-delete-{{ $order->id }}" tabindex="-1" aria-labelledby="modal-delete-{{ $order->id }}"
                                    style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="h6 modal-title">{{ __('Alert') }}</h2><button type="button" class="btn-close"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ __('Êtes-vous sûr de vouloir supprimer cette commande ?') }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('user.orders.delete', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">
                                                        {{ __('Supprimer') }}
                                                    </button>
                                                </form>
                                                <button type="button" class="btn btn-link ms-auto" data-bs-dismiss="modal">
                                                    {{ __('Annuler') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $.each($('input:file'), function() {
            $(this).change(function() {
                var name = $(this)[0].files[0].name;
                var label = $(this).closest('div').find('label');
                if (name.length > 20) {
                    label[0].innerHTML = `${name.substring(0, 20)}...`;
                } else {
                    label[0].innerHTML = name;
                }
            })
        })

        // $('#imageUpload').change(function() {
        //     var name = $('#imageUpload')[0].files[0].name;
        //     var label = $(this).closest('div').find('label');
        //     if (name.length > 20) {
        //         label[0].innerHTML = `${name.substring(0, 20)}...`;
        //     } else {
        //         label[0].innerHTML = name;
        //     }
        // })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(function() {
            $(document).ready(function() {
                var bar = $('.progress-bar');
                var percent = $('.progress-percentage')
                $('#fileForm').ajaxForm({
                    beforeSend: function() {
                        $(".progress-wrapper").show();
                        var percentVal = '0%';
                        bar.width(percentVal);
                        bar.attr("aria-valuenow", percentVal);
                        percent.html(percentVal);
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%';
                        bar.width(percentVal)
                        bar.attr("aria-valuenow", percentVal);
                        percent.html(percentVal);
                    },
                    complete: function(xhr) {
                        alert('File Has Been Uploaded Successfully');
                        location.reload();
                    }
                });
            });
        });
    </script>
@endsection
