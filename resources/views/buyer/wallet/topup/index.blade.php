@extends('layouts.main')
@section('bodyDR')
<style>
    .custom-file {
        position: relative;
        /* width: 500px; */
        height: 100px;
    }

    .img-cover {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
<link rel="stylesheet" href="{{ mix('css/upload.css') }}">
<div class="row mb-5 topup-buyer-body" style="">
    <div class="col p-0 mt-0">
        <form action="{{ route('topup.store') }}" method="post" enctype="multipart/form-data" style="background-color: ; margin-bottom:40px;">
            @csrf
            <div class="card text-start">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <span class="d-flex align-items-center">
                            <a href="/wallet">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </span>            
                        <p class="pt-0 mt-0 align-self-center">
                            <h4 class="pt-0 my-0" style="width:100%; text-align:center;">Choose Topup Method</h4>
                        </p>
                    </div>
                    <div class="p-5 mb-4 bg-light rounded-3">
                        <div class="container-fluid py-3">
                            <h4 class="display-7 fw-bold">Current Ballance</h4>
                            <p class="col-md-8 fs-4">
                                $ {{ number_format(auth()->user()->balance, 2) }}  
                            </p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Please Select a recharge network</label>
                        <select class="form-select form-select" name="recharge" id="recharge">
                            @foreach (config('recharge') as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4 text-center">
                        <img class="img-fluid" src="/img/barcode.jpg" alt="" srcset="">
                        <p class="text-danger mt-3">QR Code</p>
                        <p>recharge address</p>
                        TVHUBVtA4Noyh81aqYqd6LkEXBLJFww2t7
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Amount Recharge</label>
                        <input type="number" name="amount_submitted" id="amount_submitted" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="imaageLable">Upload transfer voucher</label>
                                    <div class="custom-file" style="height: auto;">
                                        <label id="parent" for="fileInput">
                                            <ul id="media-list" class="clearfix">
                                                <li class="myupload">
                                                    <span>
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </span>
                                                </li>
                                            </ul>
                                            {{-- <img src="https://via.placeholder.com/150" alt="Profile Picture" class="w-25 upload-image img-fluid img-cover" id="uploadImage"> --}}
                                        </label>
                                        <input type="file" class="custom-file-input" id="fileInput" style="display: none;" accept="image/png, image/gif, image/jpeg" name="images" onchange="previewImage(event)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group mb-4">
                        <label for="remarks_label">Remarks</label>
                        <textarea type="text" class="form-control" id="remarks" name="remarks">{{ old('remarks') }}</textarea>
                    </div> --}}
                </div>
            </div>
            <div class="card mt-3 mb-5 p-2" style="z-index: 1;background-color:white;">
                <button class="btn btn-primary-default w-100" style="background-color:orangered;color:white;" type="submit">Confirm Topup</button>
            </div>
        </form>
    </div>
</div>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            
            const parent = document.getElementById("parent");

            // Create a new img element
            const newImg = document.createElement("img");

            // Set the src and alt attributes of the img element
            newImg.src = reader.result;
            newImg.alt = "Image";

            // Add multiple classes to the new img element
            newImg.classList.add("w-25");
            newImg.classList.add("upload-image");
            newImg.classList.add("img-fluid");
            newImg.classList.add("img-cover");

            // Append the new img element to the parent label element
            parent.appendChild(newImg);

            // Get the element to remove
            const elemToRemove = document.getElementById("media-list");

            // Remove the element
            if (elemToRemove) {
                elemToRemove.remove();
            }
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<script src="{{ mix('js/upload.js') }}"></script>
@endsection