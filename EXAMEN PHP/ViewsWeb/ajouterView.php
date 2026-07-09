<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter réservation</title>

    <style>
        body {
            font-family: Arial;
            margin: 40px;
        }

        form {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
        }

        button {
            background: #0066cc;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <h1>Ajouter une réservation</h1>
    <form method="POST" action="index.php?action=ajouter">
        <label>Nom du client</label>
        <input type="text" name="nom_client" required>
        <label>Numéro chambre</label>
        <input type="number" name="numero_chambre" required>
        <label>Nombre de nuits</label>
        <input type="number" name="nombre_nuits" required>
        <label>Type chambre</label>
        <select name="type_chambre">
            <option value="STANDARD">STANDARD</option>
            <option value="CONFORT">CONFORT</option>
            <option value="SUITE">SUITE</option>
        </select>
        <button type="submit">Enregistrer</button>
    </form>
    <a href="index.php?action=liste">Voir les réservations</a>
</body>

</html>