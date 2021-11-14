@php
$ar = app()->getLocale() === 'ar';
@endphp
@extends('layouts.custom')

@section('sidebar')

    <div class="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>
        <ul>
            <li>
                <a href="#" class="active">
                    <span class="icon"><i class="fas fa-home"></i></span>
                    <span class="item">Home</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fas fa-desktop"></i></span>
                    <span class="item">My Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fas fa-user-friends"></i></span>
                    <span class="item">People</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
                    <span class="item">Perfomance</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fas fa-database"></i></span>
                    <span class="item">Development</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fas fa-chart-line"></i></span>
                    <span class="item">Reports</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fas fa-user-shield"></i></span>
                    <span class="item">Admin</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fas fa-cog"></i></span>
                    <span class="item">Settings</span>
                </a>
            </li>
        </ul>
    </div>

@endsection

@section('content')
    <div class="container pt-7 px-3" style="background: #f2f2f2">
        <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-align-left"></i>
            <span>Toggle Sidebar</span>
        </button>
        <div class="row mt-4 pb-4 pt-2">
            @foreach ($hotProducts as $product)
                <div class="col-6 col-md-3 col-lg-2 px-1 mb-3 d-flex justify-content-center">
                    <div class="" style="max-width: 200px">
                        <a href="{{ route('searchProduct', ['q' => $product->link]) }}" target="blank" style="cursor: pointer;">
                            <div class="card shadow" style="border: none;min-height: 322px; height: 322px"><img src="{{ $product->image }}"
                                    class="card-img-top rounded-top" alt="Image du Produit">
                                <div class="card-body d-flex flex-column justify-content-between" style="padding: 8px 6px">
                                    @if ($ar)
                                        <span class="h6 icon-tertiary small">
                                            {!! Str::limit($product->title, 50, $end = '') !!}
                                        </span>
                                    @else
                                        <span class="h6 icon-tertiary small">
                                            {!! Str::limit($product->title, 50, $end = '...') !!}
                                        </span>
                                    @endif
                                    @if ($product->equalPrice > 0)
                                        <h3 class="fw-bold card-title mt-3" style="font-size: 17px">{{ $product->equalPrice }} {{ __('DA') }}</h3>
                                    @else
                                        <h3 class="fw-bold card-title mt-3" style="font-size: 17px">{{ $product->minPrice }}~{{ $product->maxPrice }}
                                            {{ __('DA') }}</h3>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var hamburger = document.querySelector("#sidebarCollapse");
            hamburger.addEventListener("click", function() {
                document.querySelector("body").classList.toggle("active");
            })

            $('#dismiss, .overlay').on('click', function() {
                document.querySelector("body").classList.toggle("active");
                // hide overlay
                $('.overlay').removeClass('active');
            });
        });
    </script>
@endsection
