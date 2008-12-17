<?php
// acessando somente como array
$array = new ArrayObject(array('name' => 'Rafael Souza', 'username' => 'rafaelss'));
echo 'Nome: ', $array['name'], "\n";
echo 'Usu�rio: ', $array['username'], "\n";

// acessando somente como objeto
$array = new ArrayObject(array('name' => 'Rafael Souza', 'username' => 'rafaelss'), ArrayObject::ARRAY_AS_PROPS);
echo 'Nome: ', $array->name, "\n";
echo 'Usu�rio: ', $array->username, "\n";

echo '>>>>>>>>>>>: ', $array['name'], "\n";

// acessando de qualquer jeito
$array = new ArrayObject(array('name' => 'Rafael Souza', 'username' => 'rafaelss'), ArrayObject::ARRAY_AS_PROPS | ArrayObject::STD_PROP_LIST);
echo 'Nome: ', $array['name'], "\n";
echo 'Usu�rio: ', $array['username'], "\n";

echo 'Nome: ', $array->name, "\n";
echo 'Usu�rio: ', $array->username, "\n";
?>