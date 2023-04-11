<h1>Edit Profile</h1>

<?php if (session()->has('success')): ?>
    <p><?= session('success') ?></p>
<?php endif ?>

<?= helper('form');
form_open('/profile/update') ?>

<label for="username">Username:</label>
<input type="text" name="username" value="<?= $user['username'] ?>">
<?php if (isset($validation) && $validation->getError('username')): ?>
    <p><?= $validation->getError('username') ?></p>
<?php endif ?>

<label for="password">Password:</label>
<input type="password" name="password" value=""> 
<?php if (isset($validation) && $validation->getError('password')): ?>
    <p><?= $validation->getError('password') ?></p>
<?php endif ?>

<label for="email">Email:</label>
<input type="email" name="email" value="<?= $auth_email ?>">
<?php if (isset($validation) && $validation->getError('email')): ?>
    <p><?= $validation->getError('email') ?></p>
<?php endif ?>

<label for="geboortedatum">geboortedatum:</label>
<input type="date" name="geboortedatum" value="<?= $user['geboortedatum'] ?>">
<?php if (isset($validation) && $validation->getError('geboortedatum')): ?>
    <p><?= $validation->getError('geboortedatum') ?></p>
<?php endif ?>

<button type="submit">Save changes</button>

<?= form_close() ?>