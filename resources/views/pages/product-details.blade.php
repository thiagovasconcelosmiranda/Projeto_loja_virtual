@include("templates.header")
<div class="body-template container">
    <div class="product_details" data-id="{{$product['id']}}">
        <div class="product-item">
            <div class="product_details_row">
                <div class="product_details_col">
                  <div class="image">
                      <img src="/assets/images/products/{{$product['image']}}" alt="{{$product['image']}}">
                  </div>
                </div>
                <div class="product_details_col">
                    <div class="seller">
                        <p>Vendendor:</p>
                        <select id="seller-select" name="seller_id">
                            <option value="">Selecione um vendedor</option>
                            @foreach ($sellers as $item)
                            {{$item}}
                            <option value="{{$item['id']}}">{{$item['name_seller']}}</option>
                            @endforeach
                        </select>
                    </div>

                  <div class="product-description">
                     <div class="product-title">
                          <h2>{{$product['description']}}</h2>
                     </div>
                     <div class="price-item top">
                        <p>Preço:</p>
                         <p> <span> R$ {{$product['price']}}</span> und.</p>
                     </div>
                     <div class="qtd-product top">
                         <div class="click-back">-</div>
                         <div class="visible_qtd" id="visible">1</div>
                         <div class="click-next">+</div>
                     </div>
                     <div class="price_subtotal top">
                        <h3>Total á pagar:</h3>
                        <h3 id="subtotal">R$ 500.00 </h3>
                     </div>
                     <div class="price_form_pag top">
                        <h3>Forma de pagamento:</h3>
                       <select id="form_pag" name="form_pag">
                          <option value="">Selecione a forma de pagamento</option>
                          <option value="Boleto">Boleto</option>
                          <option value="Boleto">Pix</option>
                          <option value="Boleto">Cartão de Crédito</option>
                       </select>
                     </div>
                     <div class="product-venc top">
                        <p>Data de vencimento:</p>
                        <input id="data_venc" type="date" name="data_venc">
                    </div>
                     <div class="product-parc top">
                         <p>Parcelas:</p>
                          <select name="parc" id="select-i"></select>
                     </div>
                  </div>
                  <dv class="button-sale">
                      <button id="button-sale">Comprar</button>
                  </dv>
                </div>
             </div>
        </div>
    </div>
</div>
@include("templates.footer")