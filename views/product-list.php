<div class="card container p-3 m-3">
  <?php if ($params['isSuccess']) : ?>
    <div class="alert alert-success">
      Termék létrehozása sikeres
    </div>
  <?php endif ?>
  <form action="/termekek" method="post" class="form-group">
    <h5>Új termék rögzítése</h5>
    <input type="text" name="name" placeholder="Név" class="form-control mb-2" />
    <input type="number" name="price" placeholder="Ár forintban" class="form-control mb-2" />
    <input type="number" name="quantity" placeholder="Darabszám" class="form-control mb-2" />

    <input type="number" name="discount" placeholder="Kedvezmény százalékban" min="0" max="100" step="1" class="form-control mb-2" />

    <input type="text" name="description " placeholder="Leírás" class="form-control mb-2" />
    <button type="submit" class="btn btn-success">Küldés</button>
  </form>
  <hr>
  <?php foreach ($params['products'] as $product) : ?>
    <h3>
      <?php echo $product["name"] ?>
    </h3>
    <p>
      Ár: <?php echo $product["price"] . " Ft" ?>
    </p>
    <p>
      Darabszám: <?php echo $product["quantity"] . " db" ?>
    </p>
    <p>
      Kedvezmény: <?php echo $product["discount"] . " %" ?>
    </p>
    <p>
      Leírás: <?php echo $product["description"] ?>
    </p>

    <?php if ($product["id"] === $params["editedProductId"]) : ?>
      <form class="form-row form-group" action="/update-product?id=<?php echo $product['id'] ?>" method="post">
        <div class="col">
          <input type="text" name="name" class="form-control mb-2" value="<?php echo $product['name'] ?>">
        </div>
        <div class="col">
          <input type="number" name="price" class="form-control mb-2" value="<?php echo $product['price'] ?>">
        </div>
        <div class="col">
          <input type="number" name="quantity" class="form-control mb-2" value="<?php echo $product['quantity'] ?>">
        </div>
        <div class="col">
          <input type="number" name="discount" class="form-control mb-2" value="<?php echo $product['discount'] ?>" min="0" max="100" step="1">
        </div>
        <div class="col">
          <input type="text" name="description" class="form-control mb-2" value="<?php echo $product['description'] ?>">
        </div>
        <button href="/termekek" type="button" class="btn btn-outline-primary mb-2">
          Vissza
        </button>
        <button type="submit" class="btn btn-success mb-2">Küldés</button>
      </form>
    <?php else : ?>
      <div class="btn-group" role="toolbar">
        <a role="button" href="/termekek?szerkesztes=<?php echo $product["id"] ?>">
          <button class="btn btn-warning">
            Szerkesztés
          </button>
        </a>
        <form action="./delete-product?id=<?php echo $product["id"] ?>" method="POST">
          <button type="submit" class="btn btn-danger">Törlés</button>
        </form>
      </div>

    <?php endif; ?>
    <hr>
  <?php endforeach ?>
</div>