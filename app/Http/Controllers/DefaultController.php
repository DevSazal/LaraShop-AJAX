<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use DB;

class DefaultController extends Controller
{
    public function index(){
      return view('index');
    }
    public function singleProduct(){
      return view('single-product-details');
    }
    public function shop(){
      $array['products'] = Product::all();
      return view('shop')->with($array);
    }


    // Auto Search Complete
    function fetch(Request $request){
       if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('products')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" style="display:block; position:relative;     width: 350px;    padding: 5px 5px;">';
          foreach($data as $row){
           $output .= '
           <li style="padding: 5px 10px; cursor:pointer;">'.$row->name.'</li>
           ';
          }
          $output .= '</ul>';
          echo $output;
       }
    }
}
