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
                    <div class="card-header">Insert Cook Recipe</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cook.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="project_name" class="col-md-3 col-form-label text-md-right">Cook Recipe Name</label>
                                <div class="col-md-9">
                                    <input id="name" type="text" name="name" value="" required="required" autofocus="autofocus" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="project_name" class="col-md-3 col-form-label text-md-right ">Select Category</label>
                                <div class="col-md-9">
                                    <select class="form-control js-example-basic-single" name="category_id">
                                        @foreach($category as $u)
                                            <option value="{{ $u->id }}"> {{ $u->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="project_name" class="col-md-3 col-form-label text-md-right">Select Ingredient</label>
                                <div class="col-md-3">
                                    <select class="form-control" name="ingredient_id[]">
                                        @foreach($ingredient as $u)
                                            <option value="{{ $u->id }}"> {{ $u->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input id="name" placeholder="additional information" type="text" name="information[]" value="" required="required" autofocus="autofocus" class="form-control" />
                                </div>
                            </div>

                            <div id="dynamic_field">

                            </div>

                            <div class="form-group row">
                                <label for="project_name" class="col-md-3 col-form-label text-md-right">Created by</label>
                                <div class="col-md-9">
                                    <input id="name" type="text" name="created_by" value="" required="required" autofocus="autofocus" class="form-control" />
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('cook.index') }}",
                columns: [

                    {data: 'name', name: 'name'},
                    {data: 'category', name: 'category'},
                    {data: 'created_by', name: 'created_by'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script>
        var i=1;


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
