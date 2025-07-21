<?php $_GET['url'] = (isset($_GET['url'])) ? $_GET['url'] : "produtos";?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Mini ERP - BH Commerce</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container px-4">
      <a class="navbar-brand" href="?url=produtos">ERP</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link<?php if (preg_match("/produto/", $_GET['url'])){?> active<?php }?>" href="?url=produtos">Produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?php if (preg_match("/cupo/", $_GET['url'])){?> active<?php }?>" href="?url=cupons"<?php if (preg_match("/cupo/", $_GET['url'])){?> active<?php }?>>Cupons</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?php if (preg_match("/pedido/", $_GET['url'])){?> active<?php }?>" href="?url=pedidos">Pedidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?php if (preg_match("/carrinho/", $_GET['url'])){?> active<?php }?>" href="?url=carrinho">Carrinho</a>
          </li>
        </ul>
      </div>
    </div>
  </header>