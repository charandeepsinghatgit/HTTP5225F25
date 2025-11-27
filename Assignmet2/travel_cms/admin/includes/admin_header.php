<?php
require_once __DIR__ . '/../../db_connect.php';
require_once __DIR__ . '/functions.php';
session_start();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin - Travel CMS</title>
<link href="/frontend/css/bootstrap.min.css" rel="stylesheet">
<link href="/admin/assets/fontawesome/css/all.min.css" rel="stylesheet">
<style>
body { padding-top: 70px; }
.sidebar { min-width: 220px; max-width: 220px; position: fixed; top: 70px; left: 0; bottom: 0; background:#f8f9fa; padding:15px; overflow:auto;}
.content { margin-left: 240px; padding:20px; }
.nav-link.active { font-weight:600; }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/admin/dashboard.php"><i class="fa fa-globe"></i> Travel CMS Admin</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/"><i class="fa fa-home"></i> Frontend</a></li>
        <li class="nav-item"><a class="nav-link" href="/admin/logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="sidebar">
  <div class="mb-3">
    <strong>Admin Menu</strong>
  </div>
  <ul class="nav flex-column">
    <li class="nav-item"><a class="nav-link" href="/admin/dashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
    <li class="nav-item"><a class="nav-link" href="/admin/destinations/index.php"><i class="fa fa-map-marker-alt"></i> Destinations</a></li>
    <li class="nav-item"><a class="nav-link" href="/admin/photos/index.php"><i class="fa fa-images"></i> Photos</a></li>
  </ul>
</div>
<div class="content">
