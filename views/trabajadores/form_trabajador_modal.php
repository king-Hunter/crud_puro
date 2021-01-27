<div id="form_trabajador" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulario trabajador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div id="msg_validacion_form" class="alert alert-danger" style="display: none"></div>
                    <input type="hidden" id="input_id" value="<?=isset($trabajador['id_empleado']) ? $trabajador['id_empleado'] : ''?>">
                    <!-- nombre -->
                    <div class="mb-3">
                        <label for="input_nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="input_nombre"
                               value="<?=isset($trabajador['nombre']) ? $trabajador['nombre'] : ''?>"
                               aria-describedby="Nombre personal" placeholder="Nombre personal">
                    </div>
                    <!-- apellido paterno -->
                    <div class="mb-3">
                        <label for="input_apellido_paterno" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control"
                               value="<?=isset($trabajador['paterno']) ? $trabajador['paterno'] : ''?>"
                               id="input_apellido_paterno" aria-describedby="Apellido Materno" placeholder="Apellido paterno">
                    </div>
                    <!-- apellido materno -->
                    <div class="mb-3">
                        <label for="input_apellido_materno" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control"
                               value="<?=isset($trabajador['materno']) ? $trabajador['materno'] : ''?>"
                               id="input_apellido_materno" aria-describedby="Apellido Materno" placeholder="Apellido materno">
                    </div>
                    <!-- correo -->
                    <div class="mb-3">
                        <label for="input_correo" class="form-label">Correo</label>
                        <input type="email" class="form-control"
                               value="<?=isset($trabajador['correo']) ? $trabajador['correo'] : ''?>"
                               id="input_correo" aria-describedby="Correo electronico" placeholder="correos electronico">
                    </div>
                    <!-- correo -->
                    <div class="mb-3">
                        <label for="input_fecha_nacimiento" class="form-label">Fecha nacimiento</label>
                        <input type="date" class="form-control"
                               value="<?=isset($trabajador['nacimiento']) ? $trabajador['nacimiento'] : ''?>"
                               id="input_fecha_nacimiento" aria-describedby="Fecha de nacimiento" placeholder="Fecha de nacimiento">
                    </div>
                    <!-- telefono(s) -->
                    <div class="mb-3">
                        <div class="row">
                            <div class="col ">
                                <button id="boton_nuevo_telefono" class="btn btn-primary mx-auto d-block" type="button">Nuevo telefono</button>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <th>Tipo</th>
                                    <th>Numero</th>
                                <th>Operaciones</th>
                                </thead>
                                <tbody id="tbody_rows_telefono">
                                <?php if(isset($trabajador['telefonos']) && is_array($trabajador['telefonos']) && sizeof($trabajador['telefonos']) > 0): ?>
                                    <?php foreach ($trabajador['telefonos'] as $tel): ?>
                                        <tr>
                                            <input type="hidden" class="input_id_telefono_empleado" value="<?=$tel['id_telefono_empleado']?>">
                                            <td>
                                                <select class="form-control input_slt_tipo_telefono" name="input_slt_tipo_telefono" required>
                                                    <option value="">--Seleccione--</option>
                                                    <?php foreach ($catalogo_telefono as $ct): ?>
                                                        <option value="<?=$ct['id_catalogo_telefono']?>" <?=$ct['id_catalogo_telefono'] == $tel['id_catalogo_telefono'] ? 'selected="selected"' : ''?>><?=$ct['tipo']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control input_numero_telefono"
                                                       value="<?=$tel['telefono']?>"
                                                       placeholder="Número" type="text">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger boton_eliminar_tel">Eliminar</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button id="boton_guardar_trabajador" type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
