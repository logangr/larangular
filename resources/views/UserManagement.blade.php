<html>

<head>
    <title>AngularJS</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontAwesome-4.5.0/css/font-awesome.min.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('js/angular.min.js') }}"></script>
    <script src="{{ asset('js/angular-sanitize.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/service/user_service.js') }}"></script>
    <script src="{{ asset('js/controller/user_controller.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
</head>

<body ng-app="myApp" class="ng-cloak">

<div class="generic-container" ng-controller="UserController as ctrl">

    <div class="panel panel-default">

        <div class="panel-heading"><span class="lead">Registre d'usuari</span></div>

        <div class="formcontainer">

            <form ng-submit="ctrl.submit()" name="myForm" class="form-horizontal">

                <input type="hidden" ng-model="ctrl.user.id" />

                <limit-input id="uname"
                             label="Nom *"
                             camp="ctrl.user.username"
                             placeholder="Introdueix el teu nom"
                             type="text"
                             estil="username form-control input-sm"></limit-input>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label" for="uname">Nom *</label>
                        <div class="col-md-7">
                            <input type="text" ng-model="ctrl.user.username" id="uname" class="username form-control input-sm" placeholder="Introdueix el teu nom" required ng-minlength="3"/>
                            <div class="has-error" ng-show="myForm.$dirty">
                                <span ng-show="myForm.uname.$error.required">Aquest camp és obligatori</span>
                                <span ng-show="myForm.uname.$error.minlength">Heu d'introduir com a mínim 3 caràcters</span>
                                <span ng-show="myForm.uname.$invalid">Aquest camp no és vàlid</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label" for="address">Adreça</label>
                        <div class="col-md-7">
                            <input type="text" ng-model="ctrl.user.address" id="address" class="form-control input-sm" placeholder="Introdueix la teva adreça. [opcional]"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label" for="email">Email *</label>
                        <div class="col-md-7">
                            <input type="email" ng-model="ctrl.user.email" id="email" class="email form-control input-sm" placeholder="Introdueix el teu email" required/>
                            <div class="has-error" ng-show="myForm.$dirty">
                                <span ng-show="myForm.email.$error.required">Aquest camp és obligatori</span>
                                <span ng-show="myForm.email.$invalid">Aquest camp no és vàlid</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label" for="fecha">Data naixement *</label>
                        <div class="col-md-7">
                            <input type="date" ng-model="ctrl.user.fecha" id="fecha" class="fecha form-control input-sm" placeholder="dd/mm/aaaa" required/>
                            <div class="has-error" ng-show="myForm.$dirty">
                                <span ng-show="myForm.fecha.$error.required">Aquest camp és obligatori</span>
                                <span ng-show="myForm.fecha.$invalid">Aquest camp no és vàlid</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label" for="municipi">Municipi</label>
                        <div class="col-md-7">
                            <select ng-model="ctrl.user.municipi.id" ng-options="item.id as item.name for item in ctrl.municipis">
                                <option value="">Seleccionau munipici a on viviu</option>
                            </select>
                            <div class="has-error" ng-show="myForm.$dirty"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label" for="actiu">Actiu</label>
                        <div class="col-md-7">
                            <input type="checkbox" ng-model="ctrl.user.actiu" id="actiu" class="fecha form-control input-sm"/>
                            <div class="has-error" ng-show="myForm.$dirty"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-actions floatRight">
                        <button type="button" ng-click="ctrl.submit()" ng-bind-html="ctrl.user.id | nouEditar" class="btn btn-success" ng-disabled="myForm.$invalid"></button>
                        <button type="button" ng-click="ctrl.reset()" class="btn btn-warning" ng-disabled="myForm.$pristine">
                            <i class="fa fa-eraser">&nbsp;Netejar</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><span class="lead">Llistat d'usuaris</span></div>

        <div class="tablecontainer">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id.</th>
                    <th>Nom</th>
                    <th>Adreça</th>
                    <th>Email</th>
                    <th>Fecha</th>
                    <th>Municipi</th>
                    <th>Actiu</th>
                    <th width="20%"></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="u in ctrl.users">
                    <td><span ng-bind="u.id"></span></td>
                    <td><span ng-bind="u.username"></span></td>
                    <td><span ng-bind="u.address"></span></td>
                    <td><span ng-bind="u.email"></span></td>
                    <td><span ng-bind="u.fecha|date:'dd/MM/yyyy'"></span></td>
                    <td><span ng-bind="u.municipi.name"></span></td>
                    <td><span ng-bind-html="u.actiu|siNo"></span></td>
                    <td>
                        <button type="button" ng-click="ctrl.edit(u.id)"   class="btn btn-default custom-width">
                            <i class="fa fa-edit">&nbsp;Editar</i>
                        </button>
                        <button type="button" ng-click="ctrl.remove(u.id)" class="btn btn-danger custom-width">
                            <i class="fa fa-trash">&nbsp;Esborrar</i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><span class="lead">Llistat d'usuaris amb directiva</span></div>

        <div class="tablecontainer">
            <div class="row" ng-repeat="u in ctrl.users">
                <user-info info="u"></user-info>
            </div>
        </div>
    </div>

</div>

<!-- 	<div class="panel panel-default"> -->
<!-- 		<div class="panel-heading"><span class="lead">Users DataTable</span></div> -->
<!-- 		<div ng-controller="WithAjaxCtrl as showCase"> -->
<!-- 		    <table datatable="" dt-options="showCase.dtOptions" dt-columns="showCase.dtColumns" class="row-border hover"></table> -->
<!-- 		</div> -->
<!-- 	</div> -->



</body>

</html>