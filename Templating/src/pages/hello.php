<!-- framework/hello.php -->
<?php //$name = $request -> get('name','World') ?>
<!--Hello --><?php //echo htmlspecialchars(isset($name) ? $name : 'World',ENT_QUOTES,'UTF-8') ?>
Hello <?php echo htmlspecialchars($name,ENT_QUOTES,'UTF-8') ?>
<!-- $input = $request->get('name', 'World');
 $response->setContent(sprintf('Hello %s', htmlspecialchars($input, ENT_QUOTES, 'UTF-8')));
-->