<?php

function breadcrumb($menu, $submenu)
{
    return '<div class="col-md-12">
                <div class="row page-titles">
                    <div class="col p-md-0">
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color: #324cdd;">' . $menu . '</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">' . $submenu . '</a></li>
                        </ol>
                    </div>
                </div>
            </div>';
}


function sayhello($pict, $role)
{
    return '<style>
    .card1 {
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        width: 100%;
        border-radius: 40px 40px 100px 40px;

    }

    .card1:hover {
        box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2);
    }

    /* Card1 image dark filter */
    .card1-img-top {
        border-radius: 40px 40px 100px 40px;
        width: 100%;
        height: 300px;
        object-fit: cover;
        filter: brightness(73%);

    }

    .card1-footer {
        font-size: 12px;
        font-weight: normal;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        color: grey;
        background-color: #eeeeee !important;
        /*filter: brightness(100%); */
    }
</style>
<div class="col-12 mb-3">
<div id="breadcrumb">
    <div class="card1" style="width:100%;">
        <img class="card1-img-top" src="' . base_url("assets/svg/" . $pict) . '" alt="Card1 image">
        <div class="card-img-overlay">
            <div class="col-md-12 d-flex h-100">
                <div class="row justify-content-center align-self-center">
                    <h1 style="color: white;">Hello, ' . $role . '</h1>
                    <h4 class="card1-text" style="color: white;">Laman ini akan menyajikan berbagai informasi sesuai dengan hak akses dan kewenangan anda.</h4>
                    <div class="row justify-content-right align-self-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
';
}
