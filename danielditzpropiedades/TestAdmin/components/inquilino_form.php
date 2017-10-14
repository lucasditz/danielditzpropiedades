<div id="inquilinoInputContent" class="x_panel">
    <div class="x_title">
        <h2 style="float: left;text-align: left;">Inquilino</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <button id="inquilinoSearchBtn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#inquilinoSearchModal" onclick="openCloseInquilinoSearchPanel();" style="margin-left: 30px;">Buscar Persona</button>
            </li>
            <li><a id="minimizeInquilinoPanel" class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div id="inquilinoViewContent" class="x_content" style="display: none">
            <div class="container" style="margin: 0 auto;width:80%;">
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="short-div" style="text-align: left;">
                            <label for="nombreInquilino_view" class="control-label">Nombre<span class="required">*</span></label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="nombreInquilino_view" required="required" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="short-div" style="text-align: left;">
                            <label for="apellidoInquilino_view" class="control-label">Apellido<span class="required">*</span></label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="apellidoInquilino_view" required="required" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="short-div" style="text-align: left;">
                            <label for="dniInquilino_view" class="control-label">D.N.I.<span class="required">*</span></label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="dniInquilino_view" required="required" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="short-div" style="text-align: left;">
                            <label for="fNacimientoInquilino_view" class="control-label">Fecha Nacimiento</label>
                        </div>
                        <div class="short-div input-prepend input-group">
                            <input type="text" id="fNacimientoInquilino_view" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="short-div" style="text-align: left;">
                            <label for="telefonoInquilino_view" class="control-label">Teléfono</label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="telefonoInquilino_view" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="short-div" style="text-align: left;">
                            <label for="celularInquilino_view" class="control-label">Celular</label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="celularInquilino_view" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" style="margin: 0 auto;width:80%;">
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-5">
                        <div class="short-div" style="text-align: left;">
                            <label for="calleInquilino_view" class="control-label">Calle<span class="required">*</span></label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="calleInquilino_view" required="required" class="form-control" list='calleListid' readonly>
                            <datalist id='calleListid'>
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
                        <div class="short-div" style="text-align: left;">
                            <label class="control-label" for="nroInquilino_view">Nro<span class="required">*</span></label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="nroInquilino_view" required="required" class="form-control" list='nroListid' readonly>
                            <datalist id='nroListid'>
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
                        <div class="short-div" style="text-align: left;">
                            <label class="control-label" for="pisoInquilino_view">Piso</label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="pisoInquilino_view" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
                        <div class="short-div" style="text-align: left;">
                            <label class="control-label" for="dptoInquilino_view">Dpto</label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="dptoInquilino_view" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="short-div" style="text-align: left;">
                            <label for="ciudadInquilino_view" class="control-label">Ciudad<span class="required">*</span></label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="ciudadInquilino_view" required="required" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="short-div" style="text-align: left;">
                            <label class="control-label" for="provinciaInquilino_view">Provincia</label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="provinciaInquilino_view" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="inquilinoSearchModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Búsqueda Personas</h4>
                    </div>
                    <div id="inquilinoSearchModalBody" class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
