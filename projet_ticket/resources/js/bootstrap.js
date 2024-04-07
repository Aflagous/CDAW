import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;
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

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
