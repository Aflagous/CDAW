@extends('layouts.master')

@section('content')
    <section x-data="{ mdp: false }" class="w-full flex flex-col gap-10 items-center">
    
        <form method="POST" action="{{ route('parties.create') }}">
            @csrf
        
            <div>
                <label for="name">Nom de la partie:</label>
                <input type="text" id="name" name="name" required>
            </div>
        
            <div>
                <label for="publique">Publique:</label>
                <input type="checkbox" id="publique" name="publique" value="1">
            </div>
        
            <div>
                <label for="temps">Temps:</label>
                <input type="number" id="temps" name="temps" required>
            </div>
        
            <div>
                <label for="mdp">Mot de passe:</label>
                <input @click="mdp = !mdp" type="checkbox" id="mdp" name="mdp" value="0">
            </div>
            <template x-if="mdp">
                <div>
                    <label for="mdptext">Votre mot de passe:</label>
                    <input type="text" id="mdptext" name="mdptext" required>
                </div>
            </template>
  
            <!-- Champ caché pour hote_id -->
            <input type="hidden" id="hote_id" name="hote_id" value="{{ Auth::id() }}">
        
            <!-- Champ caché pour commencer -->
            <input type="hidden" id="commencer" name="commencer" value="0">
        
            <!-- Champ caché pour fini -->
            <input type="hidden" id="fini" name="fini" value="0">
        
            <button type="submit">Créer la partie</button>
        </form>
        
        
    </section>

@endsection


