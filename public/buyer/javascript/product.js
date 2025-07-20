// ======================== PRODUCT DETAIL ===========================

if (document.querySelector('.product-detail-body')) {
    let radios = document.getElementsByName('stock_id');
    let priceBody = document.querySelector('.price-detail-body prc');
    let stockBody = document.querySelector('.stock-detail-body span');

    priceBody.innerHTML = radios[0].getAttribute('price');
    stockBody.innerHTML = radios[0].getAttribute('stock');
    radios[0].setAttribute('checked', 'checked');
    radios[0].previousElementSibling.classList.add('selected-variant-pdetail')
    


    function buynowvariantbasic(button){
        document.querySelectorAll('#label-variant-pdetail').forEach(label=>{
            label.classList.remove('selected-variant-pdetail')
        })
        button.classList.add('selected-variant-pdetail')
        document.querySelector('#stock-left-bn').innerHTML = button.getAttribute('stock');
        document.querySelector('.price-detail-body h3').innerHTML = "$"+button.getAttribute('price');
        document.querySelector('.stock-detail-body span').innerHTML =  button.getAttribute('stock');
        
    }

    if (document.querySelector('.quantity-detail')){
        document.querySelector('.quantity-detail').addEventListener('click',function(e){
            e.preventDefault();
            if (e.target.classList == "decrease-detail") {
            let valBox = document.querySelector('.quantity-detail-product')
            if (parseInt(valBox.value) > 1){
                valBox.value = parseInt(valBox.value) - 1
            }
            }else if (e.target.classList == "increase-detail"){
            let valBox = document.querySelector('.quantity-detail-product')
            if (parseInt(valBox.value)<stockBody.innerHTML) {
                valBox.value = parseInt(valBox.value) + 1
            }
            
            }
        });
    }
    //======================= BUY NOW MODAL ========================
    function buynowmodal() {
        document.querySelector('#buy-now-modal-checkout').classList.remove('d-none');
    }
    function closemodalbuynow() {
        document.querySelector('#buy-now-modal-checkout').classList.add('d-none');
    }
    function buynowvariant(button){
        document.querySelectorAll('#buy-now-label-variant').forEach(label=>{
            label.classList.remove('selected-variant-pdetail')
        })
        button.classList.add('selected-variant-pdetail')
        document.querySelector('#stock-left-bn').innerHTML = button.getAttribute('stock');
    }
    function buttonQuantity(button) {
        let val = parseInt(document.querySelector('.quantity-number-value').value)
        if (button.innerHTML == '+'){
            if (parseInt(document.querySelector('#stock-left-bn').innerHTML)>val) {
                document.querySelector('.quantity-number-value').value =  val+1                
            }
        }else{
            if (val>1) {
                document.querySelector('.quantity-number-value').value =  val-1
            }            
        }  
             
    }
    let variantBNModalDefault = document.querySelectorAll('#buy-now-label-variant');
    let radioVariantBuyNow = document.querySelectorAll('.radio-variant-buy-now');
    variantBNModalDefault[0].classList.add('selected-variant-pdetail')
    // console.log(radioVariantBuyNow)
    radioVariantBuyNow[0].checked = true;
    document.getElementById('bn-total').value = parseFloat(variantBNModalDefault[0].getAttribute('price'))
    document.getElementById('totalinner-bn').innerHTML = parseFloat(variantBNModalDefault[0].getAttribute('price'))
    const modalBuyNow = document.getElementById('buy-now-modal-checkout')
    
    document.querySelectorAll('#buy-now-label-variant').forEach(button=>{
        button.addEventListener('click', e=>{
            let total = 0;
            let qty = 0;
            let shpPriceEl = document.getElementById('shipment-select-buy-now');
            let shpPriceVal = parseFloat(shpPriceEl.options[shpPriceEl.selectedIndex].getAttribute('price'));
            qty = document.querySelector('.quantity-number-value').value;

            // console.log(e.target.getAttribute('stock'));
            total = parseFloat(e.target.getAttribute('price'));
            total += shpPriceVal;

            document.querySelector('.price-detail-body h3').innerHTML = "$"+e.target.getAttribute('price');
            document.querySelector('.stock-detail-body span').innerHTML = e.target.getAttribute('stock');
            let res = total*qty;
            document.getElementById('bn-total').value = res.toFixed(2);
            document.getElementById('totalinner-bn').innerHTML = res.toFixed(2);
        })
    })
    document.querySelector('.bnq-body').addEventListener('click',e=>{
        let qty = 0;
        let price = 0;
        let shpPriceEl = document.getElementById('shipment-select-buy-now');
        let shpPriceVal = parseFloat(shpPriceEl.options[shpPriceEl.selectedIndex].getAttribute('price'))

        price = parseFloat(modalBuyNow.querySelector('.selected-variant-pdetail').getAttribute('price'))
        qty = document.querySelector('.quantity-number-value').value
        let res = (price*qty) + shpPriceVal;
        document.getElementById('bn-total').value = res.toFixed(2);
        document.getElementById('totalinner-bn').innerHTML = res.toFixed(2);
    })
    document.querySelector('#shipment-select-buy-now').addEventListener('click',e=>{
        let total2 = 0
        let qty = 0
        let price = parseFloat(modalBuyNow.querySelector('.selected-variant-pdetail').getAttribute('price'))
        let shpPriceVal = parseFloat(e.target.options[e.target.selectedIndex].getAttribute('price'))

        qty = document.querySelector('.quantity-number-value').value
        total2 = (price*qty )+ shpPriceVal
        document.getElementById('bn-total').value = total2.toFixed(2);
        document.getElementById('totalinner-bn').innerHTML = total2.toFixed(2);
        // console.log(shpPriceVal)
    })
    document.querySelector('.bnbcheckout').addEventListener('click',e=>{
        let checkAddress = document.getElementById('checking-address-checkout')
        if (document.querySelector('#shipment-select-buy-now').value=='0') {
            alert('Please select shipment first')
            e.preventDefault();
        }
        if (checkAddress.getAttribute('addressone')=="" && checkAddress.getAttribute('addresstwo')=="" ) {
            alert('You dont have address destination,Please add your address first in profile')
            e.preventDefault();
        }
    })
}

function zoomImagePD(button) {
    let imgNow = button.getAttribute('imgName')
    document.querySelector('.modal-image-zoom').classList.remove('d-none')
    document.querySelector('.modal-image-zoom').querySelector('img').setAttribute('src',imgNow)
    
}
function modalImageZoom(button){
    button.classList.add('d-none')
}