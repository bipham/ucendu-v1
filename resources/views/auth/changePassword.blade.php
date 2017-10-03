<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 8/15/2017
 * Time: 8:46 PM
 */
?>

@extends('layout.master')
@section('css')

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-4 text-center">
                @include('utils.message')
                {{--@include('errors.input')--}}
                <form role="form" action="{!!route('postChangePassword')!!}" method="POST">
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    <h2>Đăng nhập vào Ielts</h2>
                    {{--<h4>Kho hàng Trực tuyến Khổng lồ</h4>--}}
                    <br>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="New password" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm password" id="confirm_password" name="password_confirmation">
                    </div>
                    <div>
                        <CENTER>
                            <button type="submit" class="btn btn-lg btn-primary">
                                Change
                            </button>
                        </CENTER>
                    </div>
                </form>
            </div>
        </div>
    </div> <br>
@endsection()
@section('scripts')
    <script src="{{asset('public/js/client/changePassword.js')}}"></script>
@endsection