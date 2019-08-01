<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JsonPickerController extends Controller
{
    public function json(){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_URL, 'https://api.myjson.com/bins/15lyvl');
      $json = curl_exec($ch);
      curl_close($ch);

      // $obj = json_decode($json, FALSE);

      // // $obj = nl2br(str_replace(' ', '&nbsp;', (json_encode(json_decode($json,TRUE), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))));

      // echo "<br> Title=> ".$obj->titleModule->subject;
      // echo "<br> ProductId=> ".$obj->pageModule->productId;
      // echo "<br> Url=> ".$obj->pageModule->ogurl;
      // echo "<br> ImagePath=> ".$obj->pageModule->imagePath;
      // echo "<br> MinPrice=> ".$obj->priceModule->minActivityAmount->value;
      // echo "<br> MaxPrice=> ".$obj->priceModule->maxActivityAmount->value;
      // echo "<br> propertyValueDefinitionName=> ".$obj->skuModule->productSKUPropertyList[2]->skuPropertyValues[0]->propertyValueDefinitionName;
      // echo "<br> propertyValueId=> ".$obj->skuModule->productSKUPropertyList[2]->skuPropertyValues[0]->propertyValueId;
      // echo "<br> propertyValueDefinitionName=> ".$obj->skuModule->productSKUPropertyList[2]->skuPropertyValues[1]->propertyValueDefinitionName;
      // echo "<br> propertyValueId=> ".$obj->skuModule->productSKUPropertyList[2]->skuPropertyValues[1]->propertyValueId;
      // foreach($obj->skuModule->skuPriceList as $item)
      // {
      //     if(strpos($item->skuAttr, strval($obj->skuModule->productSKUPropertyList[2]->skuPropertyValues[0]->propertyValueId)) !== false)
      //     {
      //         echo '<br>'.$item->skuVal->skuActivityAmount->value;
      //         break;
      //     }
      // }

      return view('jsontester')->with('obj', json_decode($json, FALSE));

    }
    public function getProductPrice(Request $request){
      $propertyValueId = $request->get('ppid');


      $ch = curl_init();
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_URL, 'https://api.myjson.com/bins/15lyvl');
      $json = curl_exec($ch);
      curl_close($ch);

      $obj = json_decode($json, FALSE);

      foreach($obj->skuModule->skuPriceList as $item)
      {
          if(strpos($item->skuAttr, strval($propertyValueId)) !== false)
          {
              echo $item->skuVal->skuActivityAmount->value;
              break;
          }
      }

    }
}
