
if (document.getElementById('form_pag') &&
    document.getElementById('qtd_product')
) {
    let qtdProduct = document.getElementById('qtd_product');
    let qtdParc = document.getElementById('qtd_parc');
    let subtotalProduct = document.getElementById('subtotal_product');
    let priceProduct = document.getElementById('priceProduct');
    let formPag = document.getElementById('form_pag');
    let select = document.getElementById('list_parcs');

    formPag.addEventListener('click', optionSelect);

    function optionSelect() {

        if (formPag.value === 'Pix' || formPag.value === 'Boleto') {
            qtdParc.style.display = 'none';
            select.style.display = 'none';
            qtdParc.value = 1;
        } else {
            qtdParc.style.display = 'block';
            select.style.display = 'block';
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

        if (parc >= 1) {
            generationParc();
        }
    }
    generationParc();
    optionSelect();

    function generationParc() {
        select.innerHTML = "";

        let num = parseInt(qtdParc.value);
        for (let i = 1; i <= num; i++) {
            const date = new Date();
            let dateFormat = `${date.getDay()}/${date.getMonth() + i}/${date.getFullYear()}`;
            console.log(dateFormat);
            let parcPrice = parseFloat(subtotalProduct.innerText);
            let newPrice = (parcPrice.toFixed(2) / i).toFixed(2);
            let option = document.createElement('option');
            option.innerHTML = `${i} x - R$ ${newPrice} - ${dateFormat}`;
            select.appendChild(option);
        }
    }
}