@extends('layouts.master')

@section('master_projek')
    Master Projek
@endsection

@section('title')
    Master Projek
@endsection

@section('content')
    <style>
        .hello-world {
            font-size: 15px;
            margin-left: 1.4%;
        }
    </style>

    <?php
    echo '<div class="hello-world">Hello, World!</div>';
    ?>
@endsection
