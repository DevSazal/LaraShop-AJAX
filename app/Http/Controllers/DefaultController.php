<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use DB;

use GuzzleHttp\Client;
use Sunra\PhpSimple\HtmlDomParser;

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


    // scraper
    function scraperView(){
      return view('scrape');
    }
    function XscraperFetch(Request $request){
      // get url for scraping
      $url = $request->get('url');
      //init guzzle
      $client = new Client();
      // get request
      $response = $client->request(
        'GET',
        $url
      );
      $response_status_code = $response->getStatusCode();
      $html = $response->getBody()->getContents();

      if($response_status_code == 200){
        $dom = HtmlDomParser::str_get_html($html);
        $items = $dom->find('div[class="chart-list-item"]');
        foreach($items as $item){
          $item_title = trim($item->find('span[class="chart-list-item__title-text"]', 0)->text());
          $item_artist = trim($item->find('div[class="chart-list-item__artist"]', 0)->text());
          $item_lyrics = $item->find('div[class="chart-list-item__lyrics"]', 0)->find('a', 0);
          dd($item_lyrics->attr['href']);
        }
        // dd($html);
      }
      // return view('scraper-data');
    }
    /*function X2scraperFetch(Request $request){
      // get url for scraping
      $url = $request->get('url');
      //init guzzle
      $client = new Client();
      // get request
      $response = $client->request(
        'GET',
        $url,
        [
          'headers' => [
            'Accept' => ''
          ]
        ]
      );
      $response_status_code = $response->getStatusCode();
      $html = $response->getBody()->getContents();

      $trimmed = substr($html, 43, -143);
      $cleaned = str_replace("\\n", "", $trimmed);
      $cleaned = str_replace("\\", "", $cleaned)

      if($response_status_code == 200){
            $dom = HtmlDomParser::str_get_html($cleaned);
            dd($dom->find('div[class="influencer-card"]'));
            $items = $dom->find('div[class="chart-list-item"]');
            foreach($items as $item){
              $item_title = trim($item->find('span[class="chart-list-item__title-text"]', 0)->text());
              $item_artist = trim($item->find('div[class="chart-list-item__artist"]', 0)->text());
              $item_lyrics = $item->find('div[class="chart-list-item__lyrics"]', 0)->find('a', 0);
              dd($item_lyrics->attr['href']);
            }
        // dd($html);
      }
      // return view('scraper-data');
    }*/
    function scraperFetch(Request $request){
      // get url for scraping
      $url = $request->get('url');
      //init guzzle
      $client = new Client();
      // get request
      $response = $client->request(
        'GET',
        $url
      );
      $response_status_code = $response->getStatusCode();
      $html = $response->getBody()->getContents();

      // dd($html);

      if($response_status_code == 200){
        $dom = HtmlDomParser::str_get_html($html);
        // dd($dom->find('div[class="influencer-card"]'));
        $item_text = trim($dom->find('span[class="title-text"]', 0)->text());
        $item_min_price = trim($dom->find('div[class="price-show-box"]', 0)->find('span[data-min-price=]', 0)->text());
        $item_max_price = trim($dom->find('div[class="price-show-box"]', 0)->find('span[data-max-price=]', 0)->text());
        $item_photos = $dom->find('div[class="detail-image-slides first-render-status"]', 0);
        $item_photo = $item_photos->find('div[class="swipe-pane"]', 0)->find('img[class="J_ImageFirstRender"]', 0);
        // $item_photo->attr['src'];
        // foreach($items as $item){
        //   $item_title = trim($item->find('span[class="chart-list-item__title-text"]', 0)->text());
        //   $item_artist = trim($item->find('div[class="chart-list-item__artist"]', 0)->text());
        //   $item_lyrics = $item->find('div[class="chart-list-item__lyrics"]', 0)->find('a', 0);
        //   dd($item_lyrics->attr['href']);
        // }
        // dd($items->text());

        echo "Product title =>".$item_text;
        echo "<br>Min Price =>".$item_min_price;
        echo "<br>Max Price =>".$item_max_price;
        echo "<br>Img =>".$item_photo->attr['src'];
        // dd($item_photo->attr['src']);
      }
      // return view('scraper-data');
    }
}
