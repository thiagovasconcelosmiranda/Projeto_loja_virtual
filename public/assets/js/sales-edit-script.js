
if (document.getElementById('option_pag')) {
    let qtdProduct = document.getElementById('qtd_product');
    let parcPrice = document.getElementById('parc_price');
    let qtdParc = document.getElementById('qtd_parc');
    let subtotalProduct = document.getElementById('subtotal_product');
    let priceProduct = document.getElementById('priceProduct');
    let optionPag = document.getElementById('option_pag');

  optionPag.addEventListener('click', optionSelect)

  function optionSelect(e){
   
   if(e.target.value == 'Á vista'){
    let newPrice = parseFloat(priceProduct.innerHTML.split(' ')[2] * parseInt(qtdProduct.value));
    subtotalProduct.value = newPrice.toFixed(2);
    qtdParc.disabled = true;
    parcPrice.disabled = true;
  
   }else{
    qtdParc.disabled = false;
    parcPrice.disabled = false;
   }
  }

    qtdProduct.addEventListener('input', calcNumber);

    function calcNumber(e) {
        let qtdProd = parseInt(e.target.value);
        let priceProductFloat = parseFloat(priceProduct.innerHTML.split(' ')[2]);

        if (qtdProd >= 1) {
            let newPrice = parseFloat(priceProductFloat * qtdProd);
            subtotalProduct.value = newPrice.toFixed(2);
            let newPriceParc = parseFloat(subtotalProduct.value / qtdParc.value);
            parcPrice.value = newPriceParc.toFixed(2);
        }
    }

    qtdParc.addEventListener('input', calcParc);

    function calcParc(e) {
        let parc = parseInt(e.target.value);
        let priceProductFloat = parseFloat(priceProduct.innerHTML.split(' ')[2])

        if (parc >= 1) {
            let newPrice = parseFloat(priceProductFloat / parc);
            parcPrice.value = newPrice.toFixed(2);
        }
    }
}