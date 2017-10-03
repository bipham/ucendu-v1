<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 9/14/2017
 * Time: 10:44 PM
 */
?>
@extends('layout.masterNoMenu')
@section('meta-title')
    Create new genre story
@endsection
@section('css')

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-5 text-center">
                @include('utils.message')
                {{--@include('errors.input')--}}
                <form role="form" action="{!! url('createNewGenreStory') !!}" method="POST">
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    <h1>Tạo Genre Story</h1>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Genre" id="genre" name="genre" required>
                    </div>
                    <CENTER>
                        <button type="submit" class="btn btn-lg btn-warning">
                            Create
                        </button>
                    </CENTER>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{--<script src="{{asset('public/js/admin/upload.js')}}"></script>--}}
@endsection

