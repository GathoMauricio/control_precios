<!-- Modal Create Producto-->
<div class="modal fade" id="modal_create_unidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear unidad de medida</h5>
            </div>
            <form action="{{ route('unidades/store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="text" name="nombre" placeholder="TIPO DE UNIDAD..." class="form-control mayusculas"
                        required />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#modal_create_producto').modal('hide')"
                        data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
