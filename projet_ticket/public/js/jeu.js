/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
/*!*****************************!*\
  !*** ./resources/js/jeu.js ***!
  \*****************************/
__webpack_require__.r(__webpack_exports__);
function envoyerCartes() {
  console.log("ee");
  // Récupérer les ID des cartes sélectionnées
  var cartesSelectionnees = [];
  var cartesSelectionneesInputs = document.querySelectorAll('input[name="cartes_selectionnees[]"]:checked');
  cartesSelectionneesInputs.forEach(function (input) {
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
    body: JSON.stringify({
      cartes_selectionnees: cartesSelectionnees
    })
  }).then(function (response) {
    if (!response.ok) {
      throw new Error('Une erreur est survenue.');
    }
    return response.json();
  }).then(function (data) {
    // Gérer la réponse du serveur si nécessaire
  })["catch"](function (error) {
    console.error('Erreur :', error);
  });
}
/******/ })()
;