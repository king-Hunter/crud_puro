<tr>
    <input type="hidden" class="input_id_telefono_empleado" value="">
    <td>
        <select class="form-control input_slt_tipo_telefono" name="input_slt_tipo_telefono" required>
            <option value="">--Seleccione--</option>
            <?php foreach ($catalogo_telefono as $ct): ?>
                <option value="<?=$ct['id_catalogo_telefono']?>"><?=$ct['tipo']?></option>
            <?php endforeach; ?>
        </select>
    </td>
    <td>
        <input class="form-control input_numero_telefono" placeholder="Número" type="text">
    </td>
    <td>
        <button type="button" class="btn btn-danger boton_eliminar_tel">Eliminar</button>
    </td>
</tr>
