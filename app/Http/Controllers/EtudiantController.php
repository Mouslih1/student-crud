<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEtudiant;
use App\Models\Classe;
use App\Models\Etudiant;
use Illuminate\Database\Console\WipeCommand;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{

    public function welcome(){
        return view('welcome');
    }


    public function index(){
        $etudiants = Etudiant::orderBy('nom', 'asc')->paginate(5);
        
        return view('etudiant',compact('etudiants'));
    }


    public function create(){
        $classes = Classe::cursor();

        return view('createEtudiant', compact('classes'));
    }


    public function store(StoreEtudiant $request){
     
        $requestData = $request->all();
        $fileName = time().'.'.$request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('images', $fileName, 'public');
        $requestData['image'] = '/storage/'.$path;
        Etudiant::create($requestData);

        return back()->with('success','Etudiant ajouter avec succé !');

        /*
        $image = time().'.'.$request->image->extension(); 

        Etudiant::create([
            'image' => $request->image->move('uploads/images/', $image),
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'classes_id' => $request->classes_id
        ]);
    
        return back()->with('success','You have successfully Enregister.'); 
        */
    }


    public function delete(Etudiant $etudiant){
        $nom_complet = $etudiant->nom." ".$etudiant->prenom;
        $etudiant->delete();

        return back()->with("successDelete","Etudiant '$nom_complet' a été supprimer avec succé !");
    }


    public function update(StoreEtudiant $request, Etudiant $etudiant){
      
       $requestData = $request->all();
       $fileName = time().'.'.$request->file('image')->getClientOriginalName();
       $path = $request->file('image')->storeAs('images', $fileName ,'public');
       $requestData['image'] = '/storage/'.$path;
       $etudiant->update($requestData);

       return back()->with('success','Etudiant a été modifier avec succé !');
    }


    public function edit(Etudiant $etudiant){
        $classes = Classe::cursor();

        return view('editEtudiant', compact('etudiant', 'classes'));
    }

    public function search(){
        $search_text = $_GET['query'];
        $etudiants = Etudiant::where('nom', 'LIKE', '%'.$search_text.'%')->paginate(5);

        return view('searchEtudiant', compact('etudiants'));
    }

  
}
