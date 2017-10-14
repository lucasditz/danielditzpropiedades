<head>
    <!-- Components CSS -->
    <link href="components/css/components.css" rel="stylesheet">
</head>
<div class="container" style="margin: 0 auto;
    width:80%;">
    <div class="row" style="margin: 0 auto;width:80%;">
        <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-5">
            <div class="short-div" style="text-align: left;">
                <label for="calle_view" class="control-label"">Calle<span class="required">*</span></label>
            </div>
            <div class="short-div">
                <input type="text" id="calle_view" required="required" class="form-control" list='calleListid' readonly>
                <datalist id='calleListid'>
                </datalist>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
            <div class="short-div" style="text-align: left;">
                <label class="control-label" for="nro_view">Nro<span class="required">*</span></label>
            </div>
            <div class="short-div">
                <input type="text" id="nro_view" required="required" class="form-control" list='nroListid' readonly>
                <datalist id='nroListid'>
                </datalist>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
            <div class="short-div" style="text-align: left;">
                <label class="control-label" for="piso_view">Piso</label>
            </div>
            <div class="short-div">
                <input type="text" id="piso_view" class="form-control" readonly>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
            <div class="short-div" style="text-align: left;">
                <label class="control-label" for="dpto_view">Dpto</label>
            </div>
            <div class="short-div">
                <input type="text" id="dpto_view" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row" style="margin: 0 auto;width:80%;">
        <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-5">
            <div class="short-div" style="text-align: left;">
                <label for="entreCalle_view" class="control-label">E/Calles</label>
            </div>
            <div class="short-div">
                <input type="text" id="entreCalle_view" class="form-control" readonly>
            </div>
            <!-- Add the extra clearfix for only the required viewport -->
            <div class="clearfix visible-xs-block visible-sm-block"></div>
        </div>
        <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="short-div" style="text-align: left;">
                <label for="zona_view" class="control-label">Zona</label>
            </div>
            <div class="short-div">
                <input type="text" id="zona_view" class="form-control" readonly>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <div class="short-div" style="text-align: left;">
                <label for="codPostal_view" class="control-label">Cód. Postal</label>
            </div>
            <div class="short-div">
                <input type="text" id="codPostal_view" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row" style="margin: 0 auto;width:80%;">
        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="short-div" style="text-align: left;">
                <label for="ciudad_view" class="control-label">Ciudad<span class="required">*</span></label>
            </div>
            <div class="short-div">
                <input type="text" id="ciudad_view" required="required" class="form-control" readonly>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="short-div" style="text-align: left;">
                <label class="control-label" for="provincia_view">Provincia</label>
            </div>
            <div class="short-div">
                <input type="text" id="provincia_view" class="form-control" value="Buenos Aires" readonly>
            </div>
        </div>
    </div>
</div>