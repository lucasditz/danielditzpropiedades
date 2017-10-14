<head>
    <!-- Components CSS -->
    <link href="components/css/components.css" rel="stylesheet">
</head>
<div class="container" style="margin: 0 auto;
    width:80%;">
    <div class="row" style="margin: 0 auto;width:80%;">
        <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-5">
            <div class="short-div" style="text-align: left;">
                <label for="calle" class="control-label">Calle<span class="required">*</span></label>
            </div>
            <div class="short-div">
                <input type="text" id="calle" required="required" class="form-control" list='calleListid'>
                <datalist id='calleListid'>
                </datalist>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
            <div class="short-div" style="text-align: left;">
                <label class="control-label" for="nro">Nro<span class="required">*</span></label>
            </div>
            <div class="short-div">
                <input type="text" id="nro" required="required" class="form-control" list='nroListid'>
                <datalist id='nroListid'>
                </datalist>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
            <div class="short-div" style="text-align: left;">
                <label class="control-label" for="piso">Piso</label>
            </div>
            <div class="short-div">
                <input type="text" id="piso" class="form-control" >
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-2">
            <div class="short-div" style="text-align: left;">
                <label class="control-label" for="dpto">Dpto</label>
            </div>
            <div class="short-div">
                <input type="text" id="dpto" class="form-control" >
            </div>
        </div>
    </div>
    <div class="row" style="margin: 0 auto;width:80%;">
        <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-5">
            <div class="short-div" style="text-align: left;">
                <label for="entreCalle" class="control-label">E/Calles</label>
            </div>
            <div class="short-div">
                <input type="text" id="entreCalle" class="form-control">
            </div>
            <!-- Add the extra clearfix for only the required viewport -->
            <div class="clearfix visible-xs-block visible-sm-block"></div>
        </div>
        <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="short-div" style="text-align: left;">
                <label for="zona" class="control-label">Zona</label>
            </div>
            <div class="short-div">
                <input type="text" id="zona" class="form-control">
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <div class="short-div" style="text-align: left;">
                <label for="codPostal" class="control-label">Cód. Postal</label>
            </div>
            <div class="short-div">
                <input type="text" id="codPostal" class="form-control">
            </div>
        </div>
    </div>
    <div class="row" style="margin: 0 auto;width:80%;">
        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="short-div" style="text-align: left;">
                <label for="ciudad" class="control-label">Ciudad<span class="required">*</span></label>
            </div>
            <div class="short-div">
                <input type="text" id="ciudad" required="required" class="form-control" value="Olavarría">
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="short-div" style="text-align: left;">
                <label class="control-label" for="provincia">Provincia</label>
            </div>
            <div class="short-div">
                <input type="text" id="provincia" class="form-control" value="Buenos Aires">
            </div>
        </div>
    </div>
</div>