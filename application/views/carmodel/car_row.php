<tr id="row-<?= $car->id;?>">
    <td><?= $car->id;?></td>
    <td><?= $car->name;?></td>
    <td><?= $car->color?></td>
    <td><?= $car->transmission;?></td>
    <td><?= $car->price;?></td>
    <td><?= $car->created_at;?></td>
    <td><a href="javascript:void(0);" onclick="showEditForm(<?=$car->id;?>)" class="btn btn-success">Edit</a></td>
    <td><a href="javascript:void(0);" onclick="confirmDeleteModel(<?=$car->id;?>)" class="btn btn-danger">Delete</a></td>
</tr>