@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div>
                    <h1 class="float-start">Product Details of {{ $product->name }}</h1>
                    <a href="/" class="float-end btn btn-success">Product List</a>
                </div>
            </div>

            <div class="col-md-8 my-3">
                <div class="card p-4">
                    <p>Name: <b>{{ $product->name }}</b></p>
                    <p>Description: <b>{{ $product->description }}</b></p>
                    <img src="/products/{{ $product->image }}" alt="" class="rounded img-fluid">
                </div>
            </div>

        </div>

    </div>

@endsection
