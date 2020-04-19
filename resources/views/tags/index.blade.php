@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-2"> <!--mb is margin bottom -->

    <a href="{{ route('tags.create') }}" class="btn btn-success float-right">Add tag</a>


</div>

<div class="card card-default">

    <div class="card-header">Tags</div>

    <div class="card-body">

        @if($tags->count() > 0)

        <table class="table">
        
            <thead>

                <th>Name</th>
                <th>Posts Count</th>
                <th></th>

            </thead>

            <tbody>

                @foreach($tags as $tag) <!--for each of the tag -->

                    <tr> <!--display table row -->
                        <td>
                        
                            {{ $tag->name}}
                        
                        </td>

                        <td>
                        
                            {{ $tag->posts->count() }}

                        </td>

                        <td>

                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-info btn-sm">
                            
                                Edit
                            
                            </a>

                            <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $tag->id }})">Delete</button> <!--everytime the button is been clicked handleDelete will be called-->

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            
            <div class="modal-dialog" role="document">

                <form action="" method="POST" id="deletetagForm"> <!--form action has to be empty as to generate it dynamically on the tag that need to be deleted -->

                @csrf

                @method('DELETE') <!-- it is laravel method delete and not POST coz method in form only received POST and GET  -->

                <div class="modal-content">
                   
                   <div class="modal-header">
                       
                       <h5 class="modal-title" id="deleteModalLabel">Delete tag</h5>
                       
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           
                           <span aria-hidden="true">&times;</span>
                       
                       </button>
                       
                       </div>
       
                       <div class="modal-body">

                        <p class="text-center text-bold">
                        
                            Are you sure you want to delete this tag ?

                        </p>
       
                       </div>

                       <div class="modal-footer">
                           
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                           
                           <button type="submit" class="btn btn-danger">Yes, Delete</button>
     
                   </div>

               </div>

                </form>
                 
            </div>

        </div>

        @else

            <h3 class="text-center">No Tag Yet</h3>

        @endif

    
    </div>

</div>


@endsection

@section('scripts')

    <script>

        function handleDelete(id){ //define the function which is handleDelete(id)

            var form = document.getElementById('deletetagForm') //find the form with the id & update it action

            form.action = '/tags/' + id

            $('#deleteModal').modal('show')  // find the modal and show it

        }   

    </script>


@endsection