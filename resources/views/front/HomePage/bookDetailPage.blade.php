@extends('admin.app')

@section('titile')
    Book Detail Page
@endsection

@section('body')
    @include('front.HomePage.navbaar')

    <div class="container pt-5">
        @foreach ($bookData as $book)
        <div class="row">
            <div class="col-md-3 pt-5" id="bookImage">
                <img src="{{ asset('images/Book-Images/' . $book->bookMedia[0]->book_id . '/' . $book->bookMedia[0]->media_name) }}" alt="" width="200" height="350">
            </div>
            <input type="hidden" value="{{ Auth::user()->user_id }}" name="userId" class="userId">
            <div class="col-md-9">
                <div class="d-flex flex-column bd-highlight mb-3">
                    <input type="hidden" value="{{ $book->book_id }}" name="bookId" class="bookId">
                    <input type="hidden" value="1" name="quantity" class="quantity">
                    <div class="p-2 bd-highlight fs-4">
                        <a href="" class="text-decoration-none text-black bookName"> {{ $book->name }} </a>
                    </div>
                    <div class="p-2 bd-highlight fs-5">
                        {{ $book->description }}
                    </div>
                    <div class="p-2 bd-highlight fs-5">
                        Book Author : {{$book->author}}
                    </div>
                    <div class="p-2 bd-highlight fs-5">
                        <div class="d-flex flex-row bd-highlight">
                            @foreach ($book->variants as $variant)
                            <div class="bd-highlight pe-4">
                                <a class="d-flex flex-column bd-highlight mb-3 border p-2 btn border-black bookPrice" data-book-price="{{ $variant->pivot->book_price }}" data-book-id="{{ $book->book_id}}">
                                    <div class="p-2 bd-highlight">
                                        Language:
                                        <p value={{ $variant->variant_type_id }}> {{ $variant->variant_type_name }} </p>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="p-2 bd-highlight fs-5">
                        Book Price :
                        <span class="price_{{ $book->book_id }}" id="bookPrice">
                            {{$book->price}}
                        </span>
                    </div>
                    <div class="p-2 bd-highlight fs-5">
                        <button class="btn btn-warning px-5 addToCart" id="addToCart"> Add to Cart </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
        $(".bookPrice").on("click", function() {
            var book_id = $(this).attr('data-book-id');
            $(".bookPrice.clicked").removeClass("clicked");
            $(this).addClass("clicked");
            var book_price = $(this).attr('data-book-price');
            $('.price_'+book_id).text(book_price);
        });

        $('.addToCart').on("click",function(){
            var book_id = $('.bookId').val();
            console.log(book_id);
            var quantity = $('.quantity').val();
            console.log(quantity);

            var book_price = $('#bookPrice').text();
            console.log(book_price);

            var variant_type_id = $('.clicked').find('p').attr('value');
            console.log(variant_type_id);

            var user_id = $('.userId').val();
            console.log(user_id);


            $.ajax({
                url: "{{ route('cart.store') }}",
                type: "POST",
                data: {
                    book_id: book_id,
                    quantity : quantity,
                    book_price: book_price,
                    variant_type_id: variant_type_id,
                    user_id: user_id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log("hello");
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus);
                }
            });
        });
    });
    </script>
@endsection





