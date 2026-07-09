<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste réservations</title>
    <style>
        table {

            border-collapse: collapse;
            width: 90%;
        }
        th,
        td {
            border: 1px solid black;
            padding: 10px;
        }
        th {
            background: #ddd;
        }

        .btn {
            background: red;
            color: white;
            padding: 5px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <h1>Réservations actives</h1>
    <?php if (empty($reservations)): ?>
        <p>Aucune réservation disponible.</p><?php else: ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Chambre</th>
                <th>Nuits</th>
                <th>Type</th>
                <th>Action</th>
            </tr><?php foreach ($reservations as $reservation): ?><tr>
                    <td><?= $reservation->getId(); ?></td>
                    <td><?= $reservation->getNomClient(); ?></td>
                    <td><?= $reservation->getNumeroChambre(); ?></td>
                    <td><?= $reservation->getNombreNuits(); ?></td>
                    <td><?= $reservation->getTypeChambre(); ?></td>
                    <td><a class="btn" href="index.php?action=annuler&id=<?= $reservation->getId(); ?>">Annuler</a></td>
                </tr><?php endforeach; ?>
        </table>
    <?php endif; ?>
    <br><a href="index.php?action=ajouter">Nouvelle réservation</a><br>
    <a href="index.php?action=ca">Voir chiffre d'affaires</a>
</body>

</html>