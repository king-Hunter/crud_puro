<div class="row">

</div>
<?php if (isset($trabajadores) && is_array($trabajadores) && sizeof($trabajadores) > 0) : ?>
<section class="container py-5">
    <div class="row">
        <?php foreach ($trabajadores as $t) : ?>
        
        <div class="col">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?= $t['nombre'] ?></h5>
                <h6>
                    <?= $t['cumpleanios'] ?>
                </h6>
                <h6>
                    <strong>Correo:</strong> <?= $t['correo'] ?>
                </h6>
                <p class="card-text" style="overflow: hidden;
    white-space: nowrap;"><strong>Telefonos:</strong><?= $t['telefono'] ?></p>
                <a type="button" class="btn btn-primary boton_modificar_trabajador" data-id_trabajador="<?= $t['id'] ?>">Modificar</a>
                <a type="button" class="btn btn-danger boton_eliminar_trabajador" data-id_trabajador="<?= $t['id'] ?>">Eliminar</a>
            </div>
        </div>    
        </div>
        <?php endforeach; ?>


    </div>
</section>
<?php endif; ?>
