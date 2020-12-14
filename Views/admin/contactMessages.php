<table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Titre</th>
        <th>Message</th>
        <th>Date</th>
        <th>Auteur</th>
        <th>Action</th>
    </thead>
    <tbody>
    <?php foreach($contactMessages as $contactMessage): ?>
        <tr>
            <td><?= $contactMessage->id ?></td>
            <td><?= $contactMessage->titleMessage ?></td>
            <td><?= $contactMessage->message ?></td>
            <td><?= $contactMessage->messageDate ?></td>
            <td><?= $contactMessage->visitorId ?></td>
            <td>
                <a href="" class="btn btn-warning">Modifier</a>
                <a href="/admin/deleteContactMessage/<?= $contactMessage->id ?>" class="btn btn-danger">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>