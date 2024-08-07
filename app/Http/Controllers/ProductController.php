<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function add(){
        return view('Product.add');
    }
    public function submit(Request $request){
        $input = $request->all();
        $product = new Product; 

        $product->product_name = $input['product_name'];
        $product->price = $input['price'];
        $product->actual_price = $input['actual_price'];
        $product->slug = $input['slug'];
        $product->title = $input['title'];
        $product->tags = $input['tags'];
        $product->product_overview = serialize($input['product_overview']);
        $product->product_desc = serialize($input['product_desc']);
        $product->instruction = serialize($input['instruction']);
        $product->delivery_and_installation = serialize($input['delivery_and_installation']);
        $product->warranty = serialize($input['warranty']);
        $product->faqs = serialize($input['faqs']);
        $product->disclaimer = serialize($input['disclaimer']);
        $product->terms_condtion = serialize($input['terms_condtion']);
        $product_name = $input['product_name']; 
        if ($request->hasFile("image")) {
            $banner_image = $request->file('image');
            $filename = 'banner'. $banner_image->getClientOriginalName();
            $path = $banner_image->storeAs('public/images/product/'.$product_name.'/banner', $filename);
            $product->image = $filename;
        }
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $product_name = $request->input('product_name');
            $gallery = array();
              foreach ($images as $image) {
                $filename = 'gallery' . $image->getClientOriginalName();
                $path = $image->storeAs('public/images/product/' . $product_name . '/gallery', $filename);
                array_push($gallery,$filename);
            }
            $product->images = json_encode($gallery);

        }
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $filename = 'video'. $video->getClientOriginalName();
            $path = $video->storeAs('public/images/product/'.$product_name.'/video', $filename);
            $product->video = $filename;
        }
        // dd($product);
        $product->save();
        return redirect()->route('admin.productAdd')->with('success', 'Product added successfully!');

    }
    public function view(){
        $products = Product::paginate(10); // Adjust the number to your needs
        return view('Product.view', compact('products'));
    }
    public function edit(Request $request){
        // $id = $request->id;
        $products = Product::where('id',$request->id)->get();
        dd($products);
    }
}
