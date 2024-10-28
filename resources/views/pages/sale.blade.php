@include("templates.header")
<div class="body-template container">
    <div class="sale">
         <div class="sale-title">
              <h2>Vendas Realizadas</h2>
         </div>
         <div class="sale-table">
            <div class="sale-search">
                <label>BUSCAR VENDAS: </label>
                <input type="text" name="search" id="search" placeholder="Buscar vendas">
            </div>
             <table class="table_sale"></table>
         </div>
    </div>
    @include("templates.footer")
</div>