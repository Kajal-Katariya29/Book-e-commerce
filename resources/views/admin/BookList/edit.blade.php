@extends('admin.app')

@section('title')
    Edit Books
@endsection

@section('body')
<div class="container-fluid m-5">
    <h1 class="mt-4"> Edit BookDetail </h1>
</div>
<div class="row m-5">
    {!! Form::model($bookData, ['route' => ['books.update', $bookData->book_id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data']) !!}
    {!! Form::token() !!}
        @include('admin.BookList.form')
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')

<script>

    $(document).ready(function(){

        $('.deleteImage').on('click',function(){
        var ImageId = $(this).data('image-id');
        var routeUrl = "/delete-image/" + ImageId;
        console.log(routeUrl);

            $.ajax({
                url: routeUrl,
                type: "POST",
                data: {
                    image_id: ImageId,
                    method: "DELETE",
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus);
                }
            });

        });

    });

</script>
@endsection
