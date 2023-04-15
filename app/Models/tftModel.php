<?php
namespace App\Models;

use CodeIgniter\Model;

class tftModel extends Model
{
    protected $table = 'users';

    protected $allowedFields = ['id', 'username','password', 'user_email', 'leeftijd', 'telnummer', 'role', 'geboortedatum', 'secret', 'secret2'];

    public function getById($id)
    {
        return $this->find($id);
    }



    public function gettft($slug = false)
    {
     if ($slug === false) {
        return $this->findAll();
     }

     return $this->where(['mood' => $slug])->first();
    }
// class emailModel exteds Model{

// }
    public function getEmail()
    {
        $user = auth()->user();
        $db = db_connect();
    
        $sql = "SELECT `secret` FROM `auth_identities` WHERE `user_id` = ? ORDER BY `id` ASC;";
        $selection = $db->query($sql, [$user->id]);
        $result = $selection->getResult();
    
        if (count($result) > 0) {
            return $result[0]->secret;
        }
    
        // return null;
    }
    // class usersModel extends Model {

// }
    public function getUsers()
    {
        $user = auth()->user();
        $db = db_connect();
        // $query = "SELECT `u`.*, `a`.`secret`, `a`.`secret2` FROM `users` `u` INNER JOIN `auth_identities` `a` ON `u`.`id` = `a`.`user_id` WHERE `u`.`id` = ?;";
        $query = "SELECT u.*, a.secret FROM `users` u JOIN `auth_identities` a ON u.id = a.user_id";
        // $query = "SELECT * FROM users;";
        // $select = $db->query($query, [$user['id']]);
        $selection =$db->query($query);
        
        
        // var_dump($user);
        return $selection->getResult();
        // var_dump($select);
    }
// class updateModel extends Model {

// }
    public function updateUser($userId, $newUsername, $leeftijd, $secret, $newGeboortedatum) {
        $this->db->transStart();

        $this->db->table('users')
        ->where('id', $userId)
        ->update([
            'username' => $newUsername,
            'leeftijd' => $leeftijd,
            'geboortedatum' => $newGeboortedatum,
        ]);

$this->db->table('auth_identities')
        ->where('user_id', $userId)
        ->update([
            'secret' => $secret,
        ]);
        // $this->db->table('users', 'auth_identities')
        //          ->where('id', $userId)
        //          ->update([
        //              'username' => $newUsername,
        //              'leeftijd' => $leeftijd,
        //              'secret' => $secret,
        //              'geboortedatum' => $newGeboortedatum,
        //          ]);
        //          return $this->db->affectedRows() > 0;
        $this->db->transComplete();
    return $this->db->transStatus();
    }
    
    public function updateRole($userId, $newRole) 
    {
        $userModel = new tftModel();
        $user = $userModel->find($userId);
        $user->role = $newRole;
        $userModel->save($user);
        var_dump($userId);
        var_dump($newRole);
        return $this->update($userId, ['role' => $newRole]);
        
    }

    // public function update($role, $data) {
    //     return $this->db
    //                     ->table('users')
    //                     ->where(["role" => $role])
    //                     ->set($data)
    //                     ->update();
    // }
}
?>

