<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Cart;
use DB;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function fetchProducts() {
        $data = Product::where('status',1)->with('cat')->orderBy('id', 'DESC')->paginate(12);
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }

    public function featuredProducts() {
        $data = Product::where('status',1)->where('featured',1)->with('cat')->orderBy('id', 'DESC')->paginate(12);
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }

    public function productByCategory($id) {
        $data = Product::select('products.*','product_categories.name')
                ->leftJoin('product_categories','product_categories.id','=','products.cat_id')
                ->where('product_categories.slug',$id)
                ->orWhere('product_categories.id',$id)
                ->with('cat')
                ->orderBy('products.id', 'DESC')
                ->paginate(12);
    
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }

    public function searchProduct(Request $request){
        $q = $request->get('q');
        $data = Product::where ( 'pname', 'LIKE', '%' . $q . '%' )->orWhere ( 'description', 'LIKE', '%' . $q . '%' )->with('cat')->paginate(12);
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }

    public function singleProduct($id) {
        $data = Product::where('slug',$id)->orWhere('id',$id)->with('cat')->first();
        if($data){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "status" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 403,
                "message" => "not found",
            );
            return Response::json($response);
        }
    }

    public function fetchCarts($id) {
        $data = Cart::where('user_id', $id)->orderBy('id', 'desc')->get();
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }

    public function sumTotalCart($id) {
        $data = Cart::where('user_id', $id)->sum('total');
        if($data){
            if($data > 0){
                $response = array(
                    "status" => 200,
                    "message" => "operation successful",
                    "data" => $data,
                );
                return Response::json($response);
            } else {
                $response = array(
                    "status" => 400,
                    "message" => "empty data",
                    "data" => $data,
                );
                return Response::json($response);
            }
        } else {
            $response = array(
                "status" => 403,
                "message" => "user not found",
                "data" => $data,
            );
            return Response::json($response);
        }
    }
    
    public function addToCart(Request $request, $user_id){
        $product = Product::where('id', $request->product_id)->first();
        if($product){
            $product_id = $request->product_id;
            $price = $product->price;
            $quantity = !empty($product->quantity)?$product->quantity:"1";
            $total = $quantity * $price;
            $count = Cart::where('user_id', '=',$user_id)->where('product_id', '=' ,$product_id)->count();
                if($count == 1) {
                    $response = array(
                        "status" => 201,
                        "message" => "product is already in your cart",
                    );
                    return Response::json($response);

                } else {
        
                $item = new Cart();
                $item->user_id = $user_id;
                $item->product_id = $product_id;
                $item->price = $price;
                $item->quantity = $quantity;
                $item->total = $total;
            
                if($item->save()){
            
                    $response = array(
                        "status" => 200,
                        "message" => "Product added to your cart",
                        "data" => $item,
                    );
                    return Response::json($response); //return status response as json
                } else {
                    $response = array(
                        "status" => 400,
                        "message" => "Error adding product to cart . Please try again",
                    );
                    return Response::json($response); //return status response as json
                }
            }
        } else {
            $response = array(
                "status" => 403,
                "message" => "product not found",
            );
            return Response::json($response);
        }
    }

    public function increaseCart($id){
        $item = Cart::where('id', $id)->update(['quantity'=> DB::raw('quantity+1')]);
        if($item){
            $sql = Cart::select('price', 'quantity')->where('id', '=', $id)->first();
            $total = $sql->price * $sql->quantity;
            $item = Cart::where('id', $id)->update(['total'=> DB::raw($total)]);
            if($item){
        
                $response = array(
                    "status" => 200,
                    "message" => "operation successful",
                );
                return Response::json($response);
            } else {
                $response = array(
                    "status" => 400,
                    "message" => "operation failed",
                );
                return Response::json($response);
            }
        } else {
            $response = array(
                "status" => 400,
                "message" => "operation failed",
            );
            return Response::json($response);
        }
    }

    public function decreaseCart($id){
        $item = Cart::where('id', $id)->update(['quantity'=> DB::raw('quantity-1')]);
        if($item){
            $sql = Cart::select('price', 'quantity')->where('id', '=', $id)->first();
            $total = $sql->price * $sql->quantity;
            $item = Cart::where('id', $id)->update(['total'=> DB::raw($total)]);
            if($item){
        
                $response = array(
                    "status" => 200,
                    "message" => "operation successful",
                );
                return Response::json($response);
            } else {
                $response = array(
                    "status" => 400,
                    "message" => "operation failed",
                );
                return Response::json($response);
            }
        } else {
            $response = array(
                "status" => 400,
                "message" => "operation failed",
            );
            return Response::json($response);
        }
    }

    public function removeFromCart($id){
        $item = Cart::where('id',$id)->delete();
    
        if($item){
    
            $response = array(
                "status" => 200,
                "message" => "operation successful",
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "operation failed",
            );
            return Response::json($response);
        }
    }

    public function emptyCart($id){
        $item = Cart::where('user_id',$id)->delete();
    
        if($item){
    
            $response = array(
                "status" => 200,
                "message" => "operation successful",
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "operation failed",
            );
            return Response::json($response);
        }
    }

    public function fetchProductCategory() {
        $data = ProductCategory::where('status', 1)->get();
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }
}
