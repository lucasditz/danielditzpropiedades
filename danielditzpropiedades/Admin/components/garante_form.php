<div id="garanteInputContent" class="x_panel">
    <div class="x_title">
        <h2 style="float: left;text-align: left;">Garante</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <button id="garanteSearchBtn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#garanteSearchModal" onclick="openCloseGaranteSearchPanel();" style="margin-left: 30px;">Buscar Persona</button>
            </li>
            <li><a id="minimizeGarantePanel" class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div id="garanteViewContent" class="x_content" style="display: none">
            <div class="container" style="margin: 0 auto;width:80%;">
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="short-div" style="text-align: left;">
                            <label for="nombreGarante_view" class="control-label">Nombre<span class="required">*</span></label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="nombreGarante_view" required="required" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="short-div" style="text-align: left;">
                            <label for="apellidoGarante_view" class="control-label">Apellido<span class="required">*</span></label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="apellidoGarante_view" required="required" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="short-div" style="text-align: left;">
                            <label for="dniGarante_view" class="control-label">D.N.I.<span class="required">*</span></label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="dniGarante_view" required="required" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="short-div" style="text-align: left;">
                            <label for="fNacimientoGarante_view" class="control-label">Fecha Nacimiento</label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="fNacimientoGarante_view" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="short-div" style="text-align: left;">
                            <label for="telefonoGarante_view" class="control-label">Teléfono</label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="telefonoGarante_view" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="short-div" style="text-align: left;">
                            <label for="celularGarante_view" class="control-label">Celular</label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="celularGarante_view" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" style="margin: 0 auto;width:80%;">
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-5">
                        <div class="short-div" style="text-align: left;">
                            <label for="calleGarante_view" class="control-label">Calle</label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="calleGarante_view" class="form-control" list='calleListid' readonly>
                            <datalist id='calleListid'>
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
                        <div class="short-div" style="text-align: left;">
                            <label class="control-label" for="nroGarante_view">Nro</label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="nroGarante_view"  class="form-control" list='nroListid' readonly>
                            <datalist id='nroListid'>
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
                        <div class="short-div" style="text-align: left;">
                            <label class="control-label" for="pisoGarante_view">Piso</label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="pisoGarante_view" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
                        <div class="short-div" style="text-align: left;">
                            <label class="control-label" for="dptoGarante_view">Dpto</label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="dptoGarante_view" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 auto;width:80%;">
                    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="short-div" style="text-align: left;">
                            <label for="ciudadGarante_view" class="control-label">Ciudad</label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="ciudadGarante_view" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="short-div" style="text-align: left;">
                            <label class="control-label" for="provinciaGarante_view">Provincia</label>
                        </div>
                        <div class="short-div">
                            <input type="text" id="provinciaGarante_view" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="garanteSearchModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Búsqueda Personas</h4>
                    </div>
                    <div id="garanteSearchModalBody" class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
