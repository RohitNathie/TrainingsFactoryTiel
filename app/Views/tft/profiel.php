
<label for="username">Username</label>
<input type="text" name="username" value="<?= $user['username'] ?>">

<label for="password">Password</label>
<input type="password" name="password" value="">

<label for="email">Email</label>
<input type="email" name="email" value="<?= $user['email'] ?>">

<label for="age">Age</label>
<input type="number" name="age" value="<?= $user['age'] ?>">

<button type="submit">Save changes</button>