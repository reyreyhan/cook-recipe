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
                    <div class="card-header">Insert Category</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="project_name" class="col-md-3 col-form-label text-md-right">Category Name</label>
                                <div class="col-md-9">
                                    <input id="name" type="text" name="name" value="" required="required" autofocus="autofocus" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 col-form-label text-md-right">
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
                ajax: "{{ route('category.index') }}",
                columns: [

                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection
