<h1>Edit uw Profiel hier</h1>

<?php if (session()->has('success')): ?>
    <p><?= session('success') ?></p>
<?php endif ?>

<?= helper('form');
form_open('profiel/updateProfiel', array('method' => 'POST')) ?>


<label for="username">Username:</label>
<input type="text" name="username" value="<?= $user['username'] ?>">
<?php if (isset($validation) && $validation->getError('username')): ?>
    <p><?= $validation->getError('username') ?></p>
<?php endif ?>

<!-- <label for="password">Password:</label>
<input type="password" name="password" value="">  -->
<?php if (isset($validation) && $validation->getError('password')): ?>
    <p><?= $validation->getError('password') ?></p>
<?php endif ?>

<label for="email">Email:</label>
<input type="email" name="email" value="<?= $auth_email ?>">
<?php if (isset($validation) && $validation->getError('email')): ?>
    <p><?= $validation->getError('email') ?></p>
<?php endif ?>

<label for="leeftijd">Leeftijd:</label>
<input type="leeftijd" name="leeftijd"  value="<?= $user['leeftijd'] ?>">
<?php if (isset($validation) && $validation->getError('leeftijd')): ?>
    <p><?= $validation->getError('leeftijd') ?></p>
<?php endif ?>

<label for="geboortedatum">Geboortedatum:</label>
<input type="date" name="geboortedatum" value="<?= $user['geboortedatum'] ?>">
<?php if (isset($validation) && $validation->getError('geboortedatum')): ?>
    <p><?= $validation->getError('geboortedatum') ?></p>
<?php endif ?>
<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

<button type="submit" name="update" value="Update">Save changes</button>

