<style>
 form {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 400px;
    margin: 0 auto;
  }
  h2 {
    text-align: center;
    margin-top: 50px;
  }

  label {
    font-weight: bold;
    margin-top: 20px;
    margin-bottom: 20px;
  }

  
  select {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
    max-width: 300px;
    margin-bottom: 20px;
  }

  input[type="submit"] {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 50px;
  }

  input[type="submit"]:hover {
    background-color: #3e8e41;
  }
</style>


<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>
<form action="/create" method="post">
<?= csrf_field() ?>
    <br>
    <select name="mood">
        <option value="<?= set_value('mood', 'happy') ?>">Happy</option>
        <option value="<?= set_value('mood', 'sad') ?>">Sad</option>
        <option value="excited" <?php echo set_select('mood', 'excited'); ?>>Excited</option>
        <option value="relaxed" <?php echo set_select('mood', 'relaxed'); ?>>Relaxed</option>
        <option value="angry" <?php echo set_select('mood', 'angry'); ?>>Angry</option>
    </select>
    <label for="aantekeningen">Note</label>
    <textarea id="aantekening" name="aantekening"></textarea>
    <br>
    <br>
    <input type="submit" value="Submit">    
</form>