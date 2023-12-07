<!DOCTYPE html>
<html lang="en">

<head>
  <base href="{$basehref}">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{$title}</title>
  <link rel="icon" type="image/png" href="images/icon.png">
  <link rel='stylesheet' type='text/css' media='screen' href='css/dashboard_header.css'>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <link rel='stylesheet' type='text/css' media='screen' href='css/dashboard_globals.css'>
</head>

<body>

  <main>

    <div class="sidenav d-flex flex-column flex-shrink-0 p-3 text-white bg-dark fixed-top" style="width: 280px;">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        {* <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg> *}
        {* <span class="fs-4">Dashboard</span> *}
        <img class="logo" src="images/logo.png">
      </a>
      <hr>

      <ul class="nav nav-pills flex-column mb-auto gap-2">

        <li class="nav-item">
          <a href="home" class="nav-link text-white {if $endpoint eq "home"} active {/if}">
            <i class="fa-solid fa-house"></i> Home
          </a>
        </li>

        <li>
          <a href="tasks" class="nav-link text-white {if $endpoint eq "tasks"} active {/if}">
            <i class="fa-solid fa-list-check"></i> Tasks
          </a>
        </li>

        <li>
          <a href="licenses" class="nav-link text-white {if $endpoint eq "licenses"} active {/if}">
            <i class="fa-solid fa-key"></i> Keys
          </a>
        </li>

        <li>
          <a href="products" class="nav-link text-white {if $endpoint eq "products"} active {/if}">
            <i class="fa-solid fa-table"></i> Products
          </a>
        </li>

        <li>
          <a href="filemanager" class="nav-link text-white {if $endpoint eq "filemanager"} active {/if}">
            <i class="fa-solid fa-hard-drive"></i> File manager
          </a>
        </li>

        <li>
          <a href="tasks/statistics" class="nav-link text-white {if $endpoint eq "statistics"} active {/if}">
            <i class="fa-solid fa-chart-line"></i> Statistics
          </a>
        </li>


      </ul>

      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1"
          data-bs-toggle="dropdown" aria-expanded="false">
          <img src="https://avatars.githubusercontent.com/u/66163332?v=4" alt="" width="32" height="32"
            class="rounded-circle me-2">
          <strong>{$username}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
          {* <li><a class="dropdown-item" href="#">New project...</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li>
            <hr class="dropdown-divider">
          </li> *}
          <li><a class="dropdown-item" href="logout">Logout</a></li>
        </ul>
      </div>

</div>