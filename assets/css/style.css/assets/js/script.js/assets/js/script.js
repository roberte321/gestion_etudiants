document.getElementById('studentForm').addEventListener('submit', function(e) {
    let nom = document.getElementById('nom').value.trim();
    let prenom = document.getElementById('prenom').value.trim();
    let filiere = document.getElementById('filiere').value;

    if (nom === "" || prenom === "" || filiere === "") {
        e.preventDefault(); // Bloque l'envoi
        alert("Veuillez remplir tous les champs !");
    }
});
