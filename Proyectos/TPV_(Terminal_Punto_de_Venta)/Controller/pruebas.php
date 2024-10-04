<?php

/* -- FICHERO PARA PRUEBAS -- */
$texto = 'Goma suave de caucho sintético tipo "miga de pan". Para borrar uña amplia gama de lápices de grafito sobre toda clase de papeles. Altura: 13 mm. Anchura: 28 mm. Longitud: 41 mm. Sirve para recambios de las afilaborras COMPACT.';

echo mb_substr($texto,0,100, "UTF-8")."<br>";
echo substr($texto,0,100,);