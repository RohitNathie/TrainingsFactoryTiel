<?php
namespace App\Controllers;
use App\Models\tftModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class tftController extends BaseController
{
        

    public function index()
    {
        // object
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
    
    public function create()
    {
        
        helper('form');
       

        // Checks whether the form is submitted.
        if (! $this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/header', ['title' => 'tft'])
                . view('tft/create')
                . view('templates/footer');
        }
        // gegevens opgehaald 
        $post = $this->request->getPost(['naam', 'mood', 'aantekening']);
        $model = model(tftModel::class);
        $naam = auth()->user()->id;
        // toevoegen in de db + de returns
        $model->save([
            'naam' => $naam,
            'mood' => $post['mood'],
            'opmerking' => $post['aantekening'],
        ]);

        return view('templates/header', ['title' => 'What\'s your mood today?'])
                .view ('tft/succes')
                .view('templates/footer');

        return view('templates/header', ['title' => 'Maakt een nieuwe tft aan'])
            . view('tft/index')
            . view('templates/footer');
    }
    // het saven van je opmerking naar db
    public function save_note(){   
        $opmerking = $this->request->getPost('aantekening');
        $model = new tftModel();
        // het vangt de user op 
        $naam = auth()->user()->id;
        $data = [
            'opmerking' => $opmerking,
        ];
        // opsturen van de opmerking naar de database
        $model->insert($data);
        $model->save_note($opmerking, $naam->id);
        // stuurt je terug naar de main screen
        return redirect()->to('');
    }
    
    public function isLoggedIn() {
        // Load the session library
        $session = \Config\Services::session();
    
        // Check if the user is logged in
        if ($session->has('user_id')) {
            return true;
        } else {
            return false;
        }
    }
    

    
    
}
?>