<?php if(auth()->user()->role == "klant"):
  echo '<nav>
  <ul>
  <li><a href="/">Home</a></li>
  </ul>
</nav>';?>

<?php endif; ?>
<?php
if(auth()->user() && auth()->user()->role == "admin"){
    echo("<h2>Hier kunt u de rollen van gebruikers aanpasesen.</h2>");
    if($users) {
        echo "<form method='post' action='" . site_url('admin/update_roles') . "'>"; // Add form for updating user roles
        echo "<table>";
        foreach($users as $user):
            ?>
            <tr>
                <td>Naam: <?php echo $user->username; ?></td> 
                <td>Email: <?php echo $user->secret; ?></td>
                <td>
                    <select name="role[<?php echo $user->id; ?>]"> <!-- Add select box to choose role for each user -->
                        <option value="klant" <?php if($user->role == 'klant') echo 'selected'; ?>>Klant</option>
                        <option value="instructeur" <?php if($user->role == 'instructeur') echo 'selected'; ?>>Instructeur</option>
                        <option value="admin" <?php if($user->role == 'admin') echo 'selected'; ?>>Admin</option>
                    </select>
                </td>
            </tr>
            <?php
        endforeach;
        echo "</table>";
        echo "<input type='submit' value='Update Roles'>"; // Add submit button to update user roles
        echo "</form>";
    }
}
if(auth()->user()->role == "instructeur"){
    echo("<h2> Maak hier uw lessen aan</h2>");
    // include("create.php");
}
?>
