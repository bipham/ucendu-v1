<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 7/28/2017
 * Time: 2:14 PM
 */
?>
@extends('layout.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-4 text-center">
                @include('utils.message')
                {{--@include('errors.input')--}}
                <form role="form" action="{!!route('postLogin')!!}" method="POST">
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    <h2>Đăng nhập vào Ielts</h2>
                    {{--<h4>Kho hàng Trực tuyến Khổng lồ</h4>--}}
                    <br>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Địa chỉ Email" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Mật khẩu" id="password" name="password">
                    </div>
                    <div>
                        <a style="color: #000;" href="#"> <em>* Quên mật khẩu ?</em></a>
                    </div>
                    <div>
                        <CENTER>
                            <button type="submit" class="btn btn-lg btn-primary">
                                Đăng nhập
                            </button>
                        </CENTER>
                    </div>
                </form>
            </div>
        </div>
    </div> <br>
@endsection()
