




<?php if(auth()->user()->role == "klant"){
  exit;
}?>

<form action="" method="post">
  <?= csrf_field() ?>

  <label for="title"> kies wat u wilt gaan doen</label>
  <select value="<?= set_value('omschrijving') ?>" name="title" id ="title">
    <option value="kickboxen">kickboxen</option>
    <option value="fitness">fitness</option>
  </select>
<br>
  voer het aantal mensen<br>
  <input value="<?= set_value('deelnemers') ?>" type="number" max="20" name="" />
  <br>
  Instructeur:
  <input name="body" value='<?php echo(auth()->user()->username) ?>' disabled><br>
  Kies een tijd en datum:
  <input type="date">
  <input type="time" step='1'>
  <br>

  <input type="submit" name="submit" value="Voeg de les toe">
</form>