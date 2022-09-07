<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrendZ | Online Store for Latest Trends</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/listing.css">
</head>

<body>
    <div class="container-fluid bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark p-4">
                <a class="navbar-brand mr-5 font-weight-bold" href="index.php">TrendZ</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link font-weight-bold" href="#">Home</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="nav-link font-weight-bold" href="#">Mens</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="nav-link font-weight-bold" href="#">Womens</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="nav-link font-weight-bold" href="#">Kids</a>
                        </li>

                    </ul>

                    <ul class="navbar-nav">

                        <?php if($this->session->userdata('login') != true){?>
                            <li class="nav-item active">
                                <a class="nav-link" href="login">Login / Register</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item active">
                                <div class="nav-link mycart"> <i class="fa fa-shopping-cart"></i> My Cart <span class="count">0</span></div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link"> | </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="rest/user/logout"><b>Logout</b></a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </nav>
        </div>
    </div>