<style>
nav {
  background-color: #333;
  height: 50px;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
} 
</style>

<?php if(auth()->user()->role == "klant"): 
  echo '
  <nav>
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="/lessen">Lessen</a></li>
      <li><a href="/rooster">Rooster</a></li>
      <li><a href="/profiel">Profiel</a></li>
      <li><a href="/logout">Logout</a></li>
    </ul>
  </nav>
      ';?>

<?php elseif(auth()->user()->role == "admin" || "instructeur"):
  echo '<nav>
  <ul>
  <li><a href="/">Home</a></li>
    <li><a href="/create">Create</a></li>
    <li><a href="/lessen">Lessen</a></li>
    <li><a href="/admin">Admin</a></li>
    <li><a href="/rooster">Rooster</a></li>
    <li><a href="/profiel">Profiel</a></li>
    <li><a href="/logout">Logout</a></li>
  </ul>
</nav>';?>
<?php endif ?>