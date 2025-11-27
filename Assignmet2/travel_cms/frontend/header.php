<?php
// frontend/header.php
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Travel Destinations</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link href="/frontend/css/bootstrap.min.css" rel="stylesheet">
<style>
.hero { background: linear-gradient(180deg, #0d6efd22, #fff); padding:40px 0; }
.card-img-top { height:180px; object-fit:cover; }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container">
    <a class="navbar-brand" href="/">Travel Destinations</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/frontend/destinations.php">Destinations</a></li>
        <li class="nav-item"><a class="nav-link" href="/frontend/about.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="/frontend/contact.php">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="/admin/login.php">Admin</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
