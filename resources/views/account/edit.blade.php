@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('account.list') }}" class="btn btn-dark">Back</a>
        </div>
    </div>
   <div class="row d-flex justify-content-center">
    <div class="col-md-10">
        <div class="card border-0 shadow-lg my-3">
         <div class="card-header bg-dark">
           <h3 class="text-white text-center">Edit Note</h3>
         </div>

       <form enctype="multipart/form-data" action="{{ route('account.update',$notetaking->id) }}" method="post">
        @method('put')
         @csrf
         <div class="card-body">

            <div class="mb-3">
             <label for="" class="form-label h5">Name</label>
             <input value="{{ old('tilte',$notetaking->title) }}" type="text" class="form-control form-control-lg  @error('title') is-invalid @enderror" placeholder="Title" name="title">
             @error('title')
             <p class="invalid-feedback">{{ $message }}</p>
             @enderror
            </div>
           
               <div class="mb-3">
                <label for="" class="form-label h5">Description</label>
                <textarea placeholder="Description" class="form-control form-control-lg @error('description') is-invalid @enderror" value="" name="description"  cols="30" rows="5">{{ old('description',$notetaking->description) }}</textarea>
                @error('description')
               <p class="invalid-feedback">{{ $message }}</p>
             @enderror
             </div>

               <div class="d-grid">
                    <button class="btn btn-lg btn-primary" >Update</button>
               </div>

          </div>
        </div>

       </form>

    </div>
   </div>
</div>
@endsection

