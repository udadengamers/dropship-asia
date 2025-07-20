$(document).on('click', '.item', function() {
    // Your code here
});

if (document.querySelectorAll('#cart-shop-label')) {
    document.querySelectorAll('#cart-shop-label').forEach(label=>{
        label.addEventListener('click',(e)=>{
            if (e.target.previousSibling.previousSibling.checked) {
                e.target.previousSibling.previousSibling.checked = false
                document.querySelectorAll('#'+e.target.getAttribute("value")).forEach(c=>{
                    c.checked = false
                });
            } else {
                e.target.previousSibling.previousSibling.checked = true
                document.querySelectorAll('#'+e.target.getAttribute("value")).forEach(c=>{
                    c.checked = true
                });
            }
            
        })
    })
}


let shopIDSelected = [];
let cartIDSelected = [];  
let shopNotes = [];  
let shipmentID = 3;
let ongkir = 0;

function cartEvent(){
    
}

if (document.querySelector('.cart-shop-body')) {

    document.querySelector('.select-shipment').addEventListener('change',e=>{
        shipmentID = e.target.options[e.target.selectedIndex].getAttribute('id')
        ongkir = document.querySelector('#select-shipment').value

        console.log(e,shipmentID, ongkir)
    })

    document.querySelectorAll('#shop-name-cart-chkbox').forEach(label=>{
        label.addEventListener('click',(e)=>{
            console.log(e)
            if (e.target.checked) {
                document.querySelectorAll('#'+e.target.getAttribute("value")).forEach(c=>{
                    c.checked = true
                });
            } else {
                document.querySelectorAll('#'+e.target.getAttribute("value")).forEach(c=>{
                    c.checked = false
                });
            }           
            
        })      
    })
    document.querySelectorAll('.cart-shop-body').forEach(button=>{
        button.addEventListener('click',function(e){    
            
            let valPrc = 0;
            let valQty = 0;
            let shipmentAmount = 0;
            let shipmentQty = 0;
            cartIDSelected = [];
            shopIDSelected = [];
            shipmentID = 3;
            shopNotes = [];
            let isCheked = 0;
            
            let selectElement = document.getElementById("select-shipment");
            let selectedOption = selectElement.options[selectElement.selectedIndex];

            document.querySelectorAll('input[type="checkbox"][cart="item"]:checked').forEach(data=>{
                valPrc+= parseFloat(data.parentNode.querySelector('#item-prc-val').value)
                valQty+= parseFloat(data.parentNode.querySelector('#item-qty-val').value)
                cartIDSelected.push(data.getAttribute('cartID'))
                shopNotes.push(data.getAttribute('value'))
                shipmentAmount = document.querySelector('.select-shipment').value      
            }) 
            // console.log(shipmentID)
            document.querySelectorAll('input[type="checkbox"][id="shop-name-cart-chkbox"]:checked').forEach(data=>{
                console.log('checkbox')
                let sum = 0
                data.parentNode.querySelectorAll('#item-prc-val').forEach(val=>{
                    sum += parseFloat(val.value)
                })
                shopIDSelected.push({
                    user_id:document.getElementById('checkout-user-id').value,
                    shop_id:data.getAttribute('shopid'),
                    note:data.parentNode.querySelector('#noteforseller').value,
                    total:sum,
                })
            })
            

            document.querySelectorAll('input[type="checkbox"][id="shop-name-cart-chkbox"]:checked').forEach(data=>{
                shipmentQty += parseFloat(1)                
            })             
            // shipmentAmount = document.querySelector('.select-shipment').value
            document.querySelector('#checkout-totalqty').innerHTML = valQty;
            document.querySelector('#shipment-qty').innerHTML = shipmentQty;
            document.querySelector('#shipment-amount').innerHTML = shipmentAmount*shipmentQty;
            document.querySelector('#checkout-subtotal').innerHTML = valPrc;
            shopArrayId = shopIDSelected
            //input form data
           
            if (document.querySelector('#checkout-subtotal').innerHTML != 0) {
                document.querySelectorAll('#checkout-total').forEach(total=>{
                    let num = valPrc+(shipmentAmount*shipmentQty) ;
                    num = parseFloat(num.toFixed(2));
                    total.innerHTML = num;
                    document.querySelector('#checkout-input-total').value = total.innerHTML = num ;           
                });                
            }else{
                document.querySelectorAll('#checkout-total').forEach(total=>{
                    total.innerHTML = 0;
                    document.querySelector('#checkout-input-total').value = total.innerHTML = 0 ;           
                });    
            }
            // console.log(document.querySelectorAll('#checkout-total'))
            
        }) 
    });

    // ============= NOTE FOR SELLER =================
    document.querySelectorAll('.note-for-seller').forEach(notebody=>{
        notebody.addEventListener('click',e=>{
            // console.log(e.target.classList.value)
            if (e.target.classList.value == "trigger-open-note"){
                // console.log('ok')
                if (e.target.nextElementSibling.classList.contains('d-none')) {
                    e.target.nextElementSibling.classList.remove('d-none')
                } else {
                    e.target.nextElementSibling.classList.add('d-none')
                }
                
            }
        });
    });


    // ===================================== CHECKOUT BUTTON ======================================
    document.getElementById('checkout-form').addEventListener('submit', function(event) {
        event.preventDefault();        
        // Send the form data to the server for validation
        fetch('/checkout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'url': '/checkout',
            "X-CSRF-Token": document.querySelector('input[name=_token]').value
        },
        body: JSON.stringify({
            'cartArray':shopIDSelected,
            'shipment_id':shipmentID,
            'shipment_price':ongkir,
            'payment_type' : document.getElementById("select-payment").value,
        })           
            
        })
        
        .then((response) => response.json())
        .then(data => {
            if (!data.message) {
                alert(data.description)
            } else {
                console.log(data)
                location.href = '/my-transaction'
            }
        })
        .catch(function(error) {
            console.log('There was a problem with the fetch operation:', error);
        });
    });
    
}






if (document.querySelector('.checkout-btn')){
    document.getElementById('checkout-btn').addEventListener('click',function(e){
        let checkAddressOne = document.getElementById('checking-address-checkout').getAttribute('addressone')
        let checkAddressTwo = document.getElementById('checking-address-checkout').getAttribute('addresstwo')

        if (document.getElementById('checkout-total').innerHTML == 0){
            alert('no item selected to checkout, Select Item from cart list first')
            e.preventDefault();
        } else if (document.querySelector('#select-shipment').value==0) {
            alert('Select shipment first')
            e.preventDefault();
        } else if (document.querySelector('#checkout-subtotal').innerHTML==0) {
            alert('no item selected to checkout, Select Item from cart list first')
            e.preventDefault();
        } else if (checkAddressOne=="" && checkAddressTwo=="") {
            console.log('kosong')
            alert('Please add your address first')
            e.preventDefault();
        }
       
              
    })

}

// =================== UPDATE QUANTITY CART ==========================
// *
// *

function updateValDB(cartId,qty) {

    fetch('/update-qty-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'url': '/checkout',
                "X-CSRF-Token": document.querySelector('input[name=_token]').value
            },
            body: JSON.stringify({
                'cart_id':cartId,
                'quantity':parseInt(qty),
            })   
        })
        
        .then((response) => response.json())
        .then(data => {
            console.log(data)

        })
        .catch(function(error) {
            console.log('There was a problem with the fetch operation:', error);
        });

}
function ItemQtyChange(button){   
    let crtID = button.getAttribute('crt-id');
    let prcBase = parseFloat(button.getAttribute('baseprc'));
    if (button.classList.value == "inc-qtycart-btn") {
        let numberQtyInc = parseFloat(button.previousElementSibling.value);
        numberQtyInc += 1;
        if (numberQtyInc <= parseFloat(button.getAttribute('stock'))) {
            let sum = prcBase*numberQtyInc;
            button.previousElementSibling.value = numberQtyInc;  
            button.parentNode.nextElementSibling.value = sum.toFixed(2)
            button.parentNode.parentNode.querySelector('#prc-item-cart-spawn').innerHTML = sum.toFixed(2)
            updateValDB(crtID,numberQtyInc);
        }
 
    }else if (button.classList.value == "dec-qtycart-btn") {
        let numberQtyDec = parseFloat(button.nextElementSibling.value);
        numberQtyDec -= 1;
        if ( numberQtyDec >= 1) {
            let sum = prcBase*numberQtyDec;
            button.nextElementSibling.value = numberQtyDec;              
            button.parentNode.nextElementSibling.value = sum.toFixed(2)
            button.parentNode.parentNode.querySelector('#prc-item-cart-spawn').innerHTML = sum.toFixed(2)
            updateValDB(crtID,numberQtyDec);
        }
    }
}

function closeandclearnote(button){
    button.parentNode.querySelector('#noteforseller').value="";
    button.parentNode.classList.add('d-none')
}
function submitandclosenote(button){
    button.parentNode.classList.add('d-none')
}
if (document.querySelector('.select-shipment')) {
    document.querySelector('.select-shipment').addEventListener('change',e=>{
        // console.log(e.target.options[e.target.selectedIndex].getAttribute('id'))
        let shipmentAmount = document.querySelector('#shipment-amount');
        let totalQty = document.querySelector('#shipment-qty');
        let total = document.querySelectorAll('#checkout-total');
        if (totalQty.innerHTML == 0){
            shipmentAmount.innerHTML = e.target.value;
        }else{
            shipmentAmount.innerHTML = e.target.value*(totalQty.innerHTML);
        }
        total.forEach(totArr=>{
            totArr.innerHTML = parseFloat(document.querySelector('#checkout-subtotal').innerHTML) + parseFloat(shipmentAmount.innerHTML)
        })
    })
}