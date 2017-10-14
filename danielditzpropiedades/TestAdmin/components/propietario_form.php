<form id="propietarioForm" class="form-horizontal form-label-left" novalidate>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1 id="propietarioSearchTitle" style="float: left;text-align: left;">Propietario</h1>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:45px;"">
                    <button id="propietarioSearchBtn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#propietarioSearchModal" onclick="openClosePropietarioSearchPanel();" style="margin-left: 30px;">Buscar Persona</button>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div id="propietarioViewContent" class="x_content" style="display: none">
                    <div class="container" style="margin: 0 auto;width:80%;">
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="nombrePropietario_view" class="control-label">Nombre<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="nombrePropietario_view" required="required" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="apellidoPropietario_view" class="control-label">Apellido<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="apellidoPropietario_view" required="required" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="dniPropietario_view" class="control-label">D.N.I.<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="dniPropietario_view" required="required" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="fNacimientoPropietario_view" class="control-label">Fecha Nacimiento</label>
                                </div>
                                <div class="short-div input-prepend input-group">
                                    <input type="text" id="fNacimientoPropietario_view" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="telefonoPropietario_view" class="control-label">Teléfono</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="telefonoPropietario_view" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="celularPropietario_view" class="control-label">Celular</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="celularPropietario_view" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="margin: 0 auto;width:80%;">
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-5">
                                <div class="short-div" style="text-align: left;">
                                    <label for="callePropietario_view" class="control-label">Calle<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="callePropietario_view" required="required" class="form-control" list='calleListid' readonly>
                                    <datalist id='calleListid'>
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="nroPropietario_view">Nro<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="nroPropietario_view" required="required" class="form-control" list='nroListid' readonly>
                                    <datalist id='nroListid'>
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="pisoPropietario_view">Piso</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="pisoPropietario_view" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="dptoPropietario_view">Dpto</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="dptoPropietario_view" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="short-div" style="text-align: left;">
                                    <label for="ciudadPropietario_view" class="control-label">Ciudad<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="ciudadPropietario_view" required="required" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="provinciaPropietario_view">Provincia</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="provinciaPropietario_view" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="propietarioSearchModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title">Búsqueda Personas</h4>
                            </div>
                            <div id="propietarioSearchModalBody" class="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
