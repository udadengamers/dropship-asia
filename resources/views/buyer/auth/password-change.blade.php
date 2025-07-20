@extends('layouts.main')
@section('bodyDR')
<div class="container mt-0 d-flex flex-column">
    <div class="row align-items-center justify-content-center min-vh-100">
      <div class="col-12 col-md-8 col-lg-4" style="margin-top: -100px;">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="mb-4 text-align-center" style="width:100%;text-align:center;">
              <h4>Change Password</h4>
              <hr>
            </div>
            <form action="/password-change?dataverify={{ auth()->user()->uuid }}" method="POST">
              @csrf
              <div class="mb-3" style="display: flex;justify-content:center;flex-direction:column;">
                <div class="password-body-signup">
                  <input type="password" id="new-password" name="password" class="password" required  placeholder="Enter your new password">
                  <button type="button" class="password-signup"><i class="bi bi-eye-slash"></i></button>          
                </div>
              </div>
              <div class="mb-3" style="display: flex;justify-content:center;flex-direction:column;width:100%; ">
                <div class="password-body-signup">
                  <input type="password" id="confirm-password" name="confirm-password"  placeholder="Confirm password" class="c-password @error('confirm-password') is-invalid  @enderror">          
                  <button type="button" class="password-signup"><i class="bi bi-eye-slash"></i></button>
                  @error('confirm-password')
                      <div class="invalid-feedback d-none">{{ $message }}</div>
                  @enderror
                </div>               
              </div>
              <div class="mb-3" style="display: flex;justify-content:center;width:100%;">
                <button type="submit" class="btn mt-3" style="background-color: orangered;color:white;width:250px;">Confirm</button>                           
              </div>
              <div class="mb-3" style="display: flex;justify-content:center;width:100%;">                          
                <span>Don't have an account? <a href="/signup">sign up</a></span>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
 
@endsection