<?php
namespace App\Controllers;
use App\Models\tftModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class tftController extends BaseController
{
    
    protected $tftModel;

    public function __construct()
    {
        
        $this->tftModel = new tftModel();
    }
   
    public function index()
    {
        
        $model = model(tftModel::class);
        // $data_user = $this->tftModel->getUser();
        $data = [
            'tft'  => $model->gettft(),
            // 'email' => $model->getEmail(),
            'naam' => 'Nieuwe tft',
        ];
        
        return view('templates/header', $data)
        . view('tft/index')
        . view('templates/footer');
    }

    public function profiel() {

    $user = session()->get('user');

    if (!isset($user['username'])) {
        $user['username'] = '';

    }

    if (!isset($user['email'])) {
        $user['email'] = '';
    }

    if (!isset($user['age'])) {
        $user['age'] = '';
        
    }
    var_dump($user);
    // $user = session()->get('user') ?? ['username' => ''];

     // Redirect to login page if user is not logged in
    if (!$user) {
        return redirect()->to('/login');
    }

    // Get the submitted form data
    $postData = $this->request->getPost();
    if (!empty($postData)) {
        $tftModel = new tftModel();
    // var_dump($user);
        $tftModel->update($user['id'], $postData);
    // $userModel->where('id', $user['id'])->set($postData)->update();
        $user = $tftModel->find($user['id']);
    }
    // Redirect back to the profile page
    // return redirect()->to('/profiel');
    
        return view('templates/header')
        . view('tft/profiel', ['user' => $user])
        . view('templates/footer');

    }

    public function getUser()
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
            // 'users' => $this->tftModel->getUsers(),
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