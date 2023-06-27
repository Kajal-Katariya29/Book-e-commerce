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
                        {{ $book->name }}
                    </div>
                    <div class="p-2 bd-highlight fs-5">
                        {{$book->description}}
                    </div>
                    <div class="p-2 bd-highlight fs-5">
                        Book Author : {{$book->author}}
                    </div>
                    <div class="p-2 bd-highlight fs-5">
                        <div class="d-flex flex-row bd-highlight mb-3">
                            @foreach ($book->variants as $variant)
                                <div class="bd-highlight pe-4">
                                    <div class="d-flex flex-column bd-highlight mb-3 border p-2" data-variantId="{{$variant->variant_type_id}}" id="showContent" style="cursor: pointer;">
                                        <div class="p-2 bd-highlight">
                                            Language :{{ $variant->variant_type_id }}
                                        </div>
                                        <div class="p-2 bd-highlight">
                                           Price : {{ $variant->book_price }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="p-2 bd-highlight fs-5">
                        <div id="languageContainer" style="display: none;">
                            n publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or
                            a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is avail
                        </div>
                    </div>
                    <div class="p-2 bd-highlight fs-5">
                        <div id="hindiContainer">

                        </div>
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
        });
    </script>
@endsection
