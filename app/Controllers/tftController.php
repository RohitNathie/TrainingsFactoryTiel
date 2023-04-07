<?php
namespace App\Controllers;
use App\Models\tftModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class tftController extends BaseController
{
    
    protected $tftModel;

    public function __construct()
    {
        $this->tftModel = new TftModel();
    }
   
    public function index()
    {
        
        $model = model(tftModel::class);

        $data = [
            'tft'  => $model->gettft(),
            // 'lastSadTime' => $model->getLastSadTime(),
            // 'grafieken' => $model->getGrafiek(),
            'naam' => 'Nieuwe tft',
        ];
        
        return view('templates/header', $data)
        . view('tft/index')
        . view('templates/footer');
    }

    public function profiel() {
    // Load the user's profile data
        //    if (!session()->has('user_id')) {
        // throw new PageNotFoundException('User not found');
        //  }
    $user = $this->getUser();
        
    // Get the submitted form data
    $postData = $this->request->getPost();
    
    $userModel = new tftModel();
    if (isset($user['id'])) {
        $userModel->update($user['id'], $postData);
    } else {
        // handle the error - the 'id' key is undefined
    }
    
    $userModel->update($user['id'], $postData);
    var_dump($userModel);
    // Redirect back to the profile page
    return redirect()->to('/profiel');
    
        return view('templates/header')
        . view('tft/profiel')
        . view('templates/footer');

    }

    private function getUser()
    {
        // Get the current user's ID from the session
        $userId = session('user_id');
        // $user_id = session('user_id');
        echo 'User ID: ' . $userId;
        
        // Load the user's data from the database
        $userModel = new tftModel();
        $user = $userModel->find($userId);
        if (!$user) {
            throw new PageNotFoundException('User not found');
        }
    
        return $user;
    }
    
    public function admin() {
        $model = model(tftModel::class);    

        $data = [
            'users' => $model->getUsers(),
            // 'les' => $model->getEmail()
        ];

        return view('templates/header', $data)
        .view ('tft/admin')
        .view('templates/footer');
    }
    
    public function create()
    {
        
        helper('form');
       

        // Checks whether the form is submitted.
        if (! $this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/header', ['title' => 'Maak een les aan'])
                . view('tft/create')
                . view('templates/footer');
        }
        // gegevens opgehaald 
        $post = $this->request->getPost(['username', 'date', 'tijd']);


        if(! $this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body' => 'required|max_length[5000]|min_length[10]',
        ])) {
            return view('templates/header', ['title' => 'Maak een les hier aan'])
            .view ('tft/create')
            .view('templates/footer');
        }
        $model = new tftModel();
        $model->save([
            'username' => $post['username'],
            'date' => $post['date'],
            'tijd' => $post['tijd'],
        ]);
    
        // Redirect back to the create page
        return redirect()->to('/create');
        
    }

    public function updateRole()
    {
        if($_POST && isset($_POST['role'])) {
            foreach($_POST['role'] as $userId => $role) {
                switch($role) {
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
               
        
                echo "userId: " . $userId . "<br>";
                echo "role: " . $role . "<br>";
                $this->tftModel->updateRole($userId, $newRole);
            }
        }
    }
    
    // public function updateRoles()
    // {
    //     $role  = $this->request->getPost('role');

    //     $data = [
    //         'role'=> $role
    //     ];

    //     $result = $this->tftModel->update($role, $data);
    //     if($result) {
    //         echo "User details are updated successfully.";
    //     } else {
    //         echo "Something went wrong";
    //     }
    // }
    // // het saven van je opmerking naar db
    // public function save_note(){   
    //     $opmerking = $this->request->getPost('aantekening');
    //     $model = new tftModel();
    //     // het vangt de user op 
    //     $naam = auth()->user()->id;
    //     $data = [
    //         'opmerking' => $opmerking,
    //     ];
    //     // opsturen van de opmerking naar de database
    //     $model->insert($data);
    //     $model->save_note($opmerking, $naam->id);
    //     // stuurt je terug naar de main screen
    //     return redirect()->to('');
    // }
    

    
    
}
?>