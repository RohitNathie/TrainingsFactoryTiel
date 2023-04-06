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

    public function profiel() {
        return view('templates/header')
        . view('tft/profiel')
        . view('templates/footer');

    }

    public function admin() {
        $model = model(tftModel::class);    

        $data = [
            'users' => $model->getUsers(),
            'les' => $model->getEmail()
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
        // $model->save([
        //     'title' => $post['title'],
        //     'mood' => $post['mood'],
        //     'opmerking' => $post['aantekening'],
        // ]);

        if(! $this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body' => 'required|max_length[5000]|min_length[10]',
        ])) {
            return view('templates/header', ['title' => 'Maak een les hier aan'])
            .view ('tft/create')
            .view('templates/footer');
        }
        
    }
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