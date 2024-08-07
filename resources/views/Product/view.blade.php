@extends('layouts.admin')
@section('content') 

<div class="p-4 sm:ml-64">
    <h1 class="text-2xl font-bold mb-6">Products</h1>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Actual Price</th>
                    <th>Slug</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach($products as $product)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $i++ }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->product_name }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->price }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->actual_price }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->slug }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->title }}</td>
                        <td class="py-2 px-4 border-b"> <a href="{{ route('admin.productEdit', ['id' => $product->id]) }}">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $products->links() }}
        </div>

</div>
@endsection