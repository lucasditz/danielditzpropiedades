<form id="personaForm" class="form-horizontal form-label-left" novalidate>
    <div class="row" id="personaSearch">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 id="personaSearchTitle">Seleccionar persona</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:45px;"">
                    <button id="personaSearchBtn" type="button"  onclick="getPersonaInputForm();" class="btn btn-primary" style="margin-left: 30px;">Nueva Persona</button>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div id="personaSearchContent" class="x_content">
                    <table id="table_content_personas" class="table table-striped">
                        <col width="95%">
                        <col width="5%">
                        <thead>
                        <tr>
                            <th style="display: none"></th>
                            <th style="text-align: center;display: none;">Ver</th>
                        </tr>
                        </thead>
                        <tbody id="table_content_body_personas">
                        <tr>
                            <td align="center">
                            </td>
                            <td align="center">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="personaNewContent" class="x_content" style="display: none">
                    <div class="container" style="margin: 0 auto;width:80%;">
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="nombrePersona" class="control-label">Nombre<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="nombrePersona" required="required" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="apellidoPersona" class="control-label">Apellido<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="apellidoPersona" required="required" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="dniPersona" class="control-label">D.N.I.<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="dniPersona" required="required" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="fNacimientoPersona" class="control-label">Fecha Nacimiento</label>
                                </div>
                                <div class="short-div input-prepend input-group">
                                    <input type="text" id="fNacimientoPersona" class="form-control" onfocusout="closePersonDatePicker();">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="telefonoPersona" class="control-label">Teléfono</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="telefonoPersona" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="celularPersona" class="control-label">Celular</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="celularPersona" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="margin: 0 auto;width:80%;">
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-5">
                                <div class="short-div" style="text-align: left;">
                                    <label for="callePersona" class="control-label">Calle</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="callePersona" class="form-control" list='calleListid'>
                                    <datalist id='calleListid'>
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="nroPersona">Nro</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="nroPersona" class="form-control" list='nroListid'>
                                    <datalist id='nroListid'>
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="pisoPersona">Piso</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="pisoPersona" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="dptoPersona">Dpto</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="dptoPersona" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="short-div" style="text-align: left;">
                                    <label for="ciudadPersona" class="control-label">Ciudad</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="ciudadPersona" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="provinciaPersona">Provincia</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="provinciaPersona" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="container" style="margin: 0 auto;width:80%;">
                        <button id="personaSaveBtn" type="button"  onclick="checkPersonaData();" class="btn btn-primary" style="float:right;">Guardar</button>
                    </div>
                </div>
                <div id="personaViewContent" class="x_content" style="display: none">
                    <div class="container" style="margin: 0 auto;width:80%;">
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="nombrePersona_view" class="control-label">Nombre<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="nombrePersona_view" required="required" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="apellidoPersona_view" class="control-label">Apellido<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="apellidoPersona_view" required="required" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="dniPersona_view" class="control-label">D.N.I.<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="dniPersona_view" required="required" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="fNacimientoPersona_view" class="control-label">Fecha Nacimiento</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="fNacimientoPersona_view" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="telefonoPersona_view" class="control-label">Teléfono</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="telefonoPersona_view" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label for="celularPersona_view" class="control-label">Celular</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="celularPersona_view" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="margin: 0 auto;width:80%;">
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-5">
                                <div class="short-div" style="text-align: left;">
                                    <label for="callePersona_view" class="control-label">Calle</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="callePersona_view" class="form-control" list='calleListid' readonly>
                                    <datalist id='calleListid'>
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="nroPersona_view">Nro</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="nroPersona_view" class="form-control" list='nroListid' readonly>
                                    <datalist id='nroListid'>
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="pisoPersona_view">Piso</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="pisoPersona_view" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="dptoPersona_view">Dpto</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="dptoPersona_view" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="short-div" style="text-align: left;">
                                    <label for="ciudadPersona_view" class="control-label">Ciudad</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="ciudadPersona_view" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="provinciaPersona_view">Provincia</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="provinciaPersona_view" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="container" style="margin: 0 auto;width:80%;">
                        <button id="personaSelectBtn" type="button"  onclick="selectPerson();" class="btn btn-primary" style="float:right;">Seleccionar Persona</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>