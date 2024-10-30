<?php

namespace App\Http\Controllers;

use App\Models\installment;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{

    /**
     * Summary of create
     * @param \Illuminate\Http\Request $request
     * @param int $saleId
     * @return bool
     */
    public function create(Request $request, $saleId){

      $i = new installment();
      $i->qtd_parc = $request['qtd_parc'];
      $i->data_venc = $request['data_venc'];
      $i->sale_id = $saleId;
      $i->parc_price = floatval($request['price_parc']);
      $i->save();
      return true;
    }

    public function update(Request $request, $id){
       Installment::where('sale_id', $id)->update([
       'qtd_parc' => $request['qtd_parc'],
       'parc_price' => floatval($request['price_parc'])
       ]);
    }

    /**
     * Summary of delete
     * @param int $id
     * @return bool|null
     */
    public function delete($id){
     return Installment::where('sale_id', $id)
      ->delete();
    }
}
