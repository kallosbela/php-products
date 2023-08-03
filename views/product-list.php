<div class="card container p-3 m-3">
  <?php if ($params['isSuccess']): ?>
    <div class="alert alert-success">
      Termék létrehozása sikeres
    </div>
  <?php endif ?>
  <form action="/termekek" method="post">
    <input type="text" name="name" placeholder="Név" />
    <input type="number" name="price" placeholder="Ár" />
    <button type="submit" class="btn btn-success">Küldés</button>
  </form>

  <?php foreach($params['products'] as $product): ?>
    <h3>
      <?php echo $product["name"] ?>
    </h3>
    <p>
      <?php echo $product["price"] . " Ft" ?>
    </p>

    <form action="./delete-product?id=<?php echo $product["id"] ?>" method="POST">
      <button type="submit" class="btn btn-danger">Törlés</button>
    </form>

    <hr>
  <?php endforeach ?>
</div>