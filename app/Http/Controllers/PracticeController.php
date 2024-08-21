<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;


class PracticeController extends Controller
{
    public function index(){
        return view('home');
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

    public function showProducts_list() {
        $productModel = new Product();
        $data = $productModel->getProducts_list();

        return view('products_list', $data);
    }

    public function showProducts_search(Request $request){
        $searchbox = $request->input('searchbox');
        $selectbox = $request->input('selectbox');
        $priceMin = $request->input('priceMin');
        $priceMax = $request->input('priceMax');
        $stockMin = $request->input('stockMin');
        $stockMax = $request->input('stockMax');

        $productModel = new Product();
        $data = $productModel->getProducts_search($searchbox, $selectbox, $priceMin, $priceMax, $stockMin, $stockMax);

        if ($request->ajax()) {
            return response()->json(['data' => view('products_list', $data)->render()]);
        } else {
            $companies = Company::select('id', 'company_name')->get();
            $products = DB::table('products')
            ->join('companies', 'company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')
            ->get();
            return view('products_list', compact('data', 'companies','products'));
        }
    }
    
    public function showProducts_registration() {
        $companies = Company::select('id','company_name')->get();

        return view('products_registration', compact('companies'));
    }

    public function showProducts_registrations(ProductRequest $request) {
        try{
            $validatedData = $request->validated();

            $product = new Product;
            $product->product_name = $validatedData['product_name'];
            $product->price = $validatedData['price'];
            $product->stock = $validatedData['stock'];
            $product->comment = $request->comment;
            $product->company_id = $validatedData['company_id'];
            if($request->hasFile('image')){
                $filename = uniqid().'.'.$request->image->extension();
                $request->image->storeAs('public/images',$filename);
                $product->img_path = 'storage/images/'.$filename;
            }
        
            $product->save();
        
            return redirect()->route('products_list');
        }catch(ValidationException $e){
            return back()->withErrors($e->valedator)->withInput();
        }
    }

    public function showProducts_delete($id) {
        try{
            $product = Product::findOrFail($id);
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

    public function showProducts_detail($id) {
        $product = Product::with('company')->find($id);
        $company = Company::find($product->company_id);
        $sale = Sale::where('product_id', $id)->select('id','product_id')->get();

        return view('products_detail', compact('product', 'company', 'sale'));
    }
    
    public function showProducts_edit($id){
        $product = Product::find($id);
        $companies = Company::select('id','company_name')->get();
        return view('products_update',compact('product','companies'));
    }

    public function showProducts_update(ProductRequest  $request,$id) {
        $product = Product::findOrFail($id);
        
        $company = Company::find($product->company_id);
        $sale = Sale::where('product_id', $id)->select('id','product_id')->get();
        $companies = Company::select('id','company_name')->get();
        try{
            $validatedData = $request->validated();
            if($request->hasFile('image')){
                $filename = uniqid().'.'.$request->image->extension();
                $request->image->storeAs('public/images',$filename);
                $product->img_path = 'storage/images/'.$filename;
            }

            $product->product_name = $validatedData['product_name'];
            $product->price = $validatedData['price'];
            $product->stock = $validatedData['stock'];
            $product->comment = $request->comment;
            $product->company_id = $validatedData['company_id'];
            if ($request->has('company_id')) {
                $product->company_id = $request->company_id;
            }
        
            $product->save();

            return redirect()->route('products_list');
        }catch(ValidationException $e){
            return back()->withErrors($e->valedator)->withInput()->with('companies',$companies);
        }
    }
}