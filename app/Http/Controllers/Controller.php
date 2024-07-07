<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function showProducts_list() {
        $productModel = new Product();
        $data = $productModel->getProducts_list();

        return view('products_list', $data);
    }
    public function showProducts_search(Request $request){
        $searchbox = $request->input('searchbox');
        $selectbox = $request->input('selectbox');

        $productModel = new Product();
        $data = $productModel->getProducts_search($searchbox, $selectbox, $request);

        return view('products_list', $data);
    }
    
    public function showProducts_registration() {
        $companies = Company::all();
        

        return view('products_registration', compact('companies'));
    }

    public function showProducts_detail($id) {
        $products = Product::all();
        $product = Product::find($id);
        $company = Company::find($product->company_id);
        $sale = Sale::where('product_id', $id)->get();

        return view('products_detail', compact('products','product', 'company', 'sale'));
    }
    
    public function showProducts_edit($id){
        $product = Product::find($id);
        $companies = Company::all();
        return view('products_update',compact('product','companies'));
    }

    public function showProducts_delete($id) {
        try{
            $product = Product::findOrFail($id);
            $rowCount = $product->rowCount;
            $product->delete();
            $sale = Sale::where('product_id',$id)->first();
            if($sale){
                $sale->delete();
            }

            return redirect()->route('products_list');
        }catch(ValidationException $e){
            return back()->withErrors($e->valedator)->withInput();
        }
    }

    public function showProducts_registrations(Request $request) {
        $rules = [
            'product_name' => 'required',
            'company_name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ];
        $validatedData = $request->validate($rules);
        try{
            $product = new Product;
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;
            $product->img_path = $request->img_path;
            $product->company_id = $request->company_name;
        
            $product->save();
        
            return redirect()->route('products_list');
        }catch(ValidationException $e){
            return back()->withErrors($e->valedator)->withInput();
        }
    }

    public function showProducts_update(Request $request,$id) {
        $product = Product::findOrFail($id);
        if($request->hasFile('image')){
            $filename = uniqid().'.'.$request->image->extension();
            $request->image->storeAs('public/images',$filename);
            $product->img_path = 'storage/images/'.$filename;
        }
        $company = Company::find($product->company_id);
        $sale = Sale::where('product_id', $id)->get();
        $companies = Company::all();
        try{
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;
            $product->company_id = $request->company_name;
            if ($request->has('company_id')) {
                $product->company_id = $request->company_id;
            }
        
            $product->save();

            return redirect()->route('products_list');
        }catch(ValidationException $e){
            return back()->withErrors($e->valedator)->withInput()->with('companies',$companies);
        }
    }
    
    

    public function showUsers_login() {
        return view('users_login');
    }

    public function showusers_registration(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        Auth::login($user);
    
        return redirect()->route('users_login');
    }

    

    
}


