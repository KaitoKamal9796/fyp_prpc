@extends('layouts.app')

@section('content')

<div class="card card-default">

    <div class="card-header">
    
        {{ isset($tag) ? 'Edit tag' : 'Create tag'}} <!--if it is set tag then it will say edit tag else it will say create tag -->

    </div>

        <div class="card-body">

            @include('partials.errors')
        
            <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}" method="POST"> <!-- -->

                @csrf <!--must be put for laravel so it can validate it -->

                @if(isset($tag))

                    @method('PUT') <!--if want to make a delete or put or patch request you have to add this method coz form only receive post and get --> 

                @endif

                <div class="form-group">

                    <label for="name">Name</label>
                
                    <input type="text" id="name" class="form-control" name="name" value="{{ isset($tag) ? $tag->name : '' }}"> <!--if value of the tag is available then use the tag name as input else use empty string --> 
                
                </div>

                <div class="form-group">
                
                    <button class="btn btn-success">
                    
                        {{ isset($tag) ? 'Update tag' : ' Add tag' }}
                    
                    
                    </button>

                </div>
            
            </form>
        
        </div>

</div>


@endsection