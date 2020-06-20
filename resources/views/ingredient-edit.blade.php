@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-9">
                <div class="card text-center">
                    <div class="card-header">Edit Ingredient</div>
                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf

                            <div class="form-group row">
                                <label for="project_name" class="col-md-3 col-form-label text-md-right">Ingredient Name</label>
                                <div class="col-md-9">
                                    <input id="name" type="text" name="name" value="{{ $ingredient->name }}" required="required" autofocus="autofocus" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 col-form-label text-md-right">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-header">List Ingredient</div>
                    <div class="card-body">
                        <h5 class="card-title">Back to List Ingredient</h5>
                        <a href="{{ route('ingredient.index') }}" class="btn btn-primary">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
