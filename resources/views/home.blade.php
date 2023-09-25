<x-layout>
    <x-slot:title>Home</x-slot:title>
    <h1>Home</h1>

    @if( $cart && $countOrder > 0)
        <a href="{{ route('home.products.show.cart') }}">
            <span id="js_cart">CART ({{ $countOrder }})</span>
        </a>
        <br>
        <a href="{{ route('home.products.clear.cart') }}">
            <span>Clear cart</span>
        </a>
    @endif

    @if(isset($info))
        <div style="color: red;">{{ $info }}</div>
    @endif

    <div class="container text-center">
        <div class="row row-cols-6">

            @foreach($products as $product)
                <div class="col">
                    @if( isset($product->image))
                        <td><img src="{{ asset('storage/' . $product->image) }}" alt="Изображение" width="150" height="150"></td>
                    @else
                        <td><br><br>No image</td><br><br><br><br>
                    @endif
                        <p>ID: {{ $product->id }}</p>
                        <p>Name: {{ $product->name }}</p>
                        <p>Brand: {{ $product->brand }}</p>
                        <p>Price: {{ $product->price }}</p>
                        <p>Currency: {{ $product->currency }}</p>
                        <p>Status: {{ $product->status }}</p>

{{--                        <a class="addToCart" href="{{ route('home.products.addToCart', ['productId' => $product->id]) }}">Add to cart</a>--}}
                        <button type="button" data-route="{{ route('home.products.addToCart', ['productId' => $product->id]) }}" class="js_addToCart btn btn-primary">Added to cart</button>
                </div>
            @endforeach

        </div>
    </div>
    <div>
        {{ $products->links() }}
    </div>

    <script>
        $(document).ready(function() {
            $('.js_addToCart').click(function() {

                var url = $(this).data('route');

                $.ajax({
                    url: url, // URL маршрута, который вы создали
                    method: 'GET', // Метод запроса (GET, POST и так далее)
                    data: {
                        // Данные, которые вы хотите отправить на сервер
                        // Например, если вы хотите отправить данные формы с id="formId":
                        // data: $('#formId').serialize()
                    },
                    success: function(response) {
                        // Код, который выполняется после успешного выполнения запроса
                        // response - это данные, возвращенные сервером
                        // console.log(response);
                        // Обновляем результат на странице (если необходимо)

                        $('#result').html(response.message);

                        Swal.fire(
                            'Good job!',
                            'You added product to cart!',
                            'success'
                        );

                        // Increase the cart counter by 1
                        var cartValue = parseInt($('#js_cart').text().match(/\d+/)[0]);
                        cartValue++;
                        $('#js_cart').text('CART (' + cartValue + ')');


                    },
                    error: function(xhr, status, error) {
                        // Code that runs when a request fails
                        console.error(error);

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            footer: '<a href="">Why do I have this issue?</a>'
                        });
                    }
                });
            });
        });

    </script>

</x-layout>
