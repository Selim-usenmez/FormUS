// Usenmez Selim
// 2021-05-06
// code JAvascripte pour la recherche de contrat

function searchContract() {
    let searchTerm = document.getElementById("searchBar").value;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php_outils/search_contract.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.querySelector("tbody").innerHTML = xhr.responseText;

           
        }
    };

    xhr.send("searchTerm=" + encodeURIComponent(searchTerm));
}