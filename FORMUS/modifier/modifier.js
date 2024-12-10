/*
 * Nom : Usenmez
 * Prénom : Selim
 * Date : 2021-05-06
 * Fonctionnalité : Gestion dynamique des partenaires (ajout et suppression) dans un formulaire
 */


const partenairesContainer = document.getElementById('nouveaux_partenaires_container');
        const supprimerPartenairesInput = document.getElementById('supprimer_partenaires');

        // Gestion globale des boutons de suppression
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('supprimerPartenaireBtn')) {
                const partenaireId = e.target.dataset.partenaireId;
                const partenaireGroup = document.querySelector(`[data-partenaire-id="${partenaireId}"]`);

                if (partenaireGroup) {
                    partenaireGroup.remove();

                    // Ajouter l'ID du partenaire à la liste des partenaires à supprimer (pour les existants)
                    if (!partenaireId.startsWith('nouveau_')) {
                        let supprimerPartenaires = supprimerPartenairesInput.value.split(',').filter(Boolean);
                        supprimerPartenaires.push(partenaireId);
                        supprimerPartenairesInput.value = supprimerPartenaires.join(',');
                    }
                }
            }
        });

        // Ajout d'un nouveau partenaire
        const ajouterPartenaireBtn = document.getElementById('ajouterPartenaire');
        let partenaireCount = 0;

        ajouterPartenaireBtn.addEventListener('click', function() {
            partenaireCount++;
            const partenaireDiv = document.createElement('div');
            partenaireDiv.classList.add('form-group', 'nouveau-partenaire');
            partenaireDiv.setAttribute('data-partenaire-id', `nouveau_${partenaireCount}`);
            partenaireDiv.innerHTML = `
        <label for="nouveau_partenaire_nom_${partenaireCount}">Nom du nouveau partenaire :</label>
        <input type="text" id="nouveau_partenaire_nom_${partenaireCount}" name="nouveaux_partenaires[${partenaireCount}][nom]" required>
        
        <label for="nouveau_partenaire_contribution_${partenaireCount}">Contribution :</label>
        <textarea id="nouveau_partenaire_contribution_${partenaireCount}" name="nouveaux_partenaires[${partenaireCount}][contribution]" required></textarea>
        
        <button type="button" class="supprimerPartenaireBtn" data-partenaire-id="nouveau_${partenaireCount}">Supprimer</button>
    `;

            partenairesContainer.appendChild(partenaireDiv);
        });