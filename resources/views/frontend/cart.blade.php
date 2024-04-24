@extends('frontend.master')
@section('main')
    </div>
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
                                @php $total = 0 @endphp
                                @if (session('cart'))
                                    @foreach (session('cart') as $MaSP => $product)
                                        @php $total += $product['Gia'] * $product['quantity'] @endphp
                                        <tr data-id="{{ $MaSP }}">
                                            <td data-th="Product" class="shoping__cart__item">
                                                <img src="{{ asset('images') }}/{{ Arr::first(json_decode($product['AnhSP'], true)) }}"
                                                    width="100" height="100" class="img-responsive" />
                                                <h5>{{ $product['TenSP'] }}</h5>
                                            </td>
                                            <td data-th="Gia" class="shoping__cart__price">
                                                {{ number_format($product['Gia'], 0, '', ',') }}₫
                                            </td>

                                            <td data-th="Quantity" class="shoping__cart__quantity quantity ">
                                                <div class="style">
                                                    <input type="number" value="{{ $product['quantity'] }}"
                                                        class=" quantity cart_update" min="1" />
                                                </div>
                                            </td>

                                            <td data-th="Subtotal" class="shoping__cart__total">
                                                {{ number_format($product['Gia'] * $product['quantity'], 0, '', ',') }}₫
                                            </td>
                                            <td class="actions" data-th="" class="shoping__cart__item__close">
                                                <button class="btn btn-danger btn-sm cart_remove"><i
                                                        class="fa-solid fa-xmark"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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
                            <li>Total <span>{{ number_format($total, 0, '', ',') }}₫</span></li>
                        </ul>
                        
                        <form action="{{ route('payment') }}" method="POST">
                            @csrf
                            <input name="total" value="{{ number_format($total, 0, '', ',')}}"  type="hidden">
                            <button name="redirect" type="submit" class="primary-btn">PLACE ORDER</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .style {
            width: 140px;
            height: 50px;
            display: inline-block;
            position: relative;
            text-align: center;
            background: #f5f5f5;
            margin-bottom: 5px;
        }

        .style input {
            height: 100%;
            width: 100%;
            font-size: 16px;
            color: #6f6f6f;
            width: 100px;
            border: none;
            background: #f5f5f5;
            text-align: center;
        }
    </style>
    <!-- Shoping Cart Section End -->
@endsection

@section('customjs')
    <script>
        $(".cart_update").change(function(e) {
            e.preventDefault();
            var ele = $(this);
            var quantity = ele.val();

            $.ajax({
                url: '{{ route('update_cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    MaSP: ele.parents("tr").attr("data-id"),
                    quantity: quantity
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $(".cart_remove").click(function(e) {
            e.preventDefault();
            var ele = $(this);
            if (confirm("Do you really want to remove?")) {
                $.ajax({
                    url: '{{ route('remove_from_cart') }}',
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        MaSP: ele.parents("tr").attr("data-id")
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });
    </script>
@endsection
