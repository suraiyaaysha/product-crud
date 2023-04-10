@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center mt-5">
            <div class="col-md-10">
                <div>
                    <h1 class="float-start">Product</h1>
                    <a href="products/create" class="float-end btn btn-success">New Product</a>
                </div>

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $counter = 1 @endphp
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $counter }}</td>
                            <td><a href="products/{{ $product->id }}/show" class="text-dark">{{ $product->name }}</a></td>
                            <td>{{ $product->description }}</td>
                            <td>
                                <img src="products/{{ $product->image }}" alt="" class="rounded-circle" width="50" height="50">
                            </td>
                            <td>
                                <div class="d-inline-flex">
                                    <a href="products/{{ $product->id }}/edit" class="btn btn-dark btn-sm me-2">Edit</a>
                                    {{-- <a href="products/{{ $product->id }}/delete" class="btn btn-danger btn-sm">Delete</a> --}}

                                    <form action="products/{{ $product->id }}/delete" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                        onclick = "return confirm('Are you sure you want to delete this product?')"
                                        >
                                        Delete
                                        </button>
                                    </form>
                                </div>

                            </td>
                        </tr>

                        @php $counter++ @endphp

                        @endforeach
                    </tbody>
                </table>

                {{ $products->links() }}
            </div>
        </div>

    </div>

@endsection
