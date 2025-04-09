<!-- Modal Create Producto-->
<div class="modal fade" id="modal_create_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear producto</h5>
            </div>
            <form action="{{ route('productos/store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="text" name="nombre" placeholder="NOMBRE DEL PRODUCTO..."
                        class="form-control mayusculas" required />
                    <br>
                    <select name="unidad_id" class="form-control">
                        <option value>--Seleccione una unidad--</option>
                        @foreach ($unidades as $unidad)
                            <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                        @endforeach
                    </select>
                    <br>
                    <textarea name="descripcion" placeholder="Descripción (Opcional)" class="form-control"></textarea>
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
