<html>

<head>
    <title>Crud with Ajex</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="header">
        <div class="container">
            <h1 class="heading">Crud Application using Ajex</h1>
        </div>
    </div>
    <div class="container">
        <div class="row pt-3">
            <div class="col-md-6  ">
                <h4>Car Models</h4>
            </div>
            <div class="col-md-6">
                <a href="javascript:void(0);" onclick="showModal()" class="btn btn-primary">Create</a>
            </div>
            <div class="col-md-12 pt-3">
                <table class="table table-striped" id="carModelList">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <th>name</th>
                        <th>color</th>
                        <th>transmission</th>
                        <th>price</th>
                        <th>Created date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php if(!empty($cars)){?>
                    <?php foreach($cars as $car){?>
                        <tr id="row-<?= $car['id'];?>">
                            <td class="modelid"><?= $car['id'];?></td>
                            <td class="modelname"><?= $car['name'];?></td>
                            <td class="modelcolor"><?= $car['color']?></td>
                            <td class="modeltransmission"> <?= $car['transmission'];?></td>
                            <td class="modelprice"><?= $car['price'];?></td>
                            <td class="modelid"><?= $car['created_at'];?></td>
                            <td><a  onclick="showEditForm(<?=$car['id'];?>)"  class="btn btn-success">Edit</a></td>
                            <td><a href="javascript:void(0);" onclick="confirmDeleteModel(<?=$car['id'];?>)" class="btn btn-danger">Delete</a></td>


                        </tr>
                        <?php }?>

                        <?php } else{?>
                            <tr>Record Not found</tr>
                        <?php }?>
                        </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="modal fade" id="createCar" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="response"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajexResponseMod" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5  id="exampleModalLongTitle">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                        <div class="modal-body">
    

                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5  id="modal-title">Confermation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                        <div class="modal-body">
    

                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" onclick="deleteNow()">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function showModal(){
        $("#createCar").modal("show");
        $("#createCar #title").html("Create");
        $.ajax({
            url:'<?=base_url().'index.php/Carmodel/showCreateForm'?>',
            type:'POST',
            data:{},
            dataType:'json',
            success:function(response){
                console.log(response);
                $("#response").html(response["html"]);

            }
        })

    }
    $("body").on("submit","#createCarModel",function(e){
       e.preventDefault();
       $.ajax({
            url:'<?=base_url().'index.php/Carmodel/saveModel'?>',
            type:'POST',
            data:$(this).serializeArray(),
            dataType:'json',
            success:function(response){
                console.log(response);
                if(response['status']==0 ){

                    if(response['name']!=""){
                        $(".nameError").html(response['name']).addClass('invalid-feedback d-block');
                        $("#name").addClass('is-invalid');
                    }else{
                        $(".nameError").html("").removeClass('invalid-feedback d-block');
                        $("#name").removeClass('is-invalid');
                    }
                    if(response['color']!=""){
                        $(".colorError").html(response['color']).addClass('invalid-feedback d-block');
                        $("#color").addClass('is-invalid');
                    }else{
                        $(".colorError").html("").removeClass('invalid-feedback d-block');
                        $("#color").removeClass('is-invalid');}
                    if(response['price']!=""){
                        $(".priceError").html(response['price']).addClass('invalid-feedback d-block');
                        $("#price").addClass('is-invalid');
                    }else{
                        $(".priceError").html("").removeClass('invalid-feedback d-block');
                        $("#price").removeClass('is-invalid');
                       }
                
                    }else{
                        $("#createCar").modal("hide");
                        $("#ajexResponseMod .modal-body").html(response["message"]); 
                        $("#ajexResponseMod").modal("show");
                        $(".nameError").html("").removeClass('invalid-feedback d-block');
                        $("#name").removeClass('is-invalid');
                        $(".colorError").html("").removeClass('invalid-feedback d-block');
                        $("#color").removeClass('is-invalid');
                        $(".priceError").html("").removeClass('invalid-feedback d-block');
                        $("#price").removeClass('is-invalid');

                        $("#carModelList").append(response["car"]);
                    }

                    
            }
    });
    });
    function showEditForm(id){
        $("#createCar .modal-title").html("Edit");

        $.ajax({
            url:'<?=base_url().'index.php/Carmodel/getCarModel/'?>'+id,
            type:'POST',
            dataType:'json',
            success:function(response){
                $("#createCar #response").html(response["html"])
                $("#createCar").modal("show");

                

                }
            });

    }
    $("body").on("submit","#editCarModel",function(e){
       e.preventDefault();
       $.ajax({
            url:'<?=base_url().'index.php/Carmodel/updatemodel'?>',
            type:'POST',
            data:$(this).serializeArray(),
            dataType:'json',
            success:function(response){
                console.log(response);
                if(response['status']==0 ){

                    if(response['name']!=""){
                        $(".nameError").html(response['name']).addClass('invalid-feedback d-block');
                        $("#name").addClass('is-invalid');
                    }else{
                        $(".nameError").html("").removeClass('invalid-feedback d-block');
                        $("#name").removeClass('is-invalid');
                    }
                    if(response['color']!=""){
                        $(".colorError").html(response['color']).addClass('invalid-feedback d-block');
                        $("#color").addClass('is-invalid');
                    }else{
                        $(".colorError").html("").removeClass('invalid-feedback d-block');
                        $("#color").removeClass('is-invalid');}
                    if(response['price']!=""){
                        $(".priceError").html(response['price']).addClass('invalid-feedback d-block');
                        $("#price").addClass('is-invalid');
                    }else{
                        $(".priceError").html("").removeClass('invalid-feedback d-block');
                        $("#price").removeClass('is-invalid');
                       }
                
                    }else{
                        $("#createCar").modal("hide");
                        $("#ajexResponseMod .modal-body").html(response["message"]); 
                        $("#ajexResponseMod").modal("show");
                        $(".nameError").html("").removeClass('invalid-feedback d-block');
                        $("#name").removeClass('is-invalid');
                        $(".colorError").html("").removeClass('invalid-feedback d-block');
                        $("#color").removeClass('is-invalid');
                        $(".priceError").html("").removeClass('invalid-feedback d-block');
                        $("#price").removeClass('is-invalid');

                       var id=response["car"]["id"];
                        $("#row-"+id+" .modelname").html(response["car"]["name"]);
                        $("#row-"+id+" .modelcolor").html(response["car"]["color"]);
                        $("#row-"+id+" .modeltransmission").html(response["car"]["transmission"]);
                        $("#row-"+id+" .modelprice").html(response["car"]["price"]);

                    }

                    
            }
    });
    });
    function confirmDeleteModel(id){
        // alert(id);
      $("#deleteModal").modal("show");
      $("#deleteModal .modal-body").html("Are you sure you want to delete #"+id+ "?");
      $("#deleteModal").data("id",id);
    }
    function deleteNow(){
        var id=$("#deleteModal").data('id');
        $.ajax({
            url:'<?=base_url().'index.php/Carmodel/deleteModel/'?>'+id,
            type:'POST',
            data:$(this).serializeArray(),
            dataType:'json',
            success:function(response){
                console.log(response);
                if(response['status']==1 ){
                    $("#deleteModal").modal("hide");
                    $("#ajexResponseMod .modal-body").html(response["msg"]); 
                    $("#ajexResponseMod").modal("show");
                    $("#row-"+id).hide();
                    
                }else{
                    $("#deleteModal").modal("hide");
                    $("#ajexResponseMod .modal-body").html(response["msg"]); 
                    $("#ajexResponseMod").modal("show");
                }
            }

            
        });
       
    }
</script>

</html>
