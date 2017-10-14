<head>
    <!-- Components CSS -->
    <link href="components/css/components.css" rel="stylesheet">
</head>
<div class="container" style="margin: 0 auto;width:80%;" onload="setUp()">
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
                <input type="text" id="fNacimientoPersona" class="form-control">
                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
            </div>
        </div>
    </div>

</div>
<div class="container" style="margin: 0 auto;
    width:80%;">
    <div class="row" style="margin: 0 auto;width:80%;">
        <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-5">
            <div class="short-div" style="text-align: left;">
                <label for="callePersona" class="control-label">Calle<span class="required">*</span></label>
            </div>
            <div class="short-div">
                <input type="text" id="callePersona" required="required" class="form-control" list='calleListid'>
                <datalist id='calleListid'>
                </datalist>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
            <div class="short-div" style="text-align: left;">
                <label class="control-label" for="nroPersona">Nro<span class="required">*</span></label>
            </div>
            <div class="short-div">
                <input type="text" id="nroPersona" required="required" class="form-control" list='nroListid'>
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
        <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-5">
            <div class="short-div" style="text-align: left;">
                <label for="entreCallePersona" class="control-label">E/Calles</label>
            </div>
            <div class="short-div">
                <input type="text" id="entreCallePersona" class="form-control">
            </div>

            <div class="clearfix visible-xs-block visible-sm-block"></div>
        </div>
        <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="short-div" style="text-align: left;">
                <label for="zonaPersona" class="control-label">Zona</label>
            </div>
            <div class="short-div">
                <input type="text" id="zonaPersona" class="form-control">
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <div class="short-div" style="text-align: left;">
                <label for="codPostalPersona" class="control-label">Cód. Postal</label>
            </div>
            <div class="short-div">
                <input type="text" id="codPostalPersona" class="form-control">
            </div>
        </div>
    </div>
    <div class="row" style="margin: 0 auto;width:80%;">
        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="short-div" style="text-align: left;">
                <label for="ciudadPersona" class="control-label">Ciudad<span class="required">*</span></label>
            </div>
            <div class="short-div">
                <input type="text" id="ciudadPersona" required="required" class="form-control">
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="short-div" style="text-align: left;">
                <label class="control-label" for="provinciaPersona">Provincia</label>
            </div>
            <div class="short-div">
                <input type="text" id="provinciaPersona" class="form-control" placeholder="Buenos Aires">
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
