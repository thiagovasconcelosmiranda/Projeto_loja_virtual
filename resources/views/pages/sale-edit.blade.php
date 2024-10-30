@include("templates.header")
<div class="body-template container">
    <div class="sale">
        <div class="sale-title">
            <h2>Alterar Venda</h2>
       </div>
       <div class="sale_form">
         <div class="sale_user">
             <h2>Comprador</h2>
             <p>Name: {{$sale['name']}}</p>
             <p>Email: {{$sale['email']}}</p>
         </div>
         <div class="sale_user">
          <h2>Vendedor</h2>
          <p>Name: {{$sale['name_seller']}}</p>
      </div>
       <div class="sale-product">
        <div class="sale-product-row">
            <div class="product-image">
               <img src="/assets/images/products/{{$sale['image']}}">
            </div>
            <div class="product-description">
               <h2>Descrição: {{$sale['description']}}</h2>
               <h2 id="priceProduct">Valor R$ {{$sale['price']}} unid.</h2>
            </div>
        </div>
      </div>
            <form method="POST" action="/venda/edit/{{$sale['sale_id']}}">
              @csrf
              <div class="group-input">
                <div class="input-item">
                  <label>Forma de pagamento:</label>
                  <select  name="form_pag" id="form_pag">
                    <option value="{{$sale['form_pag']}}">{{$sale['form_pag']}}</option>
                    <option value="Pix">Pix</option>
                    <option value="Boleto">Boleto</option>
                    <option value="Cartão de Crédito">Cartão de Crédito</option>
                  </select>
                </div>
                <div class="input-item">
                  <label for="">Data vencimento:</label>
                  <input type="text" value="{{$sale['data_venc']}}" name="data_venc">
                </div>
                <div class="input-item">
                    <label>Quantidade do produto:</label>
                    <input id="qtd_product" type="number" value="{{$sale['qtd_product']}}" name="qtd_product">
                </div>
              </div>
              <div class="group-input">
                <div class="input-item">
                  <label>Quantidade parcelas:</label>
                  <input id="qtd_parc" type="number" value="{{$sale['qtd_parc']}}" name="qtd_parc"/>
                </div>
                <div class="input-item">
                  <label>Parcelas à pagar:</label>
                  <select id="list_parcs" name="list_parcs">
                    <option value="">Parcelas</option>
                  </select>
                </div>
                <div class="input-item">
                  <label>Subtotal Produto:</label>
                  <p> R$<span id="subtotal_product"> {{$sale['subtotal_product']}}</span></p>
                </div>
                <input id="subtotal_product" type="hidden" value="{{$sale['subtotal_product']}}" name="subtotal_product"/>
              </div>
              <div class="button-edit">
                <Button>Alterar</Button>
              </div>
            </form>
          </div>
       </div>
   @include("templates.footer")
</div>  