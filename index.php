<?php

$method = $_SERVER["REQUEST_METHOD"];
$parsed = parse_url($_SERVER["REQUEST_URI"]);
$path = $parsed["path"];

$routes = [
  "GET" => [
    "/" => "homeHandler",
    "/termekek" => "productListHandler"
  ],
  "POST" => [
    "/termekek" => "createProductHandler",
    "/delete-product" => "deleteProductHandler"
  ]
];

$handlerFunction = $routes[$method][$path] ?? "notFoundHandler";

$safeHandlerFunction = function_exists($handlerFunction) ? $handlerFunction : "notFoundHandler";

$safeHandlerFunction();

function compileTemplate($filePath, $params = []): string
{
  ob_start();
  require $filePath;
  return ob_get_clean();
}

function homeHandler()
{

  $homeTemplate = compileTemplate('./views/home.php');
  echo compileTemplate('./views/wrapper.php', [
    "innerTemplate" => $homeTemplate,
    "activeLink" => "/",
  ]);
}

function productListHandler()
{
  $content = file_get_contents("./products.json");
  $products = json_decode($content, true);
  $isSuccess = isset($_GET["siker"]);
  $productListTemplate = compileTemplate("./views/product-list.php", [
    "products" => $products,
    "isSuccess" => $isSuccess
  ]);

  echo compileTemplate('./views/wrapper.php', [
    'innerTemplate' => $productListTemplate,
    "activeLink" => "/termekek",
  ]);
}

function createProductHandler()
{
  $newProduct = [
    "id" => uniqid(),
    "name" => $_POST["name"],
    "price" => $_POST["price"]
  ];

  $content = file_get_contents("./products.json");
  $products = json_decode($content, true);

  array_push($products, $newProduct);

  $json = json_encode($products);
  file_put_contents("./products.json", $json);

  header("Location: /termekek?siker=1");
}

function deleteProductHandler() {
  $deletedProductId = $_GET["id"] ?? "";
  $products = json_decode(file_get_contents("./products.json"), true);
  
  $foundProductIndex = -1;

  foreach($products as $index => $product) {
    if ($product["id"] === $deletedProductId) {
      $foundProductIndex = $index;
      break;
    }
  }

  if ($foundProductIndex === -1) {
    header("Location: /termekek");
    return;
  }

  array_splice($products, $foundProductIndex, 1);

  $json = json_encode($products);
  file_put_contents('./products.json', $json);
  header("Location: /termekek");
}

function notFoundHandler()
{
  echo "Oldal nem található";
}
