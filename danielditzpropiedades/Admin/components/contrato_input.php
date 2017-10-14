<form class="form-horizontal form-label-left" novalidate>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1 id="propietarioSearchTitle" style="float: left;text-align: left;">Contrato</h1>
                    <div class="clearfix"></div>
                </div>
                <div id="contratoInputContent" class="x_panel">
                    <div class="x_title">
                        <h2 style="float: left;text-align: left;">Períodos de contrato</h2>
                        <ul class="nav navbar-right panel_toolbox" style="min-width: 0px !important;">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <p style="float: left">Variaciones en el valor del aqluiler</p>
                                <select id="periodSelector" style="float: left; margin-left: 10px" onchange="selectedPeridoChange();">
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" align="center">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <label style="float: left;font-size:15px;text-decoration: underline;">Primer período</label>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="firstStartDate">Fecha Inicio:<span class="required">*</span></label>
                                </div>
                                <div class="short-div input-prepend input-group">
                                    <input type="text" id="firstStartDate" required="required" class="form-control"  onfocusout="closefirstStartDateDatePicker()">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="firstEndDate">Fecha Fin:<span class="required">*</span></label>
                                </div>
                                <div class="short-div input-prepend input-group">
                                    <input type="text" id="firstEndDate" required="required" class="form-control"  onfocusout="closefirstEndDateDatePicker();">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="firstValue">Valor:<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="firstValue" required="required" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div id="secondVariationRow" class="row" align="center" style="display: none">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <label style="float: left;font-size:15px;text-decoration: underline;">Segundo período</label>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="secondStartDate">Fecha Inicio:<span class="required">*</span></label>
                                </div>
                                <div class="short-div input-prepend input-group">
                                    <input type="text" id="secondStartDate" required="required" class="form-control" onfocusout="closesecondStartDateDatePicker();">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="secondEndDate">Fecha Fin:<span class="required">*</span></label>
                                </div>
                                <div class="short-div input-prepend input-group">
                                    <input type="text" id="secondEndDate" required="required" class="form-control" onfocusout="closesecondEndDateDatePicker();">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="secondValue">Valor:<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="secondValue" required="required" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div id="thirdVariationRow" class="row" align="center" style="display: none">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <label style="float: left;font-size:15px;text-decoration: underline;">Tercer período</label>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="thirdStartDate">Fecha Inicio:<span class="required">*</span></label>
                                </div>
                                <div class="short-div input-prepend input-group">
                                    <input type="text" id="thirdStartDate" required="required" class="form-control" onfocusout="closethirdStartDateDatePicker();">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="thirdEndDate">Fecha Fin:<span class="required">*</span></label>
                                </div>
                                <div class="short-div input-prepend input-group">
                                    <input type="text" id="thirdEndDate" required="required" class="form-control" onfocusout="closethirdEndDateDatePicker();">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="thirdValue">Valor:<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="thirdValue" required="required" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div id="fourthVariationRow" class="row" align="center" style="display: none">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <label style="float: left;font-size:15px;text-decoration: underline;">Cuarto período</label>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="fourthStartDate">Fecha Inicio:<span class="required">*</span></label>
                                </div>
                                <div class="short-div input-prepend input-group">
                                    <input type="text" id="fourthStartDate" required="required" class="form-control"  onfocusout="closefourthStartDateDatePicker();">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="fourthEndDate">Fecha Fin:<span class="required">*</span></label>
                                </div>
                                <div class="short-div input-prepend input-group">
                                    <input type="text" id="fourthEndDate" required="required" class="form-control" onfocusout="closefourthEndDateDatePicker();">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="fourthValue">Valor:<span class="required">*</span></label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="fourthValue" required="required" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div id="honorariosRow" class="row" align="center">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <label style="float: left;font-size:15px;text-decoration: underline;">Honorarios</label>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="honorariosValue">Valor:</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="honorariosValue" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div id="depositoRow" class="row" align="center">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <label style="float: left;font-size:15px;text-decoration: underline;">Depósito</label>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="short-div" style="text-align: left;">
                                    <label class="control-label" for="depositoValue">Valor:</label>
                                </div>
                                <div class="short-div">
                                    <input type="text" id="depositoValue" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="serviciosInputContent" class="x_panel">
                    <div class="x_title">
                        <h2 style="float: left;text-align: left;">Servicios</h2>
                        <ul class="nav navbar-right panel_toolbox" style="min-width: 0px !important;">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row" style="margin: 0 auto;width:80%;">
                            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-3" style="text-align: left;">
                                <input type="checkbox" name="servicios[]" value=1> Expensas<br>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-3" style="text-align: left;">
                                <input type="checkbox" name="servicios[]" value=2> Municipal<br>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-2" style="text-align: left;">
                                <input type="checkbox" name="servicios[]" value=3> Agua<br>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-2" style="text-align: left;">
                                <input type="checkbox" name="servicios[]" value=4> Gas<br>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-2" style="text-align: left;">
                                <input type="checkbox" name="servicios[]" value=5> Luz<br>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include_once "components/inquilino_form.php" ?>
                <?php include_once "components/garante_form.php" ?>
            </div>
        </div>
    </div>
</form>