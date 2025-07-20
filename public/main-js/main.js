

// -------------------------- IMAGE SLIDESHOW ----------------------------//
if (document.querySelector('.sec4Card')) {
  
  let sec4Card = document.querySelector('.sec4Card') ;
  let imgBasic = document.querySelector('.sec4Card .imgBasic');
  let bullets = document.querySelectorAll('.bullet');
  
  
  let imgBShow = document.querySelector('.imgBShow');
  let imgB = document.querySelectorAll('.imgB');
  
  setInterval(slideShowImgB,8000);
  function slideShowImgB() {    
      
      let bullet = document.querySelector('.sec4Card .activeBullet');
      
      let bn = parseFloat(bullet.id) + 1;
      if (bn == parseFloat(bullets.length)+1) {
          bn = 1;        
      }
      if (bullet.parentNode.nextSibling.nextSibling != null){
          bullet.className = 'bullet';
          bullet.parentNode.nextSibling.nextSibling.querySelector('.sec4Card .bullet').className = 'bullet activeBullet';
          imgBasic.innerHTML = '<img class="imgBShow" src="img/'+bn+'.jpg" alt="">';
  
      }else{
          let bullets= document.querySelectorAll('.bullet');
          bullet.className = 'bullet';
          bullets[0].className = 'bullet activeBullet';
          imgBasic.innerHTML = '<img class="imgBShow" src="img/'+bn+'.jpg" alt="">';
      }
      
  }
  
  // -----------------------CLICK BULLETS---------------------//
  bullets.forEach(function(e){
    e.addEventListener('click',(ev)=>{
      if (ev.target.className == 'bullet') {
        bullets.forEach(function(bullet){
          bullet.className = 'bullet';
        }); 
        ev.target.classList.add("activeBullet");
        imgBasic.innerHTML = '<img class="imgBShow" src="img/'+ev.target.id+'.jpg" alt="">';
      }
      });
  });
  
}

// ============================== MODAL ALERT ================================
document.querySelector('.modal-alert').addEventListener('click',e=>{
  if (e.target.classList.value == "bi bi-x-lg") {
    document.querySelector('.modal-alert').classList.add('d-none');
  }
});
if (document.querySelectorAll('.invalid-feedback')) {
  document.querySelectorAll('.invalid-feedback').forEach(inv=>{
    if (inv.innerHTML != "") {
      document.querySelector('.notice-message p').innerHTML = "";  
      document.querySelector('.modal-alert').classList.remove('d-none');
      document.querySelector('.notice-message p').innerHTML = inv.innerHTML;    
    }
  });
}

