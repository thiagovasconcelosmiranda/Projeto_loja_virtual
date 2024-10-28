<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  private $id;
  private $product;
  public function findAll()
  {
    return Product::get();
  }

  public function index($id){
    return view('Pages/product-details', [
      'product' => self::show($id),
      'sellers' => self::getSeller()
    ]);
  }

  private function getSeller(){
    $seller = new SellerController;
    return $seller->index();
  }

  /**
   * Summary of show
   * @param mixed $id
   * @return mixed
   */
  public function show($id)
  {
    if ($id) {
      $product = Product::where('id', $id)->first();
      return $product;
    }
  }

  public function ajaxProduct($id)
  {
    $array = ['error'=>''];
    if($id){
      $array['data'] = self::show($id); 
    }else{
      $array['error'] = 'id invalid';
    }
    

    header('Content: application/json');
    echo json_encode($array);
  }
 
}
