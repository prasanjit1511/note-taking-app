@extends('layouts.app')

@section('main')
<div class="container mt-1">
    <div class="row pt-5">
        @include('message')

        <div class="col-md-12 d-flex justify-content-between align-items-center mb-3">
            <div>
                <a type="button" onclick="window.location.href='{{ route('account.list') }}'" class="btn btn-dark">Reset</a>
            </div>
            <div>
                <a href="{{ route('account.create') }}" class="btn btn-dark">Create</a>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @if ($notetakings->isNotEmpty())
                    @foreach ($notetakings as $notetaking)
                        <div class="col">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">{{ $notetaking->title }}</h3>
                                    <div class="bg-light p-3 border">
                                        <p>{{ Str::words(strip_tags($notetaking->description), 25) }}</p>
                                    </div>
                                    <div class="text-end m-2">
                                        <!-- Edit and Delete Buttons -->
                                        <a href="{{ route('account.edit',$notetaking->id) }}" class="btn btn-dark">Edit</a>
                                        <a href="#" onclick="deleteNote({{ $notetaking->id }})" class="btn btn-danger">Delete</a>
                                        <form id="delete-note-from-{{ $notetaking->id }}" action="{{ route('account.destroy',$notetaking->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-1 text-muted">
                                    <b><small>Created At: <span id="createdAt">{{ \Carbon\Carbon::parse($notetaking->created_at)->format('d M, Y') }}</span></small></b><br>
                                    <b><small>Updated At: <span id="updatedAt">{{ \Carbon\Carbon::parse($notetaking->updated_at)->format('d M, Y') }}</span></small></b>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @else

                    <p>No Notes</p>
                @endif
            </div>
        </div>
    </div>
    <div class="pagination justify-content-center m-5">
        {{ $notetakings->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection

<script>
    function deleteNote(id){
        if(confirm("Are you sure you want to delete this product?")){
            document.getElementById("delete-note-from-"+id).submit();
        }
    }
</script>
