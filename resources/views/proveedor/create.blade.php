<!-- Modal Create Proveedor-->
<div class="modal fade" id="modal_create_proveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear proveedor</h5>
            </div>
            <form action="{{ route('proveedor/store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="text" name="nombre" placeholder="NOMBRE DEL PROVEEDOR..."
                        class="form-control mayusculas" required />
                    <br>
                    <textarea name="descripcion" placeholder="Descripción (Opcional)" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="$('#modal_create_proveedor').modal('hide')" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
