if (document.querySelector('.edit-profile')){
    document.querySelector('.edit-button-container').addEventListener('click',function(e){
        let editbodyall = document.querySelectorAll('.edit-profile');
            editbodyall.forEach(input=>{
                input.classList.add("d-none");

        })   
        let editbody = document.querySelector('#data-change');
        editbody.classList.remove("d-none");
    });
    function pcModal(button){
        if (document.getElementById('mailconfirm')) {
            let editbodyall = document.querySelectorAll('.edit-profile');
            editbodyall.forEach(input=>{
                    input.classList.add("d-none");
    
            })   
            let editbody = document.querySelector('#password-change');
            editbody.classList.remove("d-none");
            
        }else{
            alert('Please add your email first to change password')
        }
    }

    document.querySelector('.address-button-change').addEventListener('click',function(e){
        let editbodyall = document.querySelectorAll('.edit-profile');
            editbodyall.forEach(input=>{
                input.classList.add("d-none");

        })   
        let editbody = document.querySelector('#address-change');
        editbody.classList.remove("d-none");
    });

    document.querySelector('.profile-img').addEventListener('click',function(e){
        // console.log(e.target.parentNode.parentNode.parentNode)
        let editbodyall = document.querySelectorAll('.edit-profile');
            editbodyall.forEach(input=>{
                input.classList.add("d-none");

        })   
        let editbody = document.querySelector('#image-change-modal');
        editbody.classList.remove("d-none");
    });

    document.querySelectorAll('.cancel-edit').forEach(button=>{
        button.addEventListener('click',function(e){
            let editbody = document.querySelectorAll('.edit-profile');
            editbody.forEach(input=>{
                input.classList.add("d-none");

            })            
            const inputElements = document.querySelectorAll("input, textarea");
            inputElements.forEach(input => {
                input.value = "";
            });
        });    

    });
}

function passwordChange(button){
    let user_id= button.getAttribute('data')
    let token = $("meta[name='csrf-token']").attr("content");
    let email = document.getElementById('mailconfirm').value;
    let url = "/send-mail-pc?cp_by_email="+user_id+'&email='+email;
    button.disabled = true;
    button.textContent = "Sending...";

    // console.log(url)
    fetch(url, {
        method: 'get',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'url': '/checkout',
            "X-CSRF-Token": token
        }
    })
    .then((response) => response.json())
    .then(data => {
        console.log(data)
        if (data.message) {
            button.disabled = false;
            button.textContent = "Send Verification Code";
            alert('Success sending, please check your email now')
        }else{
            alert('Failed sending, please making sure your email right')
            return location.href = '/account'
        }
    })
    .catch(function(error) {
        alert(error)
    });
}