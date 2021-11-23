@php
$ar = app()->getLocale() === 'ar';
@endphp
@extends('layouts.custom')

@section('sidebar')

    <div class="sidebar hor-scroll-bar">
        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>
        <ul>
            @foreach ($mainCategories as $cat)
                @if ($cat->name)
                    <li>
                        <a href="{{ route('products', ['mainCat' => $cat->id]) }}" class="">
                            @if ($ar)
                                <span class="item">{!! $cat->arabicName !!}</span>
                            @else
                                <span class="item">{!! $cat->name !!}</span>
                            @endif
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

@endsection

@section('content')
    <div class="container px-3" style="padding-top:105px">
        <div class="text-center mb-3">
            <button type="button" id="sidebarCollapse" class="btn btn-outline-gray w-100">
                <i class="fas fa-search"></i>
                <span>{{ __('Catégories') }}</span>
                @if ($ar)
                    <span class="d-block font-small">{!! $mainCat->name ?? 'كل الفئات' !!}</span>
                @else
                    <span class="d-block font-small">{!! $mainCat->name ?? 'Tous' !!}</span>
                @endif
            </button>
        </div>
        <div style="background: #f5f9fc; border-radius: 10px" class="mb-4">
            @if (!$mainCat)
                <p class="p-2 fw-bold">{{ __('pour effectuer une recherche par catégorie, veuillez en sélectionner une.') }}</p>
            @endif
            @if ($categories)
                <div class="d-flex gap-2 align-items-center py-3 px-2" style="overflow-x: auto; white-space: nowrap;">
                    @foreach ($categories as $cat)
                        <div style="background:#fff" class="text-capitalize badge py-2 px-2 @if ($cat->id == app('request')->input('cat')) bg-primary text-white @else bg-light text-primary @endif">
                            <a href="{{ route('products', ['mainCat' => $mainCat->id, 'cat' => $cat]) }}" class="font-small fw-bold">
                                @if ($ar)
                                    {!! $cat->arabicName !!}
                                @else
                                    {!! $cat->name !!}
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
            @if ($subCategories)
                <hr class="my-0">
                <div class="d-flex gap-2 align-items-center py-3 px-2" style="overflow-x: auto; white-space: nowrap;">
                    @foreach ($subCategories as $cat)
                        <div style="background:#fff" class="text-capitalize badge py-2 px-2 @if ($cat->id == app('request')->input('subCat')) bg-primary text-white @else bg-light text-primary @endif">
                            <a href="{{ route('products', ['mainCat' => $mainCat->id, 'cat' => app('request')->input('cat'), 'subCat' => $cat->id]) }}"
                                class="font-small fw-bold">
                                @if ($ar)
                                    {!! $cat->arabicName !!}
                                @else
                                    {!! $cat->name !!}
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="row mt-4 pb-4 pt-2">
            @foreach ($products as $product)
                <div class="col-6 col-md-3 col-lg-2 px-1 mb-3 d-flex justify-content-center">
                    <div class="" style="max-width: 200px">
                        <a href="{{ route('searchProduct', ['q' => $product->link]) }}" target="blank" style="cursor: pointer;">
                            <div class="card shadow" style="border: none;min-height: 260px;"><img src="{{ $product->image }}" class="card-img-top rounded-top"
                                    alt="Image du Produit">
                                <div class="card-body d-flex flex-column justify-content-between" style="padding: 8px 6px">
                                    @if ($ar)
                                        <span class="h6 icon-tertiary font-small">
                                            {!! Str::limit($product->title, 50, $end = '') !!}
                                        </span>
                                    @else
                                        <span class="h6 icon-tertiary font-small">
                                            {!! Str::limit($product->title, 50, $end = '...') !!}
                                        </span>
                                    @endif
                                    @if ($product->equalPrice > 0)
                                        <h3 class="fw-bold card-title mt-3 text-center" style="font-size: 16px">{{ $product->equalPrice }} {{ __('DA') }}
                                        </h3>
                                    @else
                                        <h3 class="fw-bold card-title mt-3 text-center" style="font-size: 16px">
                                            {{ $product->minPrice }}~{{ $product->maxPrice }}
                                            {{ __('DA') }}</h3>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
            {{ $products->links() }}
        </div>

        <div>
            <h3>{{ __('Produits en vedette moins de 1000 DA') }}</h3>
        </div>

        <div class="row mt-4 pb-4 pt-2">
            @foreach ($fu1000 as $product)
                <div class="col-6 col-md-3 col-lg-2 px-1 mb-3 d-flex justify-content-center">
                    <div class="" style="max-width: 200px">
                        <a href="{{ route('searchProduct', ['q' => $product->link]) }}" target="blank" style="cursor: pointer;">
                            <div class="card shadow" style="border: none;min-height: 260px;"><img src="{{ $product->image }}" class="card-img-top rounded-top"
                                    alt="Image du Produit">
                                <div class="card-body d-flex flex-column justify-content-between" style="padding: 8px 6px">
                                    @if ($ar)
                                        <span class="h6 icon-tertiary font-small">
                                            {!! Str::limit($product->title, 50, $end = '') !!}
                                        </span>
                                    @else
                                        <span class="h6 icon-tertiary font-small">
                                            {!! Str::limit($product->title, 50, $end = '...') !!}
                                        </span>
                                    @endif
                                    @if ($product->equalPrice > 0)
                                        <h3 class="fw-bold card-title mt-3 text-center" style="font-size: 16px">{{ $product->equalPrice }} {{ __('DA') }}
                                        </h3>
                                    @else
                                        <h3 class="fw-bold card-title mt-3 text-center" style="font-size: 16px">
                                            {{ $product->minPrice }}~{{ $product->maxPrice }}
                                            {{ __('DA') }}</h3>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
            {{ $products->links() }}
        </div>

        <div>
            <h3>{{ __('Produits en vedette moins de 5000 DA') }}</h3>
        </div>

        <div class="row mt-4 pb-4 pt-2">
            @foreach ($fu5000 as $product)
                <div class="col-6 col-md-3 col-lg-2 px-1 mb-3 d-flex justify-content-center">
                    <div class="" style="max-width: 200px">
                        <a href="{{ route('searchProduct', ['q' => $product->link]) }}" target="blank" style="cursor: pointer;">
                            <div class="card shadow" style="border: none;min-height: 260px;"><img src="{{ $product->image }}" class="card-img-top rounded-top"
                                    alt="Image du Produit">
                                <div class="card-body d-flex flex-column justify-content-between" style="padding: 8px 6px">
                                    @if ($ar)
                                        <span class="h6 icon-tertiary font-small">
                                            {!! Str::limit($product->title, 50, $end = '') !!}
                                        </span>
                                    @else
                                        <span class="h6 icon-tertiary font-small">
                                            {!! Str::limit($product->title, 50, $end = '...') !!}
                                        </span>
                                    @endif
                                    @if ($product->equalPrice > 0)
                                        <h3 class="fw-bold card-title mt-3 text-center" style="font-size: 16px">{{ $product->equalPrice }} {{ __('DA') }}
                                        </h3>
                                    @else
                                        <h3 class="fw-bold card-title mt-3 text-center" style="font-size: 16px">
                                            {{ $product->minPrice }}~{{ $product->maxPrice }}
                                            {{ __('DA') }}</h3>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
            {{ $products->links() }}
        </div>

        <div>
            <h3>{{ __('Produits en vedette') }}</h3>
        </div>

        <div class="row mt-4 pb-4 pt-2">
            @foreach ($featuredProducts as $product)
                <div class="col-6 col-md-3 col-lg-2 px-1 mb-3 d-flex justify-content-center">
                    <div class="" style="max-width: 200px">
                        <a href="{{ route('searchProduct', ['q' => $product->link]) }}" target="blank" style="cursor: pointer;">
                            <div class="card shadow" style="border: none;min-height: 260px;"><img src="{{ $product->image }}" class="card-img-top rounded-top"
                                    alt="Image du Produit">
                                <div class="card-body d-flex flex-column justify-content-between" style="padding: 8px 6px">
                                    @if ($ar)
                                        <span class="h6 icon-tertiary font-small">
                                            {!! Str::limit($product->title, 50, $end = '') !!}
                                        </span>
                                    @else
                                        <span class="h6 icon-tertiary font-small">
                                            {!! Str::limit($product->title, 50, $end = '...') !!}
                                        </span>
                                    @endif
                                    @if ($product->equalPrice > 0)
                                        <h3 class="fw-bold card-title mt-3 text-center" style="font-size: 16px">{{ $product->equalPrice }} {{ __('DA') }}
                                        </h3>
                                    @else
                                        <h3 class="fw-bold card-title mt-3 text-center" style="font-size: 16px">
                                            {{ $product->minPrice }}~{{ $product->maxPrice }}
                                            {{ __('DA') }}</h3>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
            {{ $products->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var hamburger = document.querySelector("#sidebarCollapse");
            hamburger.addEventListener("click", function() {
                document.querySelector("body").classList.toggle("active");
                $('.overlay').show();
            })

            $('#dismiss, .overlay').on('click', function() {
                document.querySelector("body").classList.toggle("active");
                // hide overlay
                $('.overlay').hide();
            });
        });
    </script>
@endsection
