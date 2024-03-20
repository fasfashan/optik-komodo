<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Optik Komodo</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link href="<?php echo base_url().'assets/style.css'?>" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?php echo base_url().'assets/img/favicon.ico'?>">
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  </head>
  <style>
    #barang_paginate {
      display: flex;
      gap: 20px;
      justify-content: end;
      margin-bottom: 40px;
      align-items: center;
    }
    #barang_paginate span .paginate_button  {
      cursor: pointer;
      background-color: green;
      padding: 4px 8px;
      color: white;
    }
    #barang_next, #barang_previous {
      color: black;
       cursor: pointer;
    }
    #barang_paginate span {
      display: flex;
      gap: 4px;
    }
  </style>