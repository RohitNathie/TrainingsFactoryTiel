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
        echo "<form method='post'>"; // Add form for updating user roles
        echo csrf_field();
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
    
    if ($_POST && isset($_POST['role'])) {
        foreach ($_POST['role'] as $userId => $role) {
            switch ($role) {
                case 'klant':
                    $newRole = 'klant';
                    break;
                case 'instructeur':
                    $newRole = 'instructeur';
                    break;
                case 'admin':
                    $newRole = 'admin';
                    break;
                default:
                    // handle invalid role value
                    break;
            }
            
            $db = \Config\Database::connect();
            $builder = $db->table('users');
            $builder->set('role', $newRole);
            $builder->where('id', $userId);
            $builder->update();
        }
    }
    
        
            // echo "userId: " . $userId . "<br>";
            // echo "role: " . $role . "<br>";
            // echo "sql: " . $sql . "<br>";
    
    
            // Debugging information
        }



if(auth()->user()->role == "instructeur"){
    echo("<h2> Maak hier uw lessen aan</h2>");
    // include("create.php");
}
?>
