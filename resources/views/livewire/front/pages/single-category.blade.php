<div>
    <livewire:front.partials.header-two />

    <main class="main">
        <div class="page-header text-center"
            style="background-image: url('{{ asset('user/assets/images/page-header-bg.jpg') }}')">
            <div class="container">
                <h1 class="page-title">{{ $categorys->name }}</h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <br>
        <div class="page-content">
            <div class="container">
                <div class="toolbox">
                    <div class="toolbox-left">
                        <a href="#" class="sidebar-toggler"><i class="icon-bars"></i>Filters</a>
                    </div><!-- End .toolbox-left -->

                    <div class="toolbox-center">
                        <div class="toolbox-info">
                            All Products <span>(10)</span>
                        </div><!-- End .toolbox-info -->
                    </div><!-- End .toolbox-center -->

                    <div class="toolbox-right">
                        <div class="toolbox-sort">
                            <label for="sortby">Sort by:</label>
                            <div class="select-custom">
                                <select name="sortby" id="sortby" class="form-control">
                                    <option value="popularity" selected="selected">Most Popular</option>
                                    <option value="rating">Most Rated</option>
                                    <option value="date">Date</option>
                                </select>
                            </div>
                        </div><!-- End .toolbox-sort -->
                    </div><!-- End .toolbox-right -->
                </div><!-- End .toolbox -->

                <div class="products">
                    <div class="row">

                        @foreach ($categorys->products as $product)
                        <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                            <div class="product">
                                <figure class="product-media">
                                    <span class="product-label label-sale">Sale</span>
                                    <a href="{{ route('front.product',[$product->id , $product->slug]) }}">
                                        <img src="{{ asset('images/'.$product->image->first()->url) }}"
                                            alt="Product image" class="product-image">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                wishlist</span></a>
                                    </div><!-- End .product-action -->

                                    <div class="product-action action-icon-top">
                                        <button href="#"
                                        wire:click="$emit('addProduct' , {{ $product->id }})"
                                        class="btn-product btn-cart"><span>add to cart</span></button>
                                        
                                        {{-- <a href="popup/quickView.html" class="btn-product btn-quickview"
                                            title="Quick view"><span>quick view</span></a>
                                        <a href="#" class="btn-product btn-compare"
                                            title="Compare"><span>compare</span></a> --}}
                                    </div><!-- End .product-action -->


                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">Furniture</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.html">{{ $product->name }}</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        @if (empty($product->offer_price))

                                        <span class="new-price">TK{{ $product->main_price }}</span>

                                        @else

                                        <span class="new-price">TK{{ $product->main_price }}</span>
                                        <span class="old-price">Was TK{{ $product->offer_price  }}</span>
                                        @endif
                                    </div><!-- End .product-price -->
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 100%;"></div>
                                            <!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <span class="ratings-text">( 2 Reviews )</span>
                                    </div><!-- End .rating-container -->
                                     <div class="product-details-quantity">
                                                    <input type="number" id="quentity{{ $product->id }}"
                                                        class="form-control" value="1" min="1" max="10" step="1"
                                                        data-decimals="0" required>
                                                </div><!-- End .product-details-quantity -->
                                </div><!-- End .product-body -->
                            </div>
                        </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->

                        @endforeach


                    </div><!-- End .row -->
 
                    <div class="load-more-container text-center">
                        <a href="#" class="btn btn-outline-darker btn-load-more">More Products <i
                                class="icon-refresh"></i></a>
                    </div><!-- End .load-more-container -->
                </div><!-- End .products -->

            </div><!-- End .container -->
        </div>
    </main>

    
</div>

@push('scripts')
<script>

    window.livewire.on('addToCartToastMessage', (param) => {
    toastr[param['type']](param['message'],param['type']);
  
});

 window.livewire.on('cartOverload', (param) => {
    toastr[param['type']](param['message'],param['type']);
  
});
    window.livewire.on('addProduct', id => {
        let quentity = parseInt(document.getElementById('quentity' + id).value);
        quentity > 0 ? window.livewire.emit('add', id, quentity) :
            window.livewire.emit('add', id, 1)
    });

</script>


@endpush

