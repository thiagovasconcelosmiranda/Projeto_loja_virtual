if(document.getElementById('search')){
  let input = document.getElementById('search');
  
  input.addEventListener('input', ()=>{
    if(input.value !== ''){
      ajaxSearchSale(input.value);
    }else{
       ajaxSearchSale(null);
    }
  });

  ajaxSearchSale(null);

  async function ajaxSearchSale(input){
       var req = await fetch(`http://127.0.0.1:8000/ajax/vendas/${input}`,{
        headers:{
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
        }
       });
       var json = await req.json();
       tableSale(json.data);
  }


  function tableSale(data){
    let table = document.querySelector('.table_sale');
    table.innerHTML = 
    `
      <tr>
         <th>IMGAEM PRODUTO</th>
         <th>VENDEDOR</th>
         <th>DESC PRODUTO</th>
         <th>QTD DO PRODUTO</th>
         <th>FORMA DE PAGAMENTO</th>
         <th>QTD PARCELAS</th>
         <th>VALOR PARCELA</th>
         <th>SUBTOTAL</th>
         <th>AÇÃO</th>
      </tr>
    `;

     data.map(item => {
      table.innerHTML += 
      `
                <tr>
                    <td><img src='/assets/images/products/${item.image}'/></td>
                    <td>${item.name_seller}</td>
                    <td>${item.description}</td>
                    <td>${item.qtd_product}</td>
                     <td>${item.form_pag}</td>
                    <td>${item.qtd_parc} x</td>
                    <td>R$ ${item.parc_price}</td>
                    <td>R$ ${item.subtotal_product}</td>
                    <td>
                        <a href="/venda/edit/${item.sale_id}">
                          <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                       <a href="/venda/delete/${item.sale_id}">
                          <i class="fa-regular fa-trash-can"></i>
                       </a>
                       
                    </td>
                </tr>
      `;
     })
  }
  

}