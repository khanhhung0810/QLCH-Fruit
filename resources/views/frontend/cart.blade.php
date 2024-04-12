@extends('frontend.master')
@section('main')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('site/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('shop') }}">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    @foreach ($cart as $MaSP => $product)
                                        <tr>
                                            <td class="shoping__cart__item">
                                               
                                                <img src="{{ asset('images') }}/{{ Arr::first(json_decode($product['AnhSP'], true)) }}" width="100" height="100" class="img-responsive"/>  
                                                {{-- <div data-setbg="{{ url('images/' . Arr::first($productImages))  }}"></div> --}}
                                                {{-- <img src="{{ url('images/' . $product->AnhSP) }}" alt=""> --}}
                                                {{-- @dd($product['AnhSP']); --}}
                                                <h5>{{ $product['TenSP'] }}</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                ${{ $product['Gia'] }}
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" value="{{ $product['quantity'] }}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                ${{ $product['Gia'] * $product['quantity'] }}
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <button class="btn btn-danger btn-sm cart_remove"><i
                                                        class="fa-solid fa-xmark"></i></button>
                                                {{-- <span class="icon_close"></span> --}}
                                        </tr>
                                    @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="shoping__cart__btns">
                        <a href="{{ url('shop') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>$</span></li>
                            <li>Total <span>$</span></li>
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection

@section('customjs')
    <script>
        $(".shoping__cart__item__close").click(function(e) {
            e.preventDefault();

            var ele = $(this);

            if (confirm("Do you really want to remove?")) {
                $.ajax({
                    url: '{{ route('remove_from_cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endsection
