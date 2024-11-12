
if (document.getElementById('form_pag') &&
    document.getElementById('qtd_product')
) {
    let qtdProduct = document.getElementById('qtd_product');
    let qtdParc = document.getElementById('qtd_parc');
    let subtotalProduct = document.getElementById('subtotal_product');
    let priceProduct = document.getElementById('priceProduct');
    let formPag = document.getElementById('form_pag');
    let select = document.getElementById('list_parcs');
    let dataVenc = document.getElementById('data_venc');

    formPag.addEventListener('click', optionSelect);

    function optionSelect() {

        if (formPag.value === 'Pix' || formPag.value === 'Boleto') {
            qtdParc.style.display = 'none';
            select.style.display = 'none';
            dataVenc.style.display = 'block';
            qtdParc.value = 1;
        } else {
            qtdParc.style.display = 'block';
            select.style.display = 'block';
            dataVenc.style.display = 'none';
        }
        generationParc();
    }

    qtdProduct.addEventListener('input', calcNumber);

    function calcNumber(e) {
        generationParc();
        let qtdProd = parseInt(e.target.value);
        let priceProductFloat = parseFloat(priceProduct.innerHTML.split(' ')[2]);

        if (qtdProd >= 1) {
            let newPrice = parseFloat(priceProductFloat * qtdProd);
            subtotalProduct.innerText = newPrice.toFixed(2);
            generationParc();
        }
    }

    qtdParc.addEventListener('input', calcParc);

    function calcParc(e) {
        let parc = parseInt(e.target.value);


        if (parc >= 1 && parc <= 10) {
            generationParc();
        }
    }
    generationParc();
    optionSelect();

    function generationParc() {
        select.innerHTML = "";
        let inputVenc = document.getElementById('data_venc').value;
        
        let dateVenc = inputVenc.split('/');
        let invertDate = `${dateVenc[2]}/${dateVenc[1]}/ ${dateVenc[0]}`;

        let time = new DateFormate();
        time = time.invertDate(invertDate);
        let num = parseInt(qtdParc.value);
        let year = time[2];

        for (let i = 1; i <= num; i++) {
            let month = time[1] + i > '12' ? `0${+i-1}` : parseInt(time[1]+i);
            if(parseInt(month) == 1){
                year = (time[2]+i-1);
            }
           
            let dateFormat = `${time[0]}/${month}/${year}`;

            let parcPrice = parseFloat(subtotalProduct.innerText);
            let newPrice = (parcPrice.toFixed(2) / i).toFixed(2);
            let option = document.createElement('option');

            option.innerHTML = `${i} x - R$ ${newPrice} - ${dateFormat}`;
            select.appendChild(option);
        }
    }
}