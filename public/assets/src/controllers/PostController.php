<?php

namespace App\Http\Controllers;

use App;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\HyperPay;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    use HyperPay, App\Traits\UploadTrait;
    public function index()
    {
        $products = Product::all();
        Cache ::put('key', 'value' , 15);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['image'] = $this->uploadOne($request->image, 'products');
        dd($data);
        Product::create($request->all());

        return redirect()->route('products.index')->withSuccess('Added successfully');
    }

    public function show(Product $product)
    {
        if (\request()->has('resourcePath')) {
            dd($this->getStatus(\request()->input('id'), \request()->input('resourcePath')));
        }
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }

    public function generateBarcode(Product $product)
    {

        return view('products.barcode', compact('product'));
    }

    public function showDescription(Product $product)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($product->description);
        return $pdf->stream();
    }

    public function buy(Product $product)
    {
        $response = $this->checkout($product);

        $code = $response['result']['code'];
        $checkoutId = $response['id'];
        $view = view('products.payment-form')->with(['response' => $response, 'id' => $product->id])
            ->renderSections();

        return response()->json([
            'status' => true,
            'form' => $view['form'],
            'data' => $response
        ]);
    }


}
