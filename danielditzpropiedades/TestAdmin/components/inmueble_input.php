<form class="form-horizontal form-label-left" novalidate>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1 id="propietarioSearchTitle" style="float: left;text-align: left;">Inmueble</h1>
                    <div class="clearfix"></div>
                </div>
                <div id="inmuebleInputContent" class="x_content">
                    <!--DIRECCIÓN INMUEBLE -->
                    <div class="container" style="margin: 0 auto;width:80%;">
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-5">
                                <div class="short-div" style="text-align: left;">
                                    <label for="calleInmueble" class="control-label">Calle<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="calleInmueble" required="required" class="form-control" list='calleListid'>
                                    <datalist id='calleListid'>
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="nroInmueble">Nro<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="nroInmueble" required="required" class="form-control" list='nroListid'>
                                    <datalist id='nroListid'>
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="pisoInmueble">Piso</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="pisoInmueble" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="dptoInmueble">Dpto</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="dptoInmueble" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-5">
                                <div class="short-div" style="text-align: left;">
                                    <label for="entreCalleInmueble" class="control-label">E/Calles</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="entreCalleInmueble" class="form-control">
                                </div>
                                <!-- Add the extra clearfix for only the required viewport -->
                                <div class="clearfix visible-xs-block visible-sm-block"></div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label for="zonaInmueble" class="control-label">Zona</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="zonaInmueble" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-3">
                                <div class="short-div" style="text-align: left;">
                                    <label for="codPostalInmueble" class="control-label">Cód. Postal</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="codPostalInmueble" class="form-control" value="7400">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="short-div" style="text-align: left;">
                                    <label for="ciudadInmueble" class="control-label">Ciudad<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="ciudadInmueble" required="required" class="form-control" value="Olavarría">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="provinciaInmueble">Provincia</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="provinciaInmueble" class="form-control" value="Buenos Aires">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- DATOS ADICIONALES -->
                    <div class="container" style="margin: 0 auto;width:80%;">
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="comodidades">Comodidades</label>
                                </div>
                                <div class="short-div">
                                    <textarea id="comodidades" style="resize: none;" class="form-control"  rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                <div class="short-div" style="text-align: left;">
                                    <label for="mts2" class="control-label">Mts2</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="mts2" required="required" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-0 col-sm-3 col-md-4 col-lg-5">
                            </div>
                            <div class="form-group col-xs-12 col-sm-5 col-md-5 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label for="valor" class="control-label">Valor<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="valor" required="required" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>