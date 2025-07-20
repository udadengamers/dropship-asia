
// // const { event } = require("jquery");

// const mmb = document.querySelector('.container-menu-button');
// const bodyMain = document.querySelector('.body-container');
// function MMB(){
//   mmb.addEventListener('click',(e)=>{
//       function Home() {
//         if (e.target.classList.contains('home-mmb-button')) {
//             // console.log("ok")
//             fetch('/')
//             .then(response => response.text())
//             .then(data => {
//               bodyMain.innerHTML = data;
//             });
//         };
//       }
//       Home();
  
//       function Category() {
//         if (e.target.classList.contains('category-mmb-button')) {
  
//           fetch('/product-detail/?product_id=1&shop_id=1',{
//             method: ('GET'),
//           })
//           .then(response => response.text())
//           .then(data => {
//             bodyMain.innerHTML = data;
  
//             document.querySelector('.quantity-detail').addEventListener('click',function(e){
//               e.preventDefault();
//               console.log(e.target)
//               if (e.target.classList == "decrease-detail") {
//                 let valBox = document.querySelector('.quantity-detail-product')
//                 if (parseInt(valBox.value) > 1){
//                   valBox.value = parseInt(valBox.value) - 1
//                 }
//               }else if (e.target.classList == "increase-detail"){
//                 let valBox = document.querySelector('.quantity-detail-product')
//                 valBox.value = parseInt(valBox.value) + 1
//               }
//             })
//             document.querySelector('.addtocart-button-detail').addEventListener('click',function(e){
//               e.preventDefault(); // digunakan agar gak redirect ke halaman lain saat di click
//               SubmitForm();
//             })
  
//           });
//         };
//       }
//       Category();
  
//       function Cart() {
//         if (e.target.classList.contains('cart-mmb-button')) {
//            // console.log("ok")
//            fetch('/cart')
//            .then(response => response.text())
//            .then(data => {
//              bodyMain.innerHTML = data;
//            });
//        };
//       }
//       Cart();
  
//       function Mall() {
//         if (e.target.classList.contains('mall-mmb-button')) {
//             // console.log("ok")
//             fetch('/mall')
//             .then(response => response.text())
//             .then(data => {
//               bodyMain.innerHTML = data;
//             });
//         };
//       }
//       Mall();
  
      
//       function Login() {
//             // console.log("ok")
//             fetch('/login')
//             .then(response => response.text())
//             .then(data => {
//               bodyMain.innerHTML = data;  
//               document.querySelector('.login-form').addEventListener('click', function(event) {
//                 if (event.target.innerHTML == "sign up"){
//                   console.log("register area");
//                   fetch('/register',{
//                     method: 'GET',
//                   })
//                   .then(response => response.text())
//                   .then(data => {
//                     bodyMain.innerHTML = data;
//                     document.querySelector('.cancel-signup').addEventListener('click', function(event) {
//                       if (event.target.innerHTML == "&lt;- Back"){
//                         console.log("back");
//                         LoginButton();
//                       }
//                     });
//                     document.getElementById('signupForm').addEventListener('submit', function(event) {
//                       event.preventDefault(); // Prevent the default form submission behavior
//                       var form = event.target; // Get the form element
//                       var formData = new FormData(form); // Create a new FormData object with the form data
                    
//                       // Send the form data to the server for validation
//                       fetch('/register', {
//                         method: 'POST',
//                         body: formData
//                       })
                      
//                       .then((response) => response.json())
//                       .then(data => {
    
//                         if (data.error) {
//                           let errorMessage = '';
//                           for (const key in data.error) {
//                             errorMessage += data.error[key][0] + '\n';
//                           }
//                           alert(errorMessage);
//                         } else {
//                           alert(data.message)
//                           LoginButton();
//                         }
    
//                       })
//                       .catch(function(error) {
//                         console.error('There was a problem with the fetch operation:', error);
//                       });
//                     });
//                   });
//                 }
//               });
//             });
           
//       }// end if button login
//       function LoginButton() {
//         if (e.target.classList.contains('login-mmb-button')) {
//           Login();
//         };   
//       }
//       LoginButton();
     
      
//       function Account() {
//         if (e.target.classList.contains('account-mmb-button')) {
//           // console.log("ok")
//           fetch('/account')
//           .then(response => response.text())
//           .then(data => {
//             bodyMain.innerHTML = data;
//           });
//         };
//       }
//       Account();
// // ===============================================RESOURCE====================================== //
//       function SubmitForm(){
//         let formBody = document.getElementById('add-to-cart');
//         const formData = new FormData(formBody);
//         const user_id = formData.get('user_id')
//         if (user_id == "0"){
//           alert('cannot add to cart, you need login first')
//           LoginButton();
//         }else{
//           fetch('/add-to-cart', {
//             method: 'POST',
//             body: formData
//           })
//           .then(response => response.json())
//           .then(data => {
//             console.log(data.request);
//             alert('successful add to cart')
//             fetch('/product-detail/?product_id=1&shop_id=1',{
//               method: ('GET'),
//             })
//             .then(response => response.text())
//             .then(data => {
//               bodyMain.innerHTML = data;
//               MMB();
        
//             })
//           })
//           .catch(error => {
//             console.error(error);
//           });
//         }
        
//       }
//   }); 
// }
// MMB();

