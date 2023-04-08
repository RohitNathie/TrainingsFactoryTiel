<?php
namespace App\Models;

use CodeIgniter\Model;

class tftModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['id', 'username','password', 'user_email', 'leeftijd', 'telnummer', 'role', 'geboortedatum', 'secret'];

    
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

    public function getLes()
    {
 
    }
    public function getUsers()
    {
        $user = auth()->user();
        $db = db_connect();
        // retrieving the secret column using JOIN
        $query = "SELECT u.*, a.secret FROM `users` u JOIN `auth_identities` a ON u.id = a.user_id";
    
        $select = $db->query($query);
    
        return $select->getResult();
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
    // function getEmail()
    // {

    // }
 // de data voor de tft
    // public function gettftByDate($date) {
    //     return $this->where('datum', $date)->findAll();
    // }

    // public function getLastSadTime()
    // {

    //     $user = auth()->user();
        
    //     $test= $this->where(['user_name' => $user->id, 'mood' => 'sad'])->orderBy('datum', 'DESC')->first(); 
    //     return $test;
        
        
    // }
    
    // public function save_note($opmerking) {
    //     $data = [
    //         'opmerking' => $opmerking,
    //     ];

    //     try{
    //         $this->insert($data);
    //         return true;
    //     }
    //     catch(\Exception $e)
    //     {
    //         log_message('error', 'Error met het uploaden van de opmerking: ' . $e->getMessage());
    //         return false;
    //     }
    // }

    // public function gettftByClassAndDate($class, $date) {
    //     return $this->where(['class' => $class, 'date' => $date])->findAll();
    // }
    

    
    
        // $month = date('m');
        // $user = auth()->user()->id;
        // $db = db_connect();
        // $sql = '';
        // $selection - $db->query($sql, [$user, $month]);

        // return $selection->getResult();
}
?>

