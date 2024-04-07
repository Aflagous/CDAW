
document.addEventListener("DOMContentLoaded", function() {
    var gameId = document.getElementById("gameId").value; 
    
    
    document.getElementById("envoyerCartesBtn").addEventListener("click", function() {
        var cartesSelectionnees = [];
        var cartesSelectionneesInputs = document.querySelectorAll('input[name="cartes_selectionnees[]"]:checked');
        cartesSelectionneesInputs.forEach(function(input) {
            cartesSelectionnees.push(input.value);
        });
        var gameId = document.getElementById("gameId").value; // Récupère l'ID de la partie depuis un champ hidden

        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        // Envoyer les données via une requête AJAX
        fetch('/game/' + gameId + '/desti', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken // Utilisez le jeton CSRF récupéré
            },
            body: JSON.stringify({ cartes_selectionnees: cartesSelectionnees })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Une erreur est survenue.');
            }
            return response.json();
        })
        .then(data => {
            var cartesSelectionneesDiv = document.getElementById("cartesSelectionnees");
            cartesSelectionneesDiv.innerHTML = ''; // Efface les cartes sélectionnées actuelles
            data.nouvellesCartesSelectionnees.forEach(function(carte) {
                var nouvelleCarteDiv = document.createElement('div');
                nouvelleCarteDiv.textContent = carte.nom; // Remplacez 'nom' par le nom de votre carte
                cartesSelectionneesDiv.appendChild(nouvelleCarteDiv);
            });
            // Gérer la réponse du serveur si nécessaire
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
    });
    document.getElementById("PiocherCartesDesti").addEventListener("click", function() {
        var cartesSelectionnees = [];
        var cartesSelectionneesInputs = document.querySelectorAll('input[name="cartes_selectionnees[]"]:checked');
        cartesSelectionneesInputs.forEach(function(input) {
            cartesSelectionnees.push(input.value);
        });
        var gameId = document.getElementById("gameId_2").value; // Récupère l'ID de la partie depuis un champ hidden

        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        // Envoyer les données via une requête AJAX
        fetch('/game/' + gameId + '/piochedesti', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken // Utilisez le jeton CSRF récupéré
            },
            body: JSON.stringify({ cartes_selectionnees: cartesSelectionnees })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Une erreur est survenue.');
            }
            return response.json();
        })
        .then(data => {
            // Gérer la réponse du serveur si nécessaire
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
    });
    document.getElementById("PiocherCartesVelo").addEventListener("click", function() {
        var cartesSelectionnees = [];
        var cartesSelectionneesInputs = document.querySelectorAll('input[name="cartes_selectionnees[]"]:checked');
        cartesSelectionneesInputs.forEach(function(input) {
            cartesSelectionnees.push(input.value);
        });
        var gameId = document.getElementById("gameId").value; 
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        fetch('/game/' + gameId + '/piochevelo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken // Utilisez le jeton CSRF récupéré
            },
            body: JSON.stringify({ cartes_selectionnees: cartesSelectionnees })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Une erreur est survenue.');
            }
            return response.json();
        })
        .then(data => {
            // Gérer la réponse du serveur si nécessaire
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
    });

});


