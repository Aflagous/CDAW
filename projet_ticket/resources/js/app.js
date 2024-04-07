import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function envoyerCartes() {
    console.log("ee");
    // Récupérer les ID des cartes sélectionnées
    var cartesSelectionnees = [];
    var cartesSelectionneesInputs = document.querySelectorAll('input[name="cartes_selectionnees[]"]:checked');
    cartesSelectionneesInputs.forEach(function(input) {
        cartesSelectionnees.push(input.value);
    });

    // Récupérer le jeton CSRF à partir de la balise meta CSRF-Token
    var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    // Envoyer les données via une requête AJAX
    fetch('/parties/desti', {
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
}
