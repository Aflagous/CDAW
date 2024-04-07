import Echo from 'laravel-echo';

let e = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    client: io,
});
let gameId = 4;
e.private('partie.' +  gameId )
    .listen('PlayerJoined', (event) => {
        let playerCount = document.getElementById('playerCount'); 
        playerCount.textContent = parseInt(playerCount.textContent) + 1;
    })
e.private('partie.' +  gameId )
    .listen('PlayerLeft', (event) => {
        let playerCount = document.getElementById('playerCount');
        playerCount.textContent = parseInt(playerCount.textContent) - 1;
    });
e.private('partie.' +  gameId )
    .listen('LauchEvent', (event) => {
        window.location.href = '/game/' + gameId + '/lauch';
    });
e.private('partie.' + gameId)
    .listen('ChangementDeJoueur', (event) => {
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        // Envoyer une requête AJAX pour mettre à jour la table jen_cours
        fetch('/game/' + gameId + '/miseAJourJenCours', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken // Assurez-vous d'avoir le jeton CSRF
            },
            body: JSON.stringify({ eventData: event }) // Vous pouvez envoyer les données de l'événement si nécessaire
        })
        .then(response => {
            // Gérer la réponse du serveur si nécessaire
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
        window.location.href = '/game/' + gameId + '/lagame';

    });
e.private('partie.' + gameId)
    .listen('finpartie', (event) => {

        window.location.href = '/game/' + gameId + '/finish';

    });



