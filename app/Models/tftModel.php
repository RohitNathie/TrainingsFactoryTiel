<?php
namespace App\Models;

use CodeIgniter\Model;

class tftModel extends Model
{
    protected $table = 'login';

    protected $allowedFields = ['user_id', 'user_name','password', 'user_email'];
    
    public function gettft($slug = false)
    {
     if ($slug === false) {
        return $this->findAll();
     }

     return $this->where(['mood' => $slug])->first();
    }

    function getMyMood()
    {
        $user = auth()->user();

        return $this->where(['user_name' => $user->id])->find();
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

