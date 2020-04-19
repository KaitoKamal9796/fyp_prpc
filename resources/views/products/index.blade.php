@extends('layouts.app')


@section('content')

<div class="d-flex justify-content-end mb-2">

    <a href="{{ route('products.create') }}" class="btn btn-success">Add Product</a>

</div>

<div class="card card-default">

    <div class="card-header">Posts</div>
    
        <div class="card-body">

            @if($products->count() > 0)

            <table class="table">
            
                <thead>
                
                <th>Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th></th>
                <th></th>
                
                </thead>

                <tbody>
                
                    @foreach($products as $product)

                    <tr>
                    
                    <td>
                    
                        <img src="{{ asset('storage/'.$product->image) }}" width="120px" height="60px" alt="">
                    
                    </td>

                    <td>
                    
                        {{ $product-> product_name }}
                    
                    </td>

                    <td>
                    
                        {{ $product-> price }}
                    
                    </td>

                    <td>
                    
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm">Edit</a>
        
                    </td>

                    <td>
                    
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"> <!-- products/{product} - products.destroy means {{ route('products.destroy', $product->id) }}"  -->
                        
                        @csrf

                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">
                        
                            Delete
                        
                        </button>
                        
                        </form>
                    
                    </td>
                    
                    </tr>

                    @endforeach
                
                </tbody>
            
            
            </table>
    
            @else

                <h3 class="text-center">No Products Yet</h3>

            @endif
        
        
        </div>


</div>

@endsection