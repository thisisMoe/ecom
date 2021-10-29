@php
$ar = app()->getLocale() === 'ar';
@endphp
@extends('layouts.custom')

@section('content')
    <div class="container pt-7">
        <div class="d-flex gap-2 align-items-center justify-content-between">
            <h2>{{ __('Mon Panier') }}</h2>
            @if ($orderItems)
                <form action="{{ route('panier.addOrder') }}" method="POST">
                  @csrf
                    <button type="submit" class="btn btn-success text-white px-4">{{ __('Passez ma commande') }}</button>
                </form>
            @else
            @endif
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {!! Session::get('success') !!}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
        <div class="row mb-3 mt-4">
            @if(!$orderItems)
                <div class="col-12 mt-5">
                    <div class="card shadow mb-6">
                        <div class="card-body px-5 py-5 text-center text-md-left">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="mb-3">{{ __('Panier vide') }}</h2>
                                    <p class="mb-0">
                                        {{ __('Si vous avez besoin d’aide avec nos produits ou services, choisissez l’une des façons suivantes de
                                        nous contacter.') }}
                                    </p>
                                    <p class="my-2">
                                        <a href="https://www.facebook.com/DZ.ALIEXPRESS.service" target="_blank" class="fw-bold"><i
                                                class="fab fa-facebook-square"></i> {{ __('Page Facebook') }}</a>
                                    </p>
                                    <p class="my-2">
                                        <a href="tel:+213558494325" class="fw-bold"><i class="fas fa-mobile-alt"></i>
                                            {{ __('Par Téléphone (cliquer ici)') }}</a>
                                    </p>
                                </div>
                                <div class="col-12 col-md-6 mt-4 mt-md-0 text-md-right">
                                    <a href="{{ route('searchProduct') }}" class="btn btn-primary">
                                        <span class="me-1">
                                            <span class="fas fa-search"></span>
                                        </span>
                                        {{ __('Commencer') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @foreach ($orderItems as $orderItem)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card shadow text-center mb-4">
                            <div class="card-header bg-white p-3">
                                <h6 class="text-primary mb-4">{!! $orderItem->title !!}</h6>
                                <span class="d-block">
                                    <span class="display-3 text-dark fw-bold">
                                        {{ $orderItem->totalSum }}DA
                                    </span>
                                    <span class="d-block text-gray">+ {{ $orderItem->shippingCost }}DA
                                        <span class="fas fa-shipping-fast"></span>
                                    </span>
                                    <span class="d-block text-gray mt-3">
                                        <strong>
                                            <span class="">Total:</span>
                                            {{ $orderItem->shippingCost + $orderItem->totalSum }}DA
                                        </strong>
                                    </span>
                                </span>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled mb-4">
                                    @foreach (json_decode($orderItem->selectedProps, true) as $prop)
                                        <li class="list-item pb-3">
                                            <strong>{!! $prop['name'] !!}:</strong>
                                            {{ $prop['selected'] }}
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="">
                                    <button data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $orderItem->id }}" class="btn btn-danger animate-up-1">
                                        <span class="fas fa-trash-alt"></span>
                                        <span>Supprimer</span>
                                    </button>
                                </div>
                                <div class="modal fade" id="modal-delete-{{ $orderItem->id }}" tabindex="-1"
                                    aria-labelledby="modal-delete-{{ $orderItem->id }}" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="h6 modal-title">{{ __('Alert') }}</h2><button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ __('Êtes-vous sûr de vouloir supprimer cet article ?') }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('panier.delete', $orderItem->id) }}" method="POST">
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
            @endif
        </div>
    </div>
@endsection
