@extends('layouts.main')
@section('bodyDR')
    <style>
        @media (max-width: 767.98px) {
            /* .container {
                max-width: 100% !important;
                padding: 0px;
            } */

            /* .row > * {
                padding: 0px;
            }

            .row {
                margin-right: 0px;
            } */
        }

        .round {
            position: relative;
        }

        .round label {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 50%;
            cursor: pointer;
            height: 28px;
            left: 0;
            position: absolute;
            top: 0;
            width: 28px;
        }

        .round label:after {
            border: 2px solid #fff;
            border-top: none;
            border-right: none;
            content: "";
            height: 6px;
            left: 7px;
            opacity: 0;
            position: absolute;
            top: 8px;
            transform: rotate(-45deg);
            width: 12px;
        }

        .round input[type="radio"] {
            visibility: hidden;
        }

        .round input[type="radio"]:checked+label {
            background-color: #66bb6a;
            border-color: #66bb6a;
        }

        .round input[type="radio"]:checked+label:after {
            opacity: 1;
        }
    </style>
    <div class="card record-buyer-topup">
        <div class="d-flex justify-content-center align-items-center">
            <span class="d-flex align-items-center">
                <a href="/wallet">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </span>            
            <p class="pt-0 mt-0 align-self-center">
                <h4 class="pt-0 my-0" style="width:100%; text-align:center;">Choose Topup Method</h4>
            </p>
        </div>
        <div class="row">
            <div class="col">
                <form action="{{ route('topup.index') }}" method="get" class="py-3" style="background-color: white;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img style="width:50px" src="/img/usdt.svg" alt="">
                            <span class="mx-3">USDT Topup</span>
                        </div>
                        <div class="round px-2">
                            <input type="radio" style="width:20px;" name="select" value="usdt" checked id="checkbox" />
                            <label for="checkbox"></label>
                        </div>
                    </div>
                    <div class="form-group mt-3 mb-3" >
                        <button class="w-100 btn btn-primary-default" style="background-color: orangered;color:white;">
                            Confirm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
