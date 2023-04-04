<form action="" method="post" id="editCarModel" name="editCarModel">
    <input type="hidden" name="id"value="<?php echo $car->id ?>">
<div class="modal-body">
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="name" id="name" value="<?php echo $car->name ?>" class="form-control" placeholder="Name">
        <p class="nameError"></p>
    </div>
    <div class="form-group">
        <label for="">Color</label>
        <input type="text" name="color" id="color" value="<?php echo $car->color ?>" class="form-control"placeholder="color">
        <p class="colorError"></p>

    </div>
    <div class="form-group">
        <label for="">Transmission</label>
       <select name="transmission" id="transmission" class="form-control">
        <option value="Automatic"<?php echo ($car->transmission =="automatic") ? 'selected' : ''?>>Automatic</option>
        <option value="Manual"<?php echo ($car->transmission =="manual") ? 'selected' : ''?>>Manual</option>
       </select>
    </div>
    <div class="form-group">
        <label for="">Price</label>
        <input type="text" name="price" id="price" value="<?php echo $car->price ?>" class="form-control" placeholder="price">
        <p class="priceError"></p>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save changes</button>
</div>
</form>