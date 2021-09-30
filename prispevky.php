<?php 
    require_once __DIR__.'/db.php';

    if (!empty($_POST)){
        $chyby=[];
        if (empty($_POST['autor'])){
            $chyby[]='Musíte vyplnit autora';
        }

        if (empty($_POST['text'])){
            $chyby[]='Musíte vyplnit text';
        }

        if(empty($chyby)){
            $query = $db->prepare('INSERT INTO prispevky(autor, text) VALUES(:autor, :text);');
            $query->execute([
                ':autor'=>$_POST['autor'],
                ':text'=>$_POST['text'],
            ]);

            header('Location: prispevky.php');
            exit();
        }
    }

    require 'header.php';
?>

  <div class="container">
    <div class="row">
      <h1 class="col-12 mt-4 mb-3">Nástěnka s příspěvky</h1>
    </div>
    <div class="row mt-4 mb-4">
      
    <?php 
        //$stmt = $db->query('SELECT * FROM prispevky');

        $query = $db->prepare('SELECT * FROM prispevky');
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        if($result) {
            foreach($result as $row) {
                //TODO
           

   echo '<div class="col-lg-4">
        <div class="bg-light px-4 py-3 border border-primary">
          <strong>'.htmlspecialchars($row['autor']).'</strong>
          <p>'.htmlspecialchars($row['text']).'</p>
        </div>
      </div>';

    }
} else {
    echo 'Nejsou tu výsledky';
}
?>

      <!-- <div class="col-lg-4">
        <div class="bg-light px-4 py-3 border border-primary">
          <strong>Josef Novák:</strong>
          <p>Lorem ipsum...</p>
        </div>
      </div> -->

    </div>
    <hr/>
    <div class="row">
      <div class="col-lg-9 col-xl-6">
        <form method="post">
          <div class="form-group">
            <label for="text">Text příspěvku:</label>
            <textarea class="form-control" id="text" name="text" rows="4" cols="40" required></textarea>
          </div>
          <div class="form-group">
            <label for="autor">Autor:</label>
            <input type="text" class="form-control" required id="autor" name="autor" />
          </div>
          <button type="submit" class="btn btn-primary">uložit příspěvek</button>
        </form>

        <?php
            if(!empty($chyby)){
                foreach($chyby as $chyba) {
                    echo $chyba;
                }
            }
        ?>
      </div>
    </div>
  </div>

</body>
</html>