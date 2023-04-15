<?php
namespace App\Controllers;
use App\Models\tftModel;
use CodeIgniter\Exceptions\PageNotFoundException;
header('Access-Control-Allow-Origin: *');
class tftController extends BaseController
{
    
    protected $tftModel;

    public function __construct()
    {
        // $this->config->set_item('csrf_protection', false);
        
        $this->tftModel = new tftModel();
    }
   
    public function index()
    {
        
        $model = model(tftModel::class);
        // $data_user = $this->tftModel->getUser();
        $data = [
            'tft'  => $model->gettft(),
            'email' => $model->getEmail(),
            'naam' => 'Nieuwe tft',
        ];
        
        return view('templates/header', $data)
        . view('tft/index')
        . view('templates/footer');
    }
// Edit profile
// public function profiel()
// {
//     $session = session();

//     if (! $userId = $session->get('user')['id']) {
//         // kan userid niet in sessie vinden
//         var_dump('UID Session Lookup failure', $session->get('user'));
//         return;
//     }

//     // fetching user data, from db
//     $tftModel = new tftModel();
//     if (! $user = $tftModel->find($userId)) {
//         // kan user niet vinden in db
//         var_dump('User Lookup failure', $userId);
//         return;
//     }

//     if ($postData = $this->request->getPost())
//     {
//         //  Updating the data
//         $tftModel->update($userId, $postData);
//         $user = $tftModel->find($userId);
//     }
//     // var_dump('user', $user);
//     $session->set(['user'=>$user]);
//     var_dump($user);

//     return view('templates/header')
//          . view('tft/profiel', ['user' => $user])
//          . view('templates/footer');
// }

    public function getUser()
    {
        
        // Get the current user's ID from the session
        $userId = session('user_id');
        // $user_id = session('user_id');
        // echo 'User ID: ' . $userId;
        
        // Load the user's data from the database
        $userModel = new tftModel();
        $user = $userModel->find($userId);
        if (!$user) {
            throw new PageNotFoundException('User not found');
        }
        return $user;
    }
    public function profiel()
    {
        $user = auth()->user();
        $userId = $user ? $user->id : null;
        // Debug
        // echo 'User ID: ' . $userId;
        $model = model(tftModel::class);
        $user = $model->find($userId);
        if (!$user) {
            throw new PageNotFoundException('User not found');
        }
        // return $user;

        $data = [
            'user' => $user,
            'auth_email' => $model->getEmail(),
        ];
        // var_dump($data);


        return view('templates/header', $data)
        .view ('tft/profiel')
        .view('templates/footer');

    }

    public function updateProfiel()
    {
        $model = model(tftModel::class);
        $user = auth()->user();
        $userId = $user ? $user->id : null;
    
        // Retrieve the data from the form
        $newUsername = $this->request->getPost('username');
        $leeftijd = $this->request->getPost('leeftijd');
        $secret = $this->request->getPost('email');
        $newGeboortedatum = $this->request->getPost('geboortedatum');
    
        // Update the user data in the database
        $model->updateUser($userId, $newUsername, $leeftijd, $secret, $newGeboortedatum);
    
        // Load the updated user data
        $user = $model->find($userId);
    
        // Prepare the data to be sent to the view
        $data = [
            'user' => $user,
            'auth_email' => $model->getEmail(),
            'success' => 'Profile updated successfully.',
        ];
    
        // Return the view with the updated user data
        return view('templates/header', $data)
            . view('tft/profiel')
            . view('templates/footer');
    }
    
    public function admin() {
        $model = model(tftModel::class); 
        $user = $model->getUsers(session()->get('user_id'));   

        $data = [
            'users' => $user,
            // 'auth_identities' => $model->getEmail(),
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
                $this->tftModel = new tftModel();
            }
        }
    }



    // public function update()
    // {
    //         $user = $this->getUser(); // Retrieve the user data from the session
    //         $validation = $this->validate([
    //             'password' => 'required|min_length[6]',
    //             'email' => 'required|valid_email',
    //             'age' => 'required|numeric|greater_than[0]'
    //         ]);

    //         if (!$validation) {
    //             return view('profile', ['user' => $user, 'validation' => $this->validator]);
    //         }
    //         $userData = [
    //             'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
    //             'email' => $this->request->getPost('email'),
    //             'age' => $this->request->getPost('age')
    //         ];
        
    //         $this->db->table('users')->update($userData, ['id' => $user['id']]);
        
    //         session()->setFlashdata('success', 'Profile updated successfully.');
        
    //         return redirect()->to('/profile');
        
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