@extends('layouts.main')
@section('bodyDR')
    <div class="service-chat-body">   
        <div class="container m-0 p-0">          
            <div class="row d-flex justify-content-center" style="width: auto">
                <div class="col-md-10 col-lg-8">            
                    <div class="card" id="chat2" style="height:80vh;">
                        
                        <div class="card-header d-flex justify-content-between align-items-center p-3" style="background-color: orangered;color:white;">
                            <div class="title" style="display: flex;">
                                <i class="fas fa-headset fa-2x mr-3"></i>
                                <h5 class="mb-0">  Service Chat</h5>
                            </div>
                            <a href="/account" class="text-white">
                                {{-- <h4>Back</h4> --}}
                                <i class="fas fa-times fa-2x"></i>
                            </a>
                        </div>
                        <div id="chatContainer" class="card-body" style="height:80%;overflow: auto;" data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">
                            
                            <div class="d-flex flex-row justify-content-start">
    
                                <i class="fas fa-headset fa-2x"></i>
                                <div>
                                    <div class="admin-chat">
                                        <p class="small p-2 ms-3 mb-1 " style="background-color: #f5f6f7;">Can i help you ?</p>
                                       
                                    </div>
                                    
                                </div>
                            </div>

                            @include('buyer.profile.chat')

                            
                            
                        </div>
                        <div class="image-upload-preview d-none" style="width:100%;display:flex;justify-content:center;">
                            <div id="imagePreview" style="width:100%;display:flex;justify-content:center;">
                            </div>
                            <button class="btn-danger" style="max-height: 40px;max-width:70px;border: none;border-radius: 10px;" onclick="removePreview()">Cancel</button>
                        </div>
                        <form class="card-footer text-muted d-flex justify-content-start align-items-center p-3" action="/service" method="POST"  enctype="multipart/form-data">
                            @csrf
                           

                            @if (auth()->user()->buyer_detail)
                                @if (auth()->user()->buyer_detail->profile_pict)
                                    <img class="img-user-service-chat" src="{{ url('storage/'.auth()->user()->buyer_detail->profile_pict) }}" style="border-radius: 50%;" alt="">
                                @else
                                    <img class="img-user-service-chat" src="{{ url('img/temp-img-profile.png') }}" style="border-radius: 50%;" alt="">
                                @endif
                            @else
                                <img class="img-user-service-chat" src="{{ url('img/temp-img-profile.png') }}" style="border-radius: 50%;border;1px solid white;" alt="">
                            @endif
                            <input type="text" name="message" class="service-chat-box form-control form-control-lg" id="exampleFormControlInput1" placeholder="Type message">
                            <label for="customFile" class="mx-3"><i class="fas fa-image"></i></label>
                            <label for="send-message-button" class="mx-3" style="font-size:20px;color:orangered;"><i class="fas fa-paper-plane"></i></label>
                            <input type="file" value="" class="custom-file-input d-none" name="img_msg" accept="image/jpeg, image/png, image/jpg" id="customFile" onchange="previewImage(event)">
                            <button type="submit" id="send-message-button" class="send-message-button d-none"></button>
                            
                        </form>
                    </div>
            
                </div>
            </div>
        
        </div>
          
    </div>

    <div class="modal-image-zoom d-none" onclick="modalImageZoom(this)">
        <div class="body-image-zoom mt-3">
            <img class="" src="{{ asset("/img/shopee.png") }}" alt="">
        </div>
        <span style="position:fixed;width:100%; height:100vh;background-color:black;opacity:0.3;"></span>
    </div>
    
<script>
    function previewImage(event) {
        var customFile = event.target;
        var file = customFile.files[0];
        var imagePreview = document.getElementById('imagePreview');
        document.querySelector('.image-upload-preview').classList.remove('d-none')
        if (file && file.type.startsWith('image/')) {
            var reader = new FileReader();

            reader.onload = function() {
            var imgElement = document.createElement('img');
            imgElement.src = reader.result;
            imgElement.style.maxWidth = '15%';
            imgElement.style.margin = '5px' ;
            imagePreview.innerHTML = '';
            imagePreview.appendChild(imgElement);
            }

            reader.readAsDataURL(file);
        } else {
            imagePreview.innerHTML = 'No preview available';
        }
    }
    function removePreview() {
        var imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = '';
        imgElement = null;
        document.querySelector('.custom-file-input').value = '';
        document.querySelector('.image-upload-preview').classList.add('d-none');
    }
    document.querySelector('.send-message-button').addEventListener('click', function(event) { 
        let msg=document.querySelector('.service-chat-box').value;
        let img=document.querySelector('.custom-file-input').value;
        if (msg == "" && img == "") {
            console.log('empty chat')
            alert('Cannot send empty chat');
            event.preventDefault();
        }   
    })
    document.addEventListener('DOMContentLoaded', function() {
        var myDiv = document.getElementById('chatContainer');
        var maxScrollY = myDiv.scrollHeight - myDiv.clientHeight;
        // console.log('Max Scroll Y:', maxScrollY);
        myDiv.addEventListener('scroll', function() {
            var scrollY = myDiv.scrollTop;
            // console.log('Scroll Y:', scrollY);
        });
        myDiv.scrollTop = myDiv.scrollHeight - myDiv.clientHeight;
    });

</script>

@endsection