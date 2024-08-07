@extends('layouts.admin')
@section('content') 

<div class="p-4 sm:ml-64">
  @if(session('success'))
<div style="color: green;">
    {{ session('success') }}
</div>
@endif
    <form class="w-full" action="{{route('admin.productSubmit')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
              Product Name
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" required type="text" placeholder="Product Name" name="product_name">
            {{-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> --}}
          </div>
          <div class="w-full md:w-1/4 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name" name="price">
              Price
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" required type="text" placeholder="Price" name="price">
          </div>
          <div class="w-full md:w-1/4 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
              Actual Price
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" required name="actual_price" type="text" placeholder="Actual Price">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Slug
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" required placeholder="slug" name="slug">
            <p class="text-gray-600 text-xs italic">Make it SEO Friendly</p>
          </div>
          <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
              Title
            </label>
            <div class="relative">
              <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" name="title" required>
                <option value="Best Deal">Best Deal</option>
                <option value="Best Seller">Best Seller</option>
                <option value="More Option">More Option</option>
                <option value="">No title</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
              </div>
            </div>
          </div>
          <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state" >
              Tags(Seperated by comman)
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="tags" name="tags"required  type="text" placeholder="Tags">
        </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label for="image" class="block text-sm font-medium text-gray-700">Upload an Image(Main Image)</label>
            <input type="file" required name="image" id="image" class="mt-1 block w-full" accept="image/*" onchange="previewSingleImage(event)">
            <div class="mt-2">
                <img id="single-image-preview" class="hidden w-32 h-32 object-cover">
            </div>
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label for="images" class="block text-sm font-medium text-gray-700">Gallery</label>
                <input type="file" required name="images[]" id="images" class="mt-1 block w-full" accept="image/*" multiple onchange="previewMultipleImages(event)">
                <div class="mt-2 grid grid-cols-3 gap-2" id="multiple-images-preview"></div>
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label for="video" class="block text-sm font-medium text-gray-700">Upload a Video</label>
                <input type="file" required name="video" id="video" class="mt-1 block w-full" accept="video/*" onchange="previewVideo(event)">
                <div class="mt-2">
                    <video id="video-preview" class="hidden w-64 h-36" controls></video>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                Product Overview
              </label>
            @include('components.c-k-editor', ['name' => 'product_overview', 'id' => 'product_overview', 'slot' => old('content')])
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                  Product Description
                </label>
              @include('components.c-k-editor', ['name' => 'product_desc', 'id' => 'product_desc', 'slot' => old('content')])
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                Instructions
                </label>
              @include('components.c-k-editor', ['name' => 'instruction', 'id' => 'instruction', 'slot' => old('content')])
              </div>

              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                Delivery and Installation
                </label>
              @include('components.c-k-editor', ['name' => 'delivery_and_installation', 'id' => 'delivery_and_installation', 'slot' => old('content')])
              </div>
          </div>

          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
              Warranty
              </label>
            @include('components.c-k-editor', ['name' => 'warranty', 'id' => 'warranty', 'slot' => old('content')])
            </div>

            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
              FAQ's
              </label>
            @include('components.c-k-editor', ['name' => 'faqs', 'id' => 'faqs', 'slot' => old('content')])
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
            Disclaimer
            </label>
          @include('components.c-k-editor', ['name' => 'disclaimer', 'id' => 'disclaimer', 'slot' => old('content')])
          </div>

          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
            Terms & Condition
            </label>
          @include('components.c-k-editor', ['name' => 'terms_condtion', 'id' => 'terms_condtion', 'slot' => old('content')])
          </div>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Submit
            </button>
        </div>
      </form>
</div>
<script>
    function previewSingleImage(event) {
        const image = document.getElementById('single-image-preview');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.classList.remove('hidden');
    }

    function previewMultipleImages(event) {
        const previewContainer = document.getElementById('multiple-images-preview');
        previewContainer.innerHTML = '';
        Array.from(event.target.files).forEach(file => {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.classList.add('w-32', 'h-32', 'object-cover');
            previewContainer.appendChild(img);
        });
    }

    function previewVideo(event) {
        const video = document.getElementById('video-preview');
        video.src = URL.createObjectURL(event.target.files[0]);
        video.classList.remove('hidden');
    }
</script>
<style>
    .ck-editor__editable ol{
        padding:10px;
    }
</style>
@endsection