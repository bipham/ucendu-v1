<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 12-Jun-17
 * Time: 00:19
 */
$host = $_SERVER['SERVER_NAME'];
$host_names = substr($host, 6);
$home_url = 'http://' . $host_names;
$reading_url = $home_url . '/reading';
$vocabulary_url = $home_url . '/vocabularyReading';
?>
<header id="header" class="menu-header header-custom">
    <div class="container">
        <div class="header-top">
            <div class="right-custom pull-left">
                <ul id="navigation-my-web" class="navigation-custom col-md-12 col-sm-12 hidden-xs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">CONTACT US</a>
                    </li>
                </ul>
            </div>
            <div class="center-class logo-webstite">
                <a href="{{url('/')}}" class="brand-web">
                    <img src="{{url('/public/imgs/original/logo.jpg')}}" alt="Logo" class="img-custom img-logo-website">
                </a>
            </div>
            <div class="left-custom pull-right">
                @include('utils.actionCenterUser')
            </div>
        </div>
        <div class="header-bottom">
            <div id="main-nav">
                <ul id="main-navigation" class="navigation-custom col-md-12 col-sm-12 hidden-xs">
                    <li class="nav-item">
                        <a class="nav-link" href="{!! $home_url !!}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{!! $reading_url !!}">Reading</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{!! $vocabulary_url !!}">Vocabulary</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header><!-- /header -->
