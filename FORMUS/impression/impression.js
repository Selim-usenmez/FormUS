/* Usenmez Selim
    2021-05-06
    code js pour l'impression*/


function printContract(contractId) {
    fetch(`../cree_contrat/get_contract.php?id=${contractId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP: ${response.status}`);
            }
            return response.text();
        })
        .then(html => {
            const printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write(html);
            printWindow.document.close();

            // Attendre que le contenu soit chargé
            printWindow.onload = function() {
                printWindow.focus();
                printWindow.print();
                printWindow.onafterprint = function() {
                    printWindow.close();
                };
            };
        })
        .catch(error => {
            console.error('Erreur lors de la récupération ou impression du contrat :', error);
            alert('Impossible de récupérer le contrat pour impression.');
        });
}