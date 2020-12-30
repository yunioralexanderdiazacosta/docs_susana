<!-- Modal -->
<form id="formReportCard" name="formulario">
<div class="modal fade" id="reportCard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reportar Tarjeta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_cardReport">
                <div id="datos_ajax_report"></div>
                <div class="form-group">
                    <label>Numero Tarjeta</label>
                    <input type="text" name="tarjeta" id="tarjetaReport" readonly="" class="form-control">
                </div>

                <div class="form-group">
                    <label>Descripción del Problema</label>
                    <textarea class="form-control" id="descripcion" rows="5"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="enviarReportCard" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </div>
</div>
</form>