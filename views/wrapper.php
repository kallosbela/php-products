<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <title>Címlap</title>
</head>
<body>
  <nav class="navbar navbar-expand navbar-light bg-danger">
    <div class="navbar-nav">
      <a href="/" class="nav-item nav-link <?php echo $params['activeLink'] === "/" ? "active" : "" ?>" >
        Címlap
      </a>
      <a href="/termekek" class="nav-item nav-link <?php echo $params['activeLink'] === "/termekek" ? "active" : "" ?>" >
        Termékek
      </a>
    </div>
  </nav>

  <?php echo $params['innerTemplate'] ?>

  <footer class="bg-danger text-center fixed-bottom text-lg-start">
    <div class="text-center p-3">
      Footer tartalom
    </div>
  </footer>
</body>
</html>