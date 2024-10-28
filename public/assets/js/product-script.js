
if (document.querySelector('.product_details')) {
  let back = document.querySelector('.click-back');
  let next = document.querySelector('.click-next');
  let count = 1;
  let select = document.getElementById('select-i');
  let subtotal = document.getElementById('subtotal');
  let id = document.querySelector('.product_details').getAttribute('data-id');
  let formPag = document.getElementById('form_pag');
  
  back.addEventListener('click', () => {
    count--;
    if (count == 0) {
      count = 1;
    }
    productQtd(count);
  });

  next.addEventListener('click', () => {
    count++;
    productQtd(count);
  });

  function productQtd(qtd) {
    let input = document.getElementById('visible')
    input.innerText = qtd;

    ajaxProduct().then(res => {
      calcPrice(res.price, count);
    });
  }

  function calcPrice(price, qtd) {
    let num = parseFloat(price * qtd).toFixed(2);

    let numSubtotal = num.replace('.', ',')
    subtotal.innerHTML = `R$ ${numSubtotal}`;
    parcPrice(num);
  }


  function parcPrice(price) {

    select.innerHTML = '';
    for (let i = 1; i < 11; i++) {
      let parc = (price / i)
      parc = parc.toFixed(2);
      parc = parc.replace('.', ',');

      htmlSelect(parc, i);
    }
  }

  function htmlSelect(price, parc) {

    select.innerHTML +=
      `
     <option value="${parc}|${price}"> ${parc}x - R$ ${price}</option>
     `;
  }

  ajaxProduct();

  async function ajaxProduct() {
    if (id) {
      let req = await fetch(`http://127.0.0.1:8000/ajax/produto/${id}`, {
        method: 'GET',
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-Requested-With": "XMLHttpRequest"
        }
      });
      let json = await req.json();

      subtotal.innerHTML = `R$ ${json.data.price}`;
      parcPrice(json.data.price);
      return json.data;
    }
  }


  document.getElementById('button-sale').addEventListener('click', ajaxCreateSale);

  function addObject() {
    let qtdProduct = document.getElementById('visible');
    let subtotal = document.getElementById('subtotal').innerHTML.split(' ');
    let inputSeller = document.getElementById('seller-select');

    let dataVenc = document.getElementById('data_venc');

    list = select.value.split('|');

    sale.product_id = id;
    let priceParc = list[1].replace(',', '.');
    sale.qtd_parc = list[0];
    sale.price_parc = priceParc;
    sale.qtd_product = qtdProduct.innerHTML;
    sale.subtotal_product = subtotal[1];
    sale.form_pagm = formPag.value;
    sale.seller_id = inputSeller.value;
    sale.data_venc = dataVenc.value;

    if (list[0] > '1') {
      sale.option_pag = 'Parcelado';
    } else {
      sale.option_pag = 'À vista';
    }
  }

  formPag.addEventListener('click', (e) => {
    let formParc = document.querySelector('.product-parc');
    let input = e.target.value;

    if (input) {
      if (input === 'Boleto' || input === 'Pix') {
        formParc.style.display = 'none';
      } else {
        formParc.style.display = 'block';
      }
    }
  });

  async function ajaxCreateSale() {
    addObject();
    let data = new FormData();
    data.append('product_id', sale.product_id);
    data.append('option_pag', sale.option_pag);
    data.append('seller_id', sale.seller_id);
    data.append('form_pag', sale.form_pagm);
    data.append('qtd_product', sale.qtd_product);
    data.append('subtotal_product', sale.subtotal_product);
    data.append('data_venc', sale.data_venc);
    data.append('qtd_parc', sale.qtd_parc);
    data.append('price_parc', sale.price_parc);

    var req = await fetch(`http://127.0.0.1:8000/ajax/venda/create`, {
      method: 'POST',
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-Token": $('input[name="_token"]').val()
      },

      body: data
    });

    var json = await req.json();
    console.log(json);

    if (json.error != '') {
      alert(json.error);
      return;
    }

    window.location.href = 'http://127.0.0.1:8000/vendas';

  }

}
