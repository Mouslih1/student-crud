@extends('Layout.master')
@section('content')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="border-bottom pb-2 mb-4">Ajout d'un étudiant</h3>
        <div class="mt-4">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(session()->has('success'))
            <div class="alert alert-success">
                <h6>{{ session()->get('success')}}</h6>
            </div>
            @endif
            <form style="width : 65%;" method="post" action="{{ route('etudiant.ajouter') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Photo profil</label>
                  <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control">
                  </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Prénom</label>
                  <input type="text" name="prenom" class="form-control">
                </div> 
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Classe</label>
                    <select class="form-control" name="classes_id" id="">
                        <option value=""></option>
                        @foreach($classes as $classe)
                        <option value="{{ $classe->id}}">{{$classe->libelle}}</option>
                        @endforeach
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('etudiant')}}" type="reset" class="btn btn-danger">Annuler</a>
              </form>

        </div>
    </div>
@endsection