@include("templates.header")
<div class="body-template container">
<div class="signin container">
   <div class="signin-title">
     <h2>LOGIN DE ACESSO</h2>
   </div>

   @if(session('error'))
    @include('/templates/alert-message', ['error' => session('error')])
   @endif
   <div class="form-item">
     <form method="POST" action="{{route('login.post')}}">
         @csrf
         <div class="form-group-input">
            <div class="input-item">
                <label for=""> E-mail:</label>
                <input type="email" name="email"/>
                <div class="msg-error">Campos obrigatórios*</div>
            </div>
         </div>
         <div class="form-group-input">
            <div class="input-item">
                <label for=""> Senha:</label>
                <input type="password" name="password"/>
                <div class="msg-error">Campos obrigatórios*</div>
            </div>
         </div>
         <div class="button">
            <button>Acessar</button>
         </div>

         <div class="form-link">
            <p>Anda não tem cadastro?</p>
            <a href="/auth/signup">Cadastre-se</a>
         </div>
     </form>
   </div>
</div>
@include("templates.footer")
</div>