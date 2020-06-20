@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header">Cook Recipe</div>
                    <div class="card-body">
                        <h5 class="card-title">See All Cook Recipe Here</h5>
                        <a href="{{ route('cook.index') }}" class="btn btn-primary">
                            See Cook
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header">Category</div>
                    <div class="card-body">
                        <h5 class="card-title">See All Category Here</h5>
                        <a href="{{ route('category.index') }}" class="btn btn-primary">
                            See Menu
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header">Ingredient</div>
                    <div class="card-body">
                        <h5 class="card-title">See All Ingredient</h5>
                        <a href="{{ route('ingredient.index') }}" class="btn btn-primary">
                            See Ingredient
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <br>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header">API</div>
                    <div class="card-body">
                        <h5 class="card-title">Cook Recipe API Here</h5>
                        <a href="{{ route('cook.api') }}" class="btn btn-primary">
                            See Cook Recipe API
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header">API</div>
                    <div class="card-body">
                        <h5 class="card-title">Category API Here</h5>
                        <a href="{{ route('category.api') }}" class="btn btn-primary">
                            See Category API
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
