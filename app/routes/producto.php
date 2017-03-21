<?php
namespace DBinv;
$app->get('/',function()use($app){

    $productos = productosQuery::create()->find();
    $this->view->render($response, 'producto.html',$productos);
    
})->setName('productos.index');