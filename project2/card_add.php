<!-- Modal -->
<form id="formAddCard" name="formulario">
<div class="modal fade" id="addCard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Tarjeta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="datos_ajax_register"></div>
                <div class="form-group">
                    <label>Numero Tarjeta</label>
                    <input type="number" name="tarjeta" id="tarjeta" class="form-control"onKeyPress="if(this.value.length==16) return false;">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="text" name="fecha" id="fecha" class="form-control" onKeyPress="if(this.value.length==7) return false;">
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                            <label>CVV</label>
                            <input type="number" name="cvv" id="cvv" class="form-control" minlength="3" maxlength="3" onKeyPress="if(this.value.length==3) return false;">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nota</label>
                    <input type="text" name="nota" id="nota" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardarCard" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
</form>