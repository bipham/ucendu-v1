{{--@if (Session::has('flash_message'))--}}
    <div class="alert alert-{!! Session::get('flash_level') !!} row">
        {!! Session::get('flash_message') !!}
    </div>
{{--@endif--}}
