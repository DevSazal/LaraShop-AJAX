<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use DB;

class LiveSearchController extends Controller
{
    public function liveshop(){
      $array['products'] = Product::all();
      return view('live-shop')->with($array);
    }

    public function fetch(Request $request){
      if($request->ajax()){
        $output = '';
        $query = $request->get('query');
        if($query != ''){
          $data = DB::table('products')
                  ->where('name','LIKE', '%'.$query.'%')
                  ->get();
        }else{
          $data = DB::table('products')
                  ->where('category_id', '=',$request->get('cat'))
                  ->orderBy('id','desc')
                  ->get();
        }
        //count data set
        $total_row = $data->count();
        if($total_row > 0){
          foreach ($data as $row) {
            // code...
            $output .= '
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="single-product-wrapper">
                    <!-- Product Image -->
                    <div class="product-img">
                        <img src="'.\Illuminate\Support\Facades\URL::asset("front-end/img/product-img/product-1.jpg").'" alt="">
                        <!-- Hover Thumb -->
                        <img class="hover-img" src="'.\Illuminate\Support\Facades\URL::asset("front-end/img/product-img/product-2.jpg").'" alt="">

                        <!-- Product Badge -->
                        <div class="product-badge offer-badge">
                            <span>-30%</span>
                        </div>
                        <!-- Favourite -->
                        <div class="product-favourite">
                            <a href="#" class="favme fa fa-heart"></a>
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div class="product-description">
                        <span>topshop</span>
                        <a href="single-product-details.html">
                            <h6>'.$row->name.'</h6>
                        </a>
                        <p class="product-price"><span class="old-price">$75.00</span> $'.$row->price.'</p>

                        <!-- Hover Content -->
                        <div class="hover-content">
                            <!-- Add to Cart -->
                            <div class="add-to-cart-btn">
                                <a href="#" class="btn essence-btn">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
          }

        }else {
          $output = '
          <div class="col-xs-12">
            <div class="alert " role="alert" style="color: white;font-size: 17px;font-weight: 900;background: #39c395;
          border-color: #d6e9c6;">
              No Supplier Found.
            </div>
          </div>
          ';
        }
        $data = array(
          'total_data' => $output
        );

        echo json_encode($data);
      }
    }





}
