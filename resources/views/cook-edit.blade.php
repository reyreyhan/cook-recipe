@extends('layouts.app')

@section('content')

    @if (session()->has('success'))
        <div class="container">
            <div class="row justify-content-center">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-9">
                <div class="card text-center">
                    <div class="card-header">Edit Cook Recipe</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cook.update', $cook->id) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="project_name" class="col-md-3 col-form-label text-md-right">Cook Recipe Name</label>
                                <div class="col-md-9">
                                    <input id="name" type="text" name="name" value="{{ $cook->name }}" required="required" autofocus="autofocus" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="project_name" class="col-md-3 col-form-label text-md-right ">Select Category</label>
                                <div class="col-md-9">
                                    <select class="form-control js-example-basic-single" name="category_id">
                                            <option value="{{ $cook->category->id }}"> {{ $cook->category->name }} </option>
                                        @foreach($category as $u)
                                            <option value="{{ $u->id }}"> {{ $u->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @foreach($cook->cookIngredient as $x)
                                @if ($count != 1)
                                    <div class="form-group row" id="form{{$count}}">
                                @else
                                    <div class="form-group row">
                                @endif
                                    <label for="project_name" class="col-md-3 col-form-label text-md-right">Select Ingredient {{ $count++ }}</label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="ingredient_id[]">
                                            <option value="{{ $x->ingredient->id }}"> {{ $x->ingredient->name }} </option>
                                            @foreach($ingredient as $u)
                                                <option value="{{ $u->id }}"> {{ $u->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input id="name" value="{{ $x->information  }}" placeholder="additional information" type="text" name="information[]" value="" required="required" autofocus="autofocus" class="form-control" />
                                    </div>
                                </div>
                            @endforeach

                            <div id="dynamic_field">

                            </div>

                            <div class="form-group row">
                                <label for="project_name" class="col-md-3 col-form-label text-md-right">Created by</label>
                                <div class="col-md-9">
                                    <input id="name" type="text" name="created_by" value="{{ $cook->created_by }}" required="required" autofocus="autofocus" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 col-form-label text-md-right">
                                    <button type="button" name="add" id="add" class="btn btn-success" >Add More Ingredient</button>
                                    <button type="button" name="remove" id="remove" class="btn btn-danger" >Remove</button>
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-header">Home</div>
                    <div class="card-body">
                        <h5 class="card-title">Back to Home</h5>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>


    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script>
        var i = {{ $count }} - 1

        $('#add').click(function(){
            i++;
            console.log(i)
            $('#dynamic_field').append('' +
            '                            <div class="form-group row" id="form' + i + '">\n' +
            '                                <label for="project_name" class="col-md-3 col-form-label text-md-right">Select Ingredient</label>\n' +
            '                                <div class="col-md-3">\n' +
            '                                    <select class="form-control" name="ingredient_id[]">\n' +
            '                                        @foreach($ingredient as $u)\n' +
            '                                            <option value="{{ $u->id }}"> {{ $u->name }} </option>\n' +
            '                                        @endforeach\n' +
            '                                    </select>\n' +
            '                                </div>\n' +
            '                                <div class="col-md-6">\n' +
            '                                    <input id="name" placeholder="additional information" type="text" name="information[]" value="" required="required" autofocus="autofocus" class="form-control" />\n' +
            '                                </div>\n' +
            '                            </div>' +
            '');
        });

        $('#remove').on('click', function(){
            $('#form' + i + '').remove();
            i--;
            console.log(i)
        });
    </script>
@endsection
