@include("templates.header")
<div class="body-template container">
  <div class="banner">
  </div>
    <main>
        <section>
            <div class="pag container">
                <div class="pag-title">
                   <h2>Produtos em destaques</h2> 
                </div>
              <div class="cards">
                @foreach ($products as $item)
                    <div class="card">
                        <div class="card-img">
                            <img src="/assets/images/products/{{$item['image']}}" alt="Jogo XBox">
                        </div>
                        <div class="card-info">
                           <div class="card-title">
                                <h3>{{$item['name_product']}}</h3>
                           </div>
                           <div class="card-description">
                               <h5>{{$item['description']}}</h5>
                               <div class="card-price"> 
                                   <p>R$ {{$item['price']}}</p>
                                   <div class="price-parc">
                                       <p>Até 10x sem juros</p>
                                   </div>
                               </div>
                           </div>
                           <div class="card-button">
                             <a href="/produto/{{$item['id']}}">
                               <button>Detalhes</button>
                             </a>
                           </div>
                        </div>
                    </div>
                @endforeach
              </div>
            </div>
        </section>
  </main>
  @include("templates.footer")
</div>