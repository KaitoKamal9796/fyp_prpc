@extends('layouts.app')


@section('content')

<div class="card card-default">

    <div class="card-header">
    
        {{ isset($product) ? 'Edit Product': 'Create Product' }}
    
    </div>

    <div class="card-body">

    @include('partials.errors')
    
        <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data">
        
            @csrf

            @if(isset($product))

                @method('PUT')

            @endif

            <div class="form-group">
            
                <label for="title">Product Name</label>

                <input type="text" class="form-control" name="product_name" id="product_name" value="{{ isset($product) ? $product->product_name: '' }}">
            
            </div>

            <div class="form-group">
            
                <label for="description">Description</label>

                <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ isset($product) ? $product->description : '' }}</textarea>
        
            </div>

            <div class="form-group">

                <label for="image">Price</label>

                <input type="number" name="price" class="form-control" value="{{ isset($product) ? $product->price: '' }}">
                        
            </div>

            <div class="form-group">
            
            <label for="published_at1">Published_at</label>

            <input type="text" class="form-control" name="published_at1" id="published_at1" value="{{ isset($product) ? $product->published_at1: '' }}">
    
        </div>

            
            @if(isset($product))

             <div class="form-group">

                <img src="{{ asset('storage/'.$product->image) }}" alt="" style="width:50%">
        
            </div>


            <div class="form-group">
            
                <label for="image">Image</label>

                <input type="file" class="form-control" name="image" id="image">            
            
            </div>

            @endif

            <div class="form-group">
            
                <button type="submit" class="btn btn-success">
                
                    {{ isset($product) ? 'Update Product' : 'Create Product'}}
                
                </button>
            
            </div>
        
        </form>
    
    </div>

</div>

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    
    <script>

        flatpickr('#published_at1', {

            enableTime : true, // enable time 
            enableSeconds: true //enable seconds bcoz in laravel it shown 12:00:00

        })

        $(document).ready(function() {
            $('.tags-selector').select2();
        })

    </script>


@endsection

@section('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    
        
@endsection
