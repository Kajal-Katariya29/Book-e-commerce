@extends('admin.app')

@section('title')
    Home Page
@endsection

@section('body')
    @include('front.HomePage.navbaar')

<div class="container pt-5">
    @foreach ($bookData as $book)
        <div class="row border-bottom">
            <div class="col-md-3 pt-5">
                <img src="{{ asset('images/Book-Images/' . $book->bookMedia[0]->book_id . '/' . $book->bookMedia[0]->media_name) }}" alt="" width="150" height="150">
            </div>
            <div class="col-md-9">
                <div class="d-flex flex-column bd-highlight mb-3">
                    <div class="p-2 bd-highlight fs-4">
                        <a href="{{ route('view.bookDetail',$book->book_id) }}" class="text-decoration-none text-black"> {{ $book->name }} </a>
                    </div>
                    <div class="p-2 bd-highlight fs-5">
                        @if (strlen($book->description) > 150)
                            @php
                                $dec = $book->description;
                                $decription = substr($dec, 0, 150);
                            @endphp
                            {{ $decription }}...
                        @else
                            {{ $dec = $book->description }}
                        @endif
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
                                        Language: {{ $variant->variant_type_name }}
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="p-2 bd-highlight fs-5">
                        Book Price :
                        <span class="price_{{ $book->book_id }}">
                            {{$book->price}}
                        </span>
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
            $('#showContent').on("click",function(){
                console.log("here");
                var variant_id = $(this).attr('data-variantId');
                if(variant_id == 2){
                    $('#languageContainer').css('display','block');
                }
            });

            $(".bookPrice").on("click", function() {
                var book_id = $(this).attr('data-book-id');
                var book_price = $(this).attr('data-book-price');
                $('.price_'+book_id).text(book_price);
            });
        });
    </script>

@endsection
