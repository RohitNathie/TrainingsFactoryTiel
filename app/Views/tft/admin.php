<style>

</style>
<?php
if(auth()->user() && auth()->user()->role == "admin"){
    echo("<h2>Hier kunt u de rollen van gebruikers aanpasesen.</h2>");
    if($users) {
        for($id = 0; $id < count($users); $id++): ?>
            <div class="container">
                <div class="users">
                    <?php
                    echo("naam: ". $users[$id]->naam. '<br>');
                    echo("email: ". $email[$id]->secret . '<br>');
                    echo("rol: ". $users[$id]->role);
                    ?>
                    </div>
            </div><?php
            endfor;
    }
   
}else if(auth()->user() && auth()->user()->role == "instructeur"){
    echo("<h2> Maak hier uw lessen aan</h2>");
    include("create.php");
}
?>
