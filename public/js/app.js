'use strict';
 
//Controlador principal
//Afegim el modul sanitize perque sino les funcions no poden retornar codi HTML
var App = angular.module('myApp',['ngSanitize'])

.filter('siNo', function() {
	//Treu un codi html per el datatable amb unes icones representant un booleà
    return function(input) {
        return input ? '<i class="fa fa-check color-verd"></i>' : '<i class="fa fa-close color-vermell"></i>';
    }
})

.filter('nouEditar', function() {
	//Treu un codi html per el boto de guardar, depenent si estem insertant nou registre o modificant
    return function(input) {
    	var out = '<i class="fa fa-floppy-o">&nbsp;Guardar</i>';
    	if (input!=null) {
    		var out = '<i class="fa fa-floppy-o">&nbsp;Actualitzar</i>';
    	}
        return out;
    }
});

//angular.module('showcase.withAjax', ['datatables']).controller('WithAjaxCtrl', WithAjaxCtrl);
//
//function WithAjaxCtrl(DTOptionsBuilder, DTColumnBuilder) {
//	debugger;
//    var vm = this;
//    vm.dtOptions = DTOptionsBuilder.fromSource('data.json').withPaginationType('full_numbers');
//    vm.dtColumns = [
//        DTColumnBuilder.newColumn('id').withTitle('ID'),
//        DTColumnBuilder.newColumn('firstName').withTitle('First name'),
//        DTColumnBuilder.newColumn('lastName').withTitle('Last name')
//    ];
//}