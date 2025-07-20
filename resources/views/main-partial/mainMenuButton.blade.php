<div class="container-menu-button">
    <div class="home-mmb">
      <a href="/">
         <i class="fa-solid fa-house home-mmb-button"></i>        
      </a>
      <p>Home</p>
    </div>
    <div class="category-mmb">
      <a href="/category">
         <i class="fas fa-boxes"></i>
         {{-- <img class="category-mmb-button" src="https://cdn-icons-png.flaticon.com/512/3502/3502688.png" alt=""> --}}
      </a>
      <p>Category</p>
    </div>
    <div class="cart-mmb">
      <a href="/cart">
         <i class="fa-solid fa-cart-shopping cart-mmb-button"></i>
      </a>
      <p>Cart</p>
    </div>
    <div class="mall-mmb">
      <a href="/mall">
         <i class="fab fa-shopify"></i>
      </a>
      <p>Mall</p>
    </div>

    @auth
      <div class="account-mmb">
         <a href="/account">
            @if (auth()->user()->buyer_detail)
               @if (auth()->user()->buyer_detail->profile_pict)
                  <img class="account-mmb-button" src="{{ url('storage/'.auth()->user()->buyer_detail->profile_pict) }}" style="border-radius: 50%;" alt="">
               @else
                  <img class="account-mmb-button" src="{{ url('img/temp-img-profile.png') }}" style="border-radius: 50%;" alt="">
               @endif
            @else
               <img class="account-mmb-button" src="{{ url('img/temp-img-profile.png') }}" style="border-radius: 50%;border;1px solid white;" alt="">
            @endif
            
            
         </a>
         <p>Me</p>
      </div>   
    @else
      <div class="login-mmb">
         <a href="/login">
            <i class="fas fa-user"></i>
         </a>
         <p>Log in</p>
      </div>
       
    @endauth

</div>