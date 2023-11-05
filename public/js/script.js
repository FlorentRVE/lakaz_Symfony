
document.addEventListener('DOMContentLoaded', function() {

    // ================================ Variables ============================
    
    let category_choice;
    
    let buttons = document.querySelectorAll('.category'); // Récupère tous les boutons de sélection de catégorie
    // let recettes = document.querySelectorAll('.objet'); // Récupère toutes les blocs questions/réponses
    let containers = document.querySelectorAll('.container'); // Récupère tous les conteneurs de sous-catégories

    let buttonReset = document.querySelector('.reset'); // Récupère le boutton pour reset les catégories

    let goTop = document.querySelector('.gotop');

    // ================================== Fonctions ====================================
    
        const scrollToTop = () => {
            window.scrollTo({
            top: 0,
            behavior: "smooth",
            });
        };
    
      // ========================== Evènement sélection catégorie ==============================

    buttons.forEach(button => {
        button.addEventListener('click', (e) => { // Pour chaque bouton (City ker, vert, velo), au click ...

            category_choice = e.target.dataset.categorie; // ... on récupère l'attribut data-categorie du bouton et on le stocke dans category_choice

            containers.forEach(item => { // ensuite pour chaque bloc question/réponse ...                
                
                if(item.dataset.categorie !== category_choice) { // ... on vérifie si l'attribut data-categorie du bloc est different de category_choice
                    item.style.display = 'none'; // si c'est le cas, on le masque
                } else {
                    item.style.display = ''; // sinon on le montre
                }
                
            })
                        
        });
    });
    
    // ============= Boutton reset pour recharger la page ================

    buttonReset.addEventListener('click', () => { // Reload la page pour re afficher tous les objets
        window.location.reload();
    });

    // =============== Haut de page ================
    
    goTop.addEventListener('click', () => {
        scrollToTop();
    });

});