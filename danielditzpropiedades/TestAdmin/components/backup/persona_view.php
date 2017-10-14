<head>
    <!-- Components CSS -->
    <link href="components/css/components.css" rel="stylesheet">
</head>
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
            <div class="short-div input-prepend input-group">
                <input type="text" id="fNacimientoPersona_view" class="form-control" readonly>
            </div>
        </div>
    </div>

</div>
<div class="container" style="margin: 0 auto;
    width:80%;">
    <div class="row" style="margin: 0 auto;width:80%;">
        <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-5">
            <div class="short-div" style="text-align: left;">
                <label for="callePersona_view" class="control-label">Calle<span class="required">*</span></label>
            </div>
            <div class="short-div">
                <input type="text" id="callePersona_view" required="required" class="form-control" list='calleListid' readonly>
                <datalist id='calleListid'>
                </datalist>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
            <div class="short-div" style="text-align: left;">
                <label class="control-label" for="nroPersona_view">Nro<span class="required">*</span></label>
            </div>
            <div class="short-div">
                <input type="text" id="nroPersona_view" required="required" class="form-control" list='nroListid' readonly>
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
        <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-5">
            <div class="short-div" style="text-align: left;">
                <label for="entreCallePersona_view" class="control-label">E/Calles</label>
            </div>
            <div class="short-div">
                <input type="text" id="entreCallePersona_view" class="form-control" readonly>
            </div>
            Add the extra clearfix for only the required viewport
            <div class="clearfix visible-xs-block visible-sm-block"></div>
        </div>
        <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="short-div" style="text-align: left;">
                <label for="zonaPersona_view" class="control-label">Zona</label>
            </div>
            <div class="short-div">
                <input type="text" id="zonaPersona_view" class="form-control" readonly>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <div class="short-div" style="text-align: left;">
                <label for="codPostalPersona_view" class="control-label">Cód. Postal</label>
            </div>
            <div class="short-div">
                <input type="text" id="codPostalPersona_view" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row" style="margin: 0 auto;width:80%;">
        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="short-div" style="text-align: left;">
                <label for="ciudadPersona_view" class="control-label">Ciudad<span class="required">*</span></label>
            </div>
            <div class="short-div">
                <input type="text" id="ciudadPersona_view" required="required" class="form-control" readonly>
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

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- jquery.inputmask -->
<script src="../vendors/jquery.inputmask/dist/min/inputmask/inputmask.min.js"></script>
<script src="../vendors/jquery.inputmask/dist/min/inputmask/jquery.inputmask.min.js"></script>
<script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<!-- /jquery.inputmask -->

<!-- bootstrap-daterangepicker -->
<script src="js/moment/moment.min.js"></script>
<script src="../vendors/moment/locale/es.js"></script>
<script src="js/datepicker/daterangepicker.js"></script>