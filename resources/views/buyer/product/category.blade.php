@extends('layouts.main')
@section('bodyDR')

<link rel="stylesheet" href="{{ mix('css/scroll.css') }}">
<div class="category-container">
    <div class="d-flex align-items-start">
        <div class="categ-body">
            <div class="navigation-categ">
                <div class="nav-body-categ">
                    <div class="title-nav-categ">
                        <span>Category</span>
                    </div>
                    <hr>
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link {{ in_array(request()->get('tab'),['']) ? 'active' : '' }}" aria-current="page" href="/category">Show All</a>
                            </li>
                            @foreach ($categories as $categ)
                                <li class="nav-item">
                                    <a class="nav-link {{ in_array(request()->get('tab'),[$categ->slug]) ? 'active' : '' }}" href="/category?tab={{ $categ->slug }}">{{ (strlen($categ->name) > 15)? substr(ucfirst($categ->name),0,15)."..." : ucfirst($categ->name) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div id="itemLoad" class="body-product-categ" style="padding-bottom: 100px;">
                @if ($products->count())
                    @include('buyer.product.item-category')
                @else
                    No Products
                @endif

                <div class="ajax-load mt-3 p-3" style="display:none; text-align:center;">
                    <p>
                        <img class="img-fluid" src="/img/spin.gif" width="50">
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ mix('js/scroll.js') }}"></script>
@endsection