<?php
namespace App\Models;

use CodeIgniter\Model;

class tftModel extends Model
{
    protected $table = 'users';

    protected $allowedFields = ['id', 'username','password', 'user_email', 'leeftijd', 'telnummer', 'role'];
    
    public function gettft($slug = false)
    {
     if ($slug === false) {
        return $this->findAll();
     }

     return $this->where(['mood' => $slug])->first();
    }

    public function getMyMood()
    {
        $user = auth()->user();

        return $this->where(['user_name' => $user->id])->find();
    }
    public function admin() {

    }
    public function getUsers()
    {
        $db = db_connect();
        $query   = $db->query('SELECT username FROM users');
        $results = $query->getResultArray();
    }

    function getEmail()
    {

    }
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

    // public function getGrafiek()
    // {
    //    $builder = $this->db->table($this->table);
    //    $builder->select('mood, COUNT(*) as total');
    //    $builder->groupBy('mood');
    //    $query = $builder->get();
    //    return $query->getResultArray();
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

