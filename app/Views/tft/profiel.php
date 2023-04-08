<h1>Edit Profile</h1>

<?php if (session()->has('success')): ?>
    <p><?= session('success') ?></p>
<?php endif ?>

<?= helper('form');
form_open('/profile/update') ?>

<label for="username">Username:</label>
<input type="text" name="username" value="<?= $user['username'] ?>">

<label for="password">Password:</label>
<input type="password" name="password" value="">
<?php if (isset($validation) && $validation->getError('password')): ?>
    <p><?= $validation->getError('password') ?></p>
<?php endif ?>

<label for="email">Email:</label>
<input type="email" name="email" value="<?= $user['email'] ?>">
<?php if (isset($validation) && $validation->getError('email')): ?>
    <p><?= $validation->getError('email') ?></p>
<?php endif ?>

<label for="age">Age:</label>
<input type="number" name="age" value="<?= $user['age'] ?>">
<?php if (isset($validation) && $validation->getError('age')): ?>
    <p><?= $validation->getError('age') ?></p>
<?php endif ?>

<button type="submit">Save changes</button>

<?= form_close() ?>