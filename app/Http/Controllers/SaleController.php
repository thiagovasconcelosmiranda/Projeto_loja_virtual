<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Helper\helper;

class SaleController extends Controller
{
  private $sale;
  private  $installment;
    public function __construct(){
       $this->sale = new Sale();
       $this->installment = new installmentController();
    }


    public function index(){
        return view('Pages/sale');
    }


    private function create( Request $request){
        $s = new $this->sale;
        $s->qtd_product = $request['qtd_product'];
        $s->form_pag = $request['form_pag'];
        $s->subtotal_product = floatval($request['subtotal_product']);
        $s->product_id = $request['product_id'];
        $s->seller_id = $request['seller_id'];
        $s->user_id = helper::auth()['id'];
        $s->save();

        $id = self::lastSaleId();
        return $id;
        
    }

    private function findAll(){
       return $this->sale
       ->join('installments','installments.sale_id','=', 'sales.id')
       ->join('products','products.id','=','sales.product_id')
       ->join('users','users.id','=','sales.user_id')
       ->join('sellers','sellers.id','=','sales.seller_id')
       ->get();
    }

    private function findSearch($search){
        return $this->sale
        ->join('installments','installments.sale_id','=', 'sales.id')
        ->join('products','products.id','=','sales.product_id')
        ->join('users','users.id','=','sales.user_id')
        ->join('sellers','sellers.id','=','sales.seller_id')
        ->Where('products.name_product', 'like', '%' . $search . '%')
        ->orWhere('products.description', 'like', '%' . $search . '%')
        ->orWhere('products.price', 'like', '%' . $search . '%')
        ->orWhere('installments.parc_price', 'like', '%' . $search . '%')
        ->orWhere('installments.qtd_parc', 'like', '%' . $search . '%')
        ->orWhere('sales.option_pag', 'like', '%' . $search . '%')
        ->get();
    }

    public function findId($id){
      $data = $this->sale
      ->join('installments','installments.sale_id','=', 'sales.id')
      ->join('products','products.id','=','sales.product_id')
      ->join('users','users.id','=','sales.user_id')
      ->join('sellers','sellers.id','=','sales.seller_id')
      ->where('sales.id',$id)
      ->first();
      return $data;
    }

    
    /**
     * Summary of searchSale
     * @param mixed $search
     * @return void
     */
    public function searchSale($search){
    $array = ['error'=> ''];

    if($search != 'null'){
       $array['data'] = self::findSearch($search);
    }else{
       $array['data'] = self::findAll();
    }


    header('Content: application/json');
    echo json_encode($array);
    }

    /**
     * Summary of lastSaleId
     * @return mixed
     */
    private function lastSaleId(){
     $id = $this->sale::orderByDesc('id')->first();
     return $id['id'];
    }

    /**
     * Summary of createItem
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function createItem (Request $request){
      $array = ['error'=>''];
      
      if(!empty($request['product_id']) && !empty($request['qtd_parc']) && 
      !empty($request['price_parc']) && !empty($request['subtotal_product']) &&
       !empty($request['form_pag']) && !empty($request['data_venc']) 
       && !empty($request['seller_id'])){
       
       if($id = self::create($request)){
           if($this->installment->create($request, $id)){
               $array['success'] = 'sale create';
           }
        }else{
           $array['error'] = 'Compra não realizada!';
        }
       
     }else{
        $array['error'] = ' Campos vazios!';
     }
       
      header('Content: application/json');
      echo json_encode($array);
    }
    
    /**
     * Summary of indexEdit
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function indexEdit($id){
    
     return view('Pages/sale-edit', [
      'sale'=> self::findId($id)
     ]);
    }

    /**
     * Summary of update
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return bool
     */
    private function update(Request $request, $id){
     return $this->sale
     ->where('id', $id)
     ->update([
      'form_pag' => $request['form_pag'],
      'qtd_product' => $request['qtd_product'],
      'subtotal_product' => floatval($request['subtotal_product']),
      'user_id' => helper::auth()['id']
     ]);
    }

    /**
     * Summary of updateItem
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function updateItem(Request $request, $id){
      if(self::update($request, $id)){
          if($this->installment->update($request, $id)){
             return redirect()->back();
          }
      }
      return redirect()->back()->with('error','Erro ao alterar');
    }



    /**
     * Summary of deleteItem
     * @param mixed $id
     * @return bool|mixed|\Illuminate\Http\RedirectResponse
     */
    public function deleteItem($id){
       if($id){
         if($this->installment->delete($id)){
            if(self::delete($id)){
                 return redirect()->back();
            }
         }
       }
       return false;
    }

    /**
     * Summary of delete
     * @param int $id
     * @return bool|null
     */
    public function delete($id){
      return $this->sale
       ->where('id', $id)
       ->delete();
    }

}
