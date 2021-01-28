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
<?php else: ?>
<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">No existen datos</h1>
        <p>
          <a href="/" class="btn btn-primary my-2">recargar </a>
        </p>
      </div>
    </div>
  </section><?php endif; ?>
