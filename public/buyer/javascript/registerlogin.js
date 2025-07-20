if (document.querySelectorAll('.password-signup')) {
    document.querySelectorAll('.password-signup').forEach((i)=>{
        i.addEventListener('click',eye=>{
            if (eye.target.classList.value == "bi bi-eye-slash"){
                i.innerHTML = '<i class="bi bi-eye"></i>';
                i.previousElementSibling.setAttribute('type', 'text');
            } else if(eye.target.classList.value == "bi bi-eye"){
                i.innerHTML = '<i class="bi bi-eye-slash"></i>';
                i.previousElementSibling.setAttribute('type', 'password');
            }
    
        })
    });
}

function fgPassLogin(button) {
    document.querySelector('.modal-forgot-password').classList.remove('d-none')
}
function closeModalFPL(){
    document.getElementById('typeEmail').value = ""
    document.querySelector('.modal-forgot-password').classList.add('d-none')
}

if (document.querySelector('.signup-agreement-body')) {

    document.querySelector('.signup-button').addEventListener('click',e=>{
        if (document.querySelector('.signup-agreement-checkbox').value == "false"){
            console.log('ok')
            alert('You need check agreement first')
            e.preventDefault();
        }
    });
    document.querySelector('.signup-agreement-body').addEventListener('click',e=>{
        if(e.target.value == "false"){
            e.target.value = "true"

        }else if(e.target.value == "true"){
            e.target.value = "false"

        }
        console.log(e.target.value)
    })
}

function closeModalAggreement(button){
    button.parentNode.parentNode.classList.add('d-none')
}
function showRegisAgg(button){
    document.querySelector('.agreement-modal').classList.remove('d-none');
}
function showPrivAgg(button){
    document.querySelector('.agreement-privacy-modal').classList.remove('d-none');
}