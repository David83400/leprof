<?php $this->title = 'Le Prof | Admin - Assistance' ?>
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
    <?php foreach($assistanceMessages as $assistanceMessage): ?>
        <tr>
            <td><?= $assistanceMessage->id ?></td>
            <td><?= $assistanceMessage->titleMessage ?></td>
            <td><?= $assistanceMessage->message ?></td>
            <td><?= $assistanceMessage->messageDate ?></td>
            <td><?= $assistanceMessage->memberId ?></td>
            <td>
                <a href="" class="btn btn-warning">Afficher</a>
                <a href="/admin/deleteAssistanceMessage/<?= $assistanceMessage->id ?>" class="btn btn-danger">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>