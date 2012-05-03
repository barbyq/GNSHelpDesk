/*Funcion que manda carga los tickets del usuario seleccionado
Ahorita le tengo hardcoded que el 2 pero después va a recibir eso en el parámetro
*/
function misTickets()
{
	userId = document.getElementById("userId").value;
	console.log(userId);
	$.ajax({
		type: 'GET',
		url: 'tickets/tickets.php',
		data: {empleadoId: userId},
		success: function(data)
		{
			$('#overview').html(data);	
		}
	});
}

function getTickets(type){
	$.ajax({
			type: 'GET',
			url: 'tickets/tickets.php',
			data: {type: type},
			success: function(data)
			{
				$('#overview').html(data);	
			}
		});
}

/*me regresa la vista general del ticket seleccionado*/
function getTicket(ticketId)
{
	$.ajax({
		type: 'GET',
		url: 'tickets/main.php',
		data: {ticketId: ticketId},
		success: function(data)
		{
			$('#main').html(data);	
			$('.hidden').hide();
			$('#guardarTicket').hide();
		}
	});
}


function getClientes(type)
{
	$.ajax({
		type: 'GET',
		url: 'clientes/clientes.php',
		data: {type: type},
		success: function(data)
		{
			$('#overview').html(data);	
		}
	});
}

function getClientesConf()
{
	$.ajax({
		type: 'GET',
		url: 'configuracion/clientes/clientes.php',
		success: function(data)
		{
			$('#overview').html(data);	
		}
	});
}

function getClientesMain(clienteId)
{
	$.ajax({
		type: 'GET',
		url: 'configuracion/clientes/main.php',
		data: {clienteId: clienteId},
		success: function(data)
		{
			$('#main').html(data);	
			var RFC = $('.RFC').text();
			if (RFC == 0)
			{
				$("#addSucursal").html("");
			}
			else
			{
				cargarSucursal(RFC);
			}
			//$('.hidden').hide();
			//$('#guardarTicket').hide();
		}
	});
}

function cargarSucursal(RFC)
{
	var data = new Object();
	data.RFC = RFC;
	dataString = JSON.stringify(data);
	//console.log('DataString' + dataString);
	$.ajax({
		type: 'GET',
		datatype: 'json',
		data: {json: dataString},
		url: 'includes/autocomplete/sucursales.php',
		success: function(data)
		{
			var obj = $.parseJSON(data);
			var htmlString = '<td>Sucursal:</td><td><select id="sucursal">';
			for (s in obj)
			{
				htmlString += '<option value="' + obj[s].SucursalId +'">'+ obj[s].Direccion + '</option>';
			}
			//console.log("el HTML ES " + htmlString);
			$("#addSucursal").html(htmlString);
			console.log('Selected: ' + $('#sucursal option:selected').val());
			//cargarContratoCode( RFC);
		}
	});/*end ajax */
}

function cargarContratoCode(RFC)
{
	$.ajax({
		type: 'GET',
		datatype: 'json',
		data: {RFC: RFC},
		url: 'includes/autocomplete/contratos.php',
		success: function(data)
		{
			var obj = $.parseJSON(data);
			var htmlString = '<select id="contrato">';
			for (s in obj)
			{
				htmlString += '<option value="' + obj[s].ContratoId +'">'+ obj[s].ContratoCode + '</option>';
			}
			htmlString += '</select>';
			console.log("el HTML ES " + htmlString);
			$("#numContrato").html(htmlString);
		}
	});	
}

function getInfoEmpresa(RFC){
	$.ajax({
		type: 'GET',
		url: 'clientes/mainEmpresa.php',
		data: {RFC: RFC},
		success: function(data)
		{
			$('#main').html(data);	
			//$('.hidden').hide();
			//$('#guardarTicket').hide();
		}
	});
}

function getInfoCliente(clienteId){
	$.ajax({
		type: 'GET',
		url: 'clientes/mainCliente.php',
		data: {clienteId: clienteId},
		success: function(data)
		{
			$('#main').html(data);	
		}
	});
}
function getEmpresasConf(){
	$.ajax({
			type: 'GET',
			url: 'configuracion/empresas/empresas.php',
			success: function(data)
			{
				$('#overview').html(data);	
			}
		});
}

function getEmpresaConf(RFC){
	$.ajax({
			type: 'GET',
			url: 'configuracion/empresas/main.php',
			data: {RFC: RFC},
			success: function(data)
			{
				$('#main').html(data);	
				$('.hidden').hide();
				//$('#guardarEmpresa').hide();
			}
		});
}

function getTipos(){
	$.ajax({
		type: 'GET',
		url: 'configuracion/tipos/tipos.php',
		success: function(data)
		{
			$('#overview').html(data);	
		}
	});
}

function getTipo(tipoId)
{
	$.ajax({
		type: 'GET',
		url: 'configuracion/tipos/main.php',
		data: {tipoId: tipoId},
		success: function(data)
		{
			$('#main').html(data);
			$('.hidden').hide();
			$('#actualizarTipo').hide();
		}
	});
}

function getContrato(contratoUsuarioId){
	$.ajax({
		type: 'GET',
		url: 'configuracion/contratos/main.php',
		data: {contratoUsuarioId: contratoUsuarioId},
		success: function(data)
		{
			$('#main').html(data);
			$( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
			$('.hidden').hide();
			//$('#actualizarTipo').hide();
		}
	});
}

function getContratos(){
	$.ajax({
		type: 'GET',
		url: 'configuracion/contratos/contratos.php',
		success: function(data)
		{
			$('#overview').html(data);	
		}
	});
}


function getUsuarios(){
	$.ajax({
		type: 'GET',
		url: 'configuracion/usuarios/usuarios.php',
		success: function(data)
		{
			$('#overview').html(data);	
		}
	});
}

function getUsuario(usuarioId){
	$.ajax({
		type: 'GET',
		url: 'configuracion/usuarios/main.php',
		data: {usuarioId: usuarioId},
		success: function(data)
		{
			$('#main').html(data);
			$('.hidden').hide();
			$('#actualizarUsuario').hide();
		}
	});
}

function getConfMantenimientos()
{
	$.ajax({
		type: 'GET',
		url: 'configuracion/mantenimientos/mantenimientos.php', 
		success: function(data)
		{
			$('#overview').html(data);	
		}
	});
}

function getMantenimientosContrato(contratoId)
{
	$.ajax({
		type: 'GET',
		url: 'configuracion/mantenimientos/main.php',
		data: {contratoId: contratoId},
		success: function(data)
		{
			$('#main').html(data);
			$( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
			$('.hidden').hide();
		}
	});
}

$(function()
{	
	var empleadoId = ""; 
	var clienteId = "";
	var ticketId = "";
	var empresaId = "";
	var sucursalId = "";
	var tipoId = "";
	var userId = ""; //usuario que esta loggeado;
	
/*LOGIN*/
	$("#login_button").click(function()
	{
		console.log("entro");
		var email = document.getElementById("email").value;
		var password = document.getElementById("password").value;
		console.log(email);
		console.log(password);
		$.ajax({
			type: 'POST',
			url: 'validar.php',
			data: {email: email,
					password: password},
			success: function(data)
			{
				console.log(data);
				var index = data.indexOf('-success');
				if (index != -1)
				{
					userId = data.substring(0, index);
					console.log("user id: " + userId);
					window.location.href = "../index.php";
				}
				else
				{
					$("#login_error").text(data);
				}	
			}
		});
	});//end login
	
	$("#logout").click(function()
	{
			$.ajax({
			type: 'GET',
			url: 'login/logout.php',
			success: function(data)
			{
				window.location.href = "login/login.php";	
			}
		});
	});
	
	
	/*Nav Toggle*/
	$( '.submenu' )
	.hide()
	.click(function( e ){
		e.stopPropagation();/*para que el click no actue sobre el li superior*/
	});
	
	$('#nav > ul > li').click(function ()
	{
		$(this).find('.submenu').slideToggle();
	});
	
	/*Click events*/
/*TICKETS */
	/*Click en la opción del menú principal llamado MisTickets*/
	$('#misTickets').click(function()
	{
		misTickets();
		$('#main').html("");
	});
	
	/*Click en la opción del menú principal llamado Sin Asignar*/
	$('#sinAsignar').click(function()
	{
		var type = 'Sin Asignar';
		getTickets(type);
		$('#main').html("");
	});
	
	/*Click en la opción del menú principal llamado Todos*/
	$('#todos').click(function()
	{
		var type = 'Todos';
		getTickets(type);
		$('#main').html("");
	});
	
	/*Click en un ticket del panel overview, manda cargar la informacion del ticket seleccionado en main
	  */
	$('.ticket').live('click', function() {
  		
  		ticketId = "";
  		ticketId = $(this).find('#ticketId').val();
  		getTicket(ticketId);
  		console.log('TicketId:' + ticketId);
  	});
	
		
	/*Click para agregar un ticket desde el panel de overview, carga la forma en main
	que se utiliza para agregar tickets
	tuve que cargar la opción de autocomplete aquí por que no existe live o on para autocomplete
	*/
	$('#agregarIcon').live('click', function() {
  		$.ajax({
			type: 'GET',
			url: 'tickets/agregar.php',
			success: function(data)
			{
				$('#main').html(data);	
				
				autoCompleteEmpleado();
				clienteId = "";
				$( "#cliente" ).autocomplete({
					source: "includes/autocomplete/clientes.php",
					minLength: 1,
					select: function( event, ui ) {
						if (ui.item){
							clienteId = ui.item.id;
							console.log(clienteId);
						}
					}
				});/*end autocomplete empleados*/
			}
		});/*end ajax */
	});
	
	/*En main.php, click para agregar el ticket en la base de dates, 
	manda llamar insertTicket.php*/
	$("#main").on("click", "#agregarTicket", function(event){
		if (clienteId == "")
		{
			alert("Porfavor llena los campos vacíos");
		}
		else
		{
			var data = new Object();
			data.clienteId = clienteId;
			data.asunto = document.getElementById("asunto").value;
			data.usuarioId = empleadoId;
			data.tipoId = $("#tipo option:selected").val();
			data.status =  document.getElementById("status").value;
			data.prioridad = document.getElementById("prioridad").value;
			data.descripcion = document.getElementById("descripcion").value;
			dataString = JSON.stringify(data);
		
			$.ajax({
				type: 'POST',
				url: 'tickets/insertTicket.php',
				data: {json: dataString,
					type:'insert'},
				datatype:"json",
				success: function(data)
				{
					ticketId = data;
					getTicket(ticketId);
					misTickets();
					
				},
					error: function(xhr, desc, err) {
	        		console.log(xhr);
	        		console.log("Desc: " + desc + "\nErr:" + err);
	        	}
			});	
			
		}/*end else*/
	});
	
	
	/*Click en main.php para atender ticket
		esconde forma de ver y agrega campos para agregar los cambios
	*/
	$("#main").on("click", "#atenderTicket", function(event){
		autoCompleteEmpleado();
		if ($(".hidden").is(":hidden"))
		{
			$('.show').hide();
			$('#guardarTicket').show();
			$('.hidden').slideDown('slow');
			$(this).attr('value', 'Cancelar');
			console.log("Ticket Id que se tiene después de dar click en atender: " + ticketId);
		}
		else
		{
			$('#guardarTicket').hide();
			$('.hidden').slideUp('slow');
			$('.show').show();
			$(this).attr('value','Atender Ticket');
		}
	});
	
	/*Click en forma main.php que guarda la info actualizada después de 
	seleccionar atenderTicket*/
	$("#main").on("click", "#guardarTicket", function(event){
		console.log("Ticket Id antes de guardar Ticket: " + ticketId);
		var data = new Object();
		data.ticketId = ticketId;
		data.status =  document.getElementById("status").value;
		console.log("El empleadoId que se esta guardando" + empleadoId);
		data.usuarioId = empleadoId;
		data.tipoId = $("#tipo option:selected").val();
		data.prioridad = document.getElementById("prioridad").value;
		data.descripcion = document.getElementById("descripcion").value;
		dataString = JSON.stringify(data);
		
		$.ajax({
			type: 'POST',
			url: 'tickets/insertTicket.php',
			data: {json: dataString,
					type:'atender'},
			datatype:"json",
			success: function(data)
			{	
				getTicket(data);
				misTickets();
			},
			error: function(xhr, desc, err) {
        	console.log(xhr);
        	console.log("Desc: " + desc + "\nErr:" + err);
        	}
		});
		
	});
	
	
/*CLIENTES submenu*/
	
	
	/*Click en empresas me despliega las empresas que hay*/
	$('#nav #empresas').click(function()
	{
		$.ajax({
			type: 'GET',
			url: 'clientes/clientes.php',
			data: {type: 'Empresas'},
			success: function(data)
			{
				$('#overview').html(data);	
			}
		});
		$('#main').html("");//Cargar vacio el main para que se borre lo que habia
	});
	
	$("#overview").on("click", ".empresaView", function(event){
		empresaId = "";
		empresaId = $(this).attr('data-value');
		console.log("EmpresaId:" + empresaId);
		getInfoEmpresa(empresaId);	
	
	});
	
	$("#main").on("click", "#ticketContent #empresa", function(event){
		empresaId = "";
		empresaId = $(this).find('.RFC').val();
		console.log("EmpresaId:" + empresaId);
		getInfoEmpresa(empresaId);	
	});
	
	$("#main").on("click", "#ticketContent .clienteId", function(event){
		clienteId = "";
  		clienteId = $(this).val();
  		getInfoCliente(clienteId);
  		console.log('ClienteId Despues:' + clienteId);	
	});
	
	$("#overview").on("click", ".clienteView", function(event){
		console.log('ClienteId Antes:' + clienteId);
  		clienteId = "";
  		clienteId = $(this).val();
  		getInfoCliente(clienteId);
  		console.log('ClienteId Despues:' + clienteId);
	
	});
		
	$('#nav #personas').click(function()
	{
		getClientes('Personas');
		$('#main').html("");
	});
	
	
	/*Reportes*/
	$('#reportes').click(function()
	{
		$('#overview').html("");
		$('#main').load('reportes.html');
	});
	
	/*Mantenimientos*/
	$('#mantenimientos').click(function()
	{
		getMantenimientos();
		$('#main').html("");
	});
	
	$("#overview").on("click", ".mantenimientoView", function(event){
		var contratoId = "";
		contratoId = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'mantenimientos/main.php',
			data: {contratoId: contratoId},
			success: function(data)
			{
				$('#main').html(data);
			}
		});
	});
	
	function getMantenimientos()
	{
		$.ajax({
			type: 'GET',
			url: 'mantenimientos/mantenimientos.php', 
			success: function(data)
			{
				$('#overview').html(data);	
			}
		});
	}	
	
	
	/*Configuracion*/
/*CONFIGURACION EMPRESAS*/
	$('#confEmpresas').click(function()
	{
		getEmpresasConf();
		$('#main').html("");//Cargar vacio el main para que se borre lo que habia
	});
	
	$("#overview").on("click", ".empresaConfView", function(event){
		var empresaId = "";
		empresaId = $(this).attr('data-value');
		getEmpresaConf(empresaId);
		console.log("EmpresaId:" + empresaId);
		
	});
	
	$("#main").on("click", "#editarEmpresa", function(event){
		if ($(".hidden").is(":hidden"))
		{
			$('.show').hide();
			//$('#actualizarTipo').show();
			$('.hidden').slideDown('slow');
			$(this).attr('value', 'Cancelar');
		}
		else
		{
			//$('#actualizarTipo').hide();
			$('.hidden').slideUp('slow', function(){
				$('.show').fadeIn();
			});
			$(this).attr('value','Editar');
		}
	});
	
	$("#overview").on("click", "#agregarEmpresaIcon", function(event){
		$.ajax({
			type: 'GET',
			url: 'configuracion/empresas/agregar.php',
			success: function(data)
			{
				$('#main').html(data);
			}
		});/*end ajax */
	});
	
	$('#main').on("click", "#agregarEmpresa", function(event){
		var dataEmp = new Object();
		dataEmp.RFC = document.getElementById("RFC").value;
		dataEmp.Nombre = document.getElementById("empresa").value;
		var dataSuc = new Object();
		dataSuc.RFC = document.getElementById("RFC").value;
		dataSuc.telefono = document.getElementById("telefono").value;
		dataSuc.direccion = document.getElementById("direccion").value;
		dataStringEmp = JSON.stringify(dataEmp);
		dataStringSuc = JSON.stringify(dataSuc);
		console.log(dataStringEmp);
		console.log(dataStringSuc);
		$.ajax({
			type: 'POST',
			url: 'configuracion/empresas/insertEmpresa.php',
			data: {emp: dataStringEmp,
					suc: dataStringSuc,
				type:'insert'},
			datatype:"json",
			success: function(data)
			{
				getEmpresasConf();
				getEmpresaConf(document.getElementById("RFC").value);
				console.log("success");
			},
				error: function(xhr, desc, err) {
        		console.log(xhr);
        		console.log("Desc: " + desc + "\nErr:" + err);
        	}
		});	
	});

	$('#main').on("click", "#actualizarEmpresa", function(event){
		var data = new Object();
		data.RFC = $('.RFC').text();
		data.Nombre = document.getElementById("empresaUpdate").value;
		data.NewRFC = document.getElementById("RFCUpdate").value;
		dataString = JSON.stringify(data);
		console.log(dataString);
		$.ajax({
				type: 'POST',
				url: 'configuracion/empresas/insertEmpresa.php',
				data: {json: dataString,
					type:'update'},
				datatype:"json",
				success: function(data)
				{
					getEmpresasConf();
					console.log(document.getElementById("RFCUpdate").value);
					getEmpresaConf(document.getElementById("RFCUpdate").value);
					console.log("success");
				},
					error: function(xhr, desc, err) {
	        		console.log(xhr);
	        		console.log("Desc: " + desc + "\nErr:" + err);
	        	}
			});	
	});
	
	$("#main").on("click", "#deleteEmpresa", function(event){
		if (confirm("Seguro que deseas eliminar?")){
			var RFC = $('.RFC').text();
			$.ajax({
				type: 'POST',
				url: 'configuracion/empresas/deleteEmpresa.php',
				data: {RFC: RFC},
				success: function(data)
				{
					
					if (data == 'nodelete'){
						alert("No se puede eliminar por que existen sucursales registradas en esta empresa.");
					}
					else{
						
						getEmpresasConf();
						$('#main').html('');
					}
					console.log("success");
				},
					error: function(xhr, desc, err) {
	        		console.log(xhr);
	        		console.log("Desc: " + desc + "\nErr:" + err);
	        	}
			});	
		}
	});
	
	$("#main").on("click", ".editThis", function(event){
		var sucursal = $(this).parents('.sucursales');
		var hidden = sucursal.find('.hideSuc');
		var show = sucursal.find('.showSuc');
		var sucursalId = sucursal.find('.sucursalId').val();
		
		if (hidden.is(":hidden"))
		{
			show.fadeOut(function(){
				hidden.fadeIn();	
			});
			$(this).attr('value', 'Cancelar');
		}else
		{
			hidden.fadeOut('slow', function(){
				show.fadeIn();
			});
			$(this).attr('value','Editar');
		}

		console.log('SucursaldId: ' + sucursalId);
	});
	
	$("#main").on("click", ".deleteThis", function(event){
		var sucursal = $(this).parents('.sucursales');
		var sucursalId = sucursal.find('.sucursalId').val();
		var RFC = $('.RFC').text();
		if (confirm('¿Seguro que deseas eliminar?') == true){
			$.ajax({
				type: 'POST',
				url: 'configuracion/empresas/deleteSucursal.php',
				data: {sucursalId : sucursalId},
				success: function(data)
				{
					console.log(data);
					if (data == 'nodelete'){
						alert("No se puede eliminar por que existen clientes registrados en esta sucursal.");
					}
					else{
						
						getEmpresaConf(RFC);
						
					}				
				},
				error: function(xhr, desc, err) {
	        		console.log(xhr);
	        		console.log("Desc: " + desc + "\nErr:" + err);
	        	}
			});
		}
	});
	
	$("#main").on("click", "#agregarSucursalIcon", function(event){
		if ($('.hideAgSuc').is(":hidden"))
		{
			$('.hideAgSuc').slideDown();
			$(this).attr('value', 'Cancelar');
		}else
		{
			$('.hideAgSuc').slideUp();
			$(this).attr('value','Agregar Sucursal');
		}
	});
	
	$("#main").on("click", "#agregarSucursal", function(event){
		
		var RFC = $('.RFC').text();
		var data = new Object();
		data.direccion = document.getElementById("direccionAg").value;
		data.telefono = document.getElementById("telefonoAg").value;
		data.RFC = RFC;
		var dataString = JSON.stringify(data);	
		console.log("Sucursal:" + dataString);
		$.ajax({
			type: 'POST',
			url: 'configuracion/empresas/insertSucursal.php',
			data: {json: dataString,
				type:'insert'},
			datatype:"json",
			success: function(data)
			{
				console.log(data);
				getEmpresaConf(RFC);
				console.log("success");
			},
			error: function(xhr, desc, err) {
        		console.log(xhr);
        		console.log("Desc: " + desc + "\nErr:" + err);
        	}
		});	
	});
	
	$('#main').on("click", ".actualizarSucursal", function(event){
		var RFC = $('.RFC').text();
		var sucursal = $(this).parents('.sucursales');
		var sucursalId = sucursal.find('.sucursalId').val();
		var data = new Object();
		data.direccion = sucursal.find('.direccionUp').val();
		data.telefono = sucursal.find('.telefonoUp').val();
		data.sucursalId = sucursalId;
		data.RFC = RFC;
		dataString = JSON.stringify(data);
		console.log(dataString);
		$.ajax({
				type: 'POST',
				url: 'configuracion/empresas/insertSucursal.php',
				data: {json: dataString,
				type:'update'},
				datatype:"json",
				success: function(data)
				{
					console.log(data);
					getEmpresaConf(RFC);
					console.log("success");
				},
					error: function(xhr, desc, err) {
	        		console.log(xhr);
	        		console.log("Desc: " + desc + "\nErr:" + err);
	        	}
			});	
	});
	
/*CONFIGURACION TICKETS*/
	$('#confTickets').click(function()
	{
		var type = 'Todos';
		getTickets(type);
		$('#main').html("");
	});
	
	
/*CONFIGURACION CLIENTES*/
	$('#confClientes').click(function()
	{
		getClientesConf();
		$('#main').html("");
	});
	
	$("#overview").on("click", ".clienteConfView", function(event){
		console.log('ClienteId Antes:' + clienteId);
  		clienteId = "";
  		clienteId = $(this).val();
  		
  		getClientesMain(clienteId);
		
  		console.log('ClienteId Despues:' + clienteId);
	
	});
	
	$("#overview").on("click", "#agregarClienteIcon", function(event){
		$.ajax({
			type: 'GET',
			url: 'configuracion/clientes/agregar.php',
			success: function(data)
			{
				
				$('#main').html(data);
				$('.addEmpresa').hide();
				$( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
				$('#numContrato').html('<input type="text" placeholder="Número Contrato" id="contratoCode"/>');
				//$('.addContrato').hide();
				autoCompleteEmpresas();
				//focusContrato();
				
				
			}
		});/*end ajax */
	});
	
	$("#main").on("click", "#agregarCliente", function(event){
		var data = new Object();
		var type = "";
		
		data.Cliente = document.getElementById("cliente").value;
		data.TelefonoCliente = document.getElementById("telefonoC").value;
		data.Email = document.getElementById("email").value;
		data.Contrasena = document.getElementById("contrasena").value;	
		if (empresaId != "")
		{
			//empresa nueva o empresa Null
			//console.log($("#sucursal option:selected").val());
			data.SucursalId = $("#sucursal option:selected").val();
			//necesito conseguir UsuarioId
			data.ContratoId = $("#numContrato option:selected").val();
			type = "existente"
		}
		else
		{
			data.ContratoCode = document.getElementById("contratoCode").value;
			data.Status = "Nuevo";
			data.FechaInicio = document.getElementById("inicio").value;
			data.FechaVencimiento = document.getElementById("vencimiento").value;
			data.serviceId = $("#sla option:selected").val();
			data.Descripcion = document.getElementById("descripcion").value;
			
			if(document.getElementById("empresa").value == "")//Empresa Null
			{
				data.SucursalId = "null";
				type = "null";
				
			}else //Empresa Nueva
			{
				data.Nombre = document.getElementById("empresa").value;//Empresa
				data.RFC = document.getElementById("RFC").value;
				data.SucursalId = "";
				data.direccion = document.getElementById("direccion").value;
				data.telefono = document.getElementById("telefono").value;
				type = "nueva";
			}	
		}
		dataString = JSON.stringify(data);
		console.log(dataString);
		$.ajax({
			type: 'POST',
			url: 'configuracion/clientes/insertCliente.php',
			data: {json: dataString, 
				type: type },
			datatype:"json",
			success: function(data)
			{
				var clienteId = data;
				console.log(data);
				getClientesConf();
				getClientesMain(clienteId);
				
			},
				error: function(xhr, desc, err) {
        		console.log(xhr);
        		console.log("Desc: " + desc + "\nErr:" + err);
        	}
		});	/*end ajax*/
	});
		
	
	$("#main").on("click", "#editarCliente", function(event){
		if ($(".hidden").is(":hidden"))
		{
			$('.show').hide();
			$('#actualizarTipo').show();
			$('.hidden').slideDown('slow');
			$(this).attr('value', 'Cancelar');
		}
		else
		{
			$('#actualizarTipo').hide();
			$('.hidden').slideUp('slow', function(){
				$('.show').fadeIn();
			});
			$(this).attr('value','Editar');
		}
	});
	
	$("#main").on("change", "#empresaCliente", function(event){
		var RFC = $('#empresaCliente option:selected').val();
		if (RFC == 0)
		{
			$("#addSucursal").html("");
		}
		else
		{
			cargarSucursal(RFC);
		}
	});
	
	$("#main").on("click", "#actualizarCliente", function(event){
		var data = new Object();
		data.UsuarioId = document.getElementById("UsuarioId").value;
		data.Cliente = document.getElementById("cliente").value;
		data.TelefonoCliente = document.getElementById("telefonoC").value;
		data.Email = document.getElementById("emailC").value;
		data.Contrasena = document.getElementById("contrasenaC").value;	
		var RFC = $('#empresaCliente option:selected').val();
		if (RFC == 0)
		{
			data.SucursalId = "null";
		}
		else
		{
			data.SucursalId = $("#sucursal option:selected").val();
		}
		
		dataString = JSON.stringify(data);
		console.log(dataString);
		
		
		$.ajax({
				type: 'POST',
				url: 'configuracion/clientes/insertCliente.php',
				data: {json: dataString,
					type:'update'},
				datatype:"json",
				success: function(data)
				{
					var clienteId = data;
					console.log(data);
					getClientesConf();
					getClientesMain(clienteId);
				},
					error: function(xhr, desc, err) {
	        		console.log(xhr);
	        		console.log("Desc: " + desc + "\nErr:" + err);
	        	}
			});	
	});
	
	
	$("#main").on("click", "#deleteCliente", function(event){
		var usuarioId = document.getElementById("UsuarioId").value;		
		var activo = $(this).val();
		console.log(activo);
		if (activo == "Desactivar Cliente")
		{
			activo = '0';
		}
		else
		{
			activo = "";
		}
			$.ajax({
				type: 'POST',
				url: 'configuracion/clientes/deleteCliente.php',
				data: {usuarioId : usuarioId,
				activo: activo},
				success: function(data)
				{
					console.log(data);
					getClientesConf();
					getClientesMain(usuarioId);				
				},
				error: function(xhr, desc, err) {
	        		console.log(xhr);
	        		console.log("Desc: " + desc + "\nErr:" + err);
	        	}
			});
		
	});
	
/*CONFIGURACION MANTENIMIENTOS*/
	$('#confMantenimientos').click(function()
	{
		getConfMantenimientos();
		$('#main').html("");
	});
	
	$("#overview").on("click", ".mantenimientoConfView", function(event){
		var contratoId = "";
		contratoId = $(this).val();
		getMantenimientosContrato(contratoId);
	});
	
	$("#main").on("click", ".editThisMant", function(event){
		var mantenimientos = $(this).parents('.mantenimientos');
		var hidden = mantenimientos.find('.hideMto');
		var show = mantenimientos.find('.showMto');
		var mantId = mantenimientos.find('#mantenimientoId').val();
		
		if (hidden.is(":hidden"))
		{
			show.fadeOut(function(){
				hidden.fadeIn();	
			});
			$(this).attr('value', 'Cancelar');
		}else
		{
			hidden.fadeOut('slow', function(){
				show.fadeIn();
			});
			$(this).attr('value','Editar');
		}

		console.log('MantenimientoId: ' + mantId);
	});
	
	$("#overview").on("click", "#agregarMantenimientoIcon", function(event){
		$.ajax({
			type: 'GET',
			url: 'configuracion/mantenimientos/agregar.php',
			success: function(data)
			{
				$('#main').html(data);
				$( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
			}
		});/*end ajax */
	});
	
	$("#main").on("click", "#agregarMantenimiento", function(event){
		var data = new Object();
		data.Nombre = document.getElementById("nombre").value;
		data.Fecha = document.getElementById("date").value;
		data.ContratoId = $("#contrato option:selected").val();			
		data.Descripcion = document.getElementById("descripcion").value;
		var dataString = JSON.stringify(data);	
		console.log("Mantenimientos:" + dataString);
		$.ajax({
			type: 'POST',
			url: 'configuracion/mantenimientos/insertMantenimientos.php',
			data: {json: dataString,
				type:'insert'},
			datatype:"json",
			success: function(data)
			{
				getConfMantenimientos();
				getMantenimientosContrato($("#contrato option:selected").val());
				console.log("success");
			},
				error: function(xhr, desc, err) {
        		console.log(xhr);
        		console.log("Desc: " + desc + "\nErr:" + err);
        	}
		});	
	});
	
	
	
	$("#main").on("click", ".actualizarMantenimiento", function(event){
		var data = new Object();
		var mantenimientos = $(this).parents('.mantenimientos');
		var mantenimientoId = mantenimientos.find('.mantenimientoId').val();
		data.MantenimientoId = mantenimientoId;
		data.Nombre = mantenimientos.find('.nombreC').val();
		data.Descripcion = mantenimientos.find('.descripcionC').val();
		data.Fecha = mantenimientos.find('.fechaC').val();
		data.ContratoId= $("#contratoId").val();
		dataString = JSON.stringify(data);
		console.log(dataString);
		$.ajax({
				type: 'POST',
				url: 'configuracion/mantenimientos/insertMantenimientos.php',
				data: {json: dataString,
					type:'update'},
				datatype:"json",
				success: function(data)
				{
					getConfMantenimientos();
					getMantenimientosContrato($("#contratoId").val());
					console.log("success");
				},
					error: function(xhr, desc, err) {
	        		console.log(xhr);
	        		console.log("Desc: " + desc + "\nErr:" + err);
	        	}
			});	
	
	});
	
	$("#main").on("click", ".deleteThisMant", function(event){
		var mantenimientos = $(this).parents('.mantenimientos');
		var mantenimientoId = mantenimientos.find('.mantenimientoId').val()
		if (confirm('¿Seguro que deseas eliminar?') == true){
			$.ajax({
				type: 'POST',
				url: 'configuracion/mantenimientos/deleteMantenimientos.php',
				data: {mantenimientoId : mantenimientoId},
				success: function(data)
				{
					console.log(data);
					getConfMantenimientos();
					if (mantenimientos.hasClass('first'))
					{
						$('#main').html("");	
					}
					else
					{
						getMantenimientosContrato($("#contratoId").val());
					}		
				},
				error: function(xhr, desc, err) {
	        		console.log(xhr);
	        		console.log("Desc: " + desc + "\nErr:" + err);
	        	}
			});
		}
	});
	

	
	
	
	
	
/*CONFIGURACION TIPOS*/
	function cargarDatosTipo(){
		var data = new Object();
		data.nombre = document.getElementById("nombre").value;
		data.descripcion = document.getElementById("descripcion").value;
		return data;
	}
	
	$("#main").on("click", "#agregarTipo", function(event){
		
		var dataString = JSON.stringify(cargarDatosTipo());	
		console.log("Tipos:" + dataString);
		$.ajax({
			type: 'POST',
			url: 'configuracion/tipos/insertTipo.php',
			data: {json: dataString,
				type:'insert'},
			datatype:"json",
			success: function(data)
			{
				tipoId = data;
				console.log(data);
				getTipo(tipoId);
				getTipos();
				console.log("success");
			},
				error: function(xhr, desc, err) {
        		console.log(xhr);
        		console.log("Desc: " + desc + "\nErr:" + err);
        	}
		});	
	});
	
	$("#tipos").click(function(){
		getTipos();
		$('#main').html("");
	});
	
	$("#overview").on("click", "#agregarTipoIcon", function(event){
		$.ajax({
			type: 'GET',
			url: 'configuracion/tipos/agregar.php',
			success: function(data)
			{
				
				$('#main').html(data);
			}
		});/*end ajax */
	});
	
	
	$("#overview").on("click", ".tiposView", function(event){
		tipoId = "";
		tipoId = $(this).val();
		getTipo(tipoId);
		console.log("TipoId :" + tipoId);
	});
	
	$("#main").on("click", "#deleteTipo", function(event){
		if (confirm("Seguro que deseas eliminar?")){
			$.ajax({
				type: 'POST',
				url: 'configuracion/tipos/deleteTipo.php',
				data: {tipoId: tipoId},
				success: function(data)
				{
					getTipos();
					$('#main').html('');
					console.log("success");
				},
					error: function(xhr, desc, err) {
	        		console.log(xhr);
	        		console.log("Desc: " + desc + "\nErr:" + err);
	        	}
			});	
		}
	});
	
	$("#main").on("click", "#editarTipo", function(event){
		if ($(".hidden").is(":hidden"))
		{
			$('.show').hide();
			$('#actualizarTipo').show();
			$('.hidden').slideDown('slow');
			$(this).attr('value', 'Cancelar');
		}
		else
		{
			$('#actualizarTipo').hide();
			$('.hidden').slideUp('slow', function(){
				$('.show').fadeIn();
			});
			$(this).attr('value','Editar');
		}
	});
	
	$("#main").on("click", "#actualizarTipo", function(event){
		var data = cargarDatosTipo();
		data.tipoId = $("#tipoId").val();
		dataString = JSON.stringify(data);
		console.log(dataString);
		$.ajax({
				type: 'POST',
				url: 'configuracion/tipos/insertTipo.php',
				data: {json: dataString,
					type:'update'},
				datatype:"json",
				success: function(data)
				{
					getTipos();
					getTipo(data);
					console.log("success");
				},
					error: function(xhr, desc, err) {
	        		console.log(xhr);
	        		console.log("Desc: " + desc + "\nErr:" + err);
	        	}
			});	
	});
/*CONFIGURACION CONTRATOS*/
	$("#contratos").click(function(){
		getContratos();
		$('#main').html("");
	});
	
	$("#overview").on("click", ".contratosView", function(event){
		var contratoUsuarioId = "";
		contratoUsuarioId = $(this).val();
		getContrato(contratoUsuarioId);
		
		console.log("contratoUsuarioId :" + contratoUsuarioId);
	});
	
	$("#main").on("click", "#agregarOdaIcon", function(event){
		if ($('.hiddenOda').is(":hidden"))
		{
			$('.hiddenOda').slideDown();
			$(this).attr('value', 'Cancelar');
		}else
		{
			$('.hiddenOda').slideUp();
			$(this).attr('value','Agregar Oda');
		}
	});
	
	$("#main").on("click", "#agregarOda", function(event){
		var data = new Object();
		data.FechaInicio = document.getElementById("inicio").value;
		data.FechaVencimiento = document.getElementById("vencimiento").value;
		data.Descripcion = document.getElementById("descripcion").value;
		data.serviceId = $("#sla option:selected").val();
		data.ContratoId = document.getElementById("contratoId").value;
		dataString = JSON.stringify(data);
		console.log(dataString);
		$.ajax({
			type: 'POST',
			url: 'configuracion/contratos/insertOda.php',
			data: {json: dataString,
				type:'insert'},
			datatype:"json",
			success: function(data)
			{
				getContrato(document.getElementById("clienteId").value);
				console.log("success");
			},
			error: function(xhr, desc, err) {
        		console.log(xhr);
        		console.log("Desc: " + desc + "\nErr:" + err);
        	}
		});	

	});
	
	$("#main").on("click", "#histContratos", function(event){
			var contratoUsuarioId = "";
			contratoUsuarioId = document.getElementById("clienteId").value;
			console.log("historial Contratos: " + contratoUsuarioId);
			$.ajax({
				type: 'GET',
				url: 'configuracion/contratos/historial.php',
				data: {contratoUsuarioId: contratoUsuarioId},
				success: function(data)
				{
					$('#main').html(data);
				}
			})

	});
	
	$("#main").on("click", ".contratos", function(event){
		var contratoId = $(this).find('#contratoId').val();
		console.log("ContratoId: " + contratoId );
		$.ajax({
				type: 'GET',
				url: 'configuracion/contratos/historialMain.php',
				data: {contratoId: contratoId},
				success: function(data)
				{
					$('#main').html(data);
				}
			});
	});
	
	$("#main").on("click", "#regresarContratoActual", function(event){
		contratoUsuarioId = document.getElementById('usuarioId').value;
		getContrato(contratoUsuarioId);
	});
	
	$("#main").on("click", "#cancelarContrato", function(event){
		var data = new Object();
		var contratoUsuarioId = document.getElementById("clienteId").value;
		data.ContratoCode = $(".contratoCode").text();
		data.Status = "Contrato Cancelado";
		data.UsuarioId = contratoUsuarioId;
		data.Tipo = "agregar";
		data.ContratoId = document.getElementById("contratoId").value;
		dataString = JSON.stringify(data)
		
		$.ajax({
			type: 'POST',
			url: 'configuracion/contratos/insertContrato.php',
			data: {json: dataString,
				type:'cancel'},
			datatype:"json",
			success: function(data)
			{
				getContrato(contratoUsuarioId);
			},
			error: function(xhr, desc, err) {
	    		console.log(xhr);
	    		console.log("Desc: " + desc + "\nErr:" + err);
	    	}
		});	
		
	});
	
	$("#main").on("click", "#editarContrato", function(event){
		if ($(".hidden").is(":hidden"))
		{
			$('.show').hide();
			$('.hidden').slideDown('slow');
			$('#cancelarContrato').hide();
			$(this).attr('value', 'Cancelar');
		}
		else
		{
			$('.hidden').slideUp('slow', function(){
				$('.show').fadeIn();
			});
			$('#cancelarContrato').show();
			$(this).attr('value','Renovar Contrato');
		}
		
	});
	
	$("#main").on("click", "#agregarContrato", function(event){
		contratoCodeAnterior = $('.contratoCode').text();
		contratoCode = document.getElementById("contratoCode").value;
		
		if (contratoCodeAnterior != contratoCode){
			var data = new Object();
			var contratoUsuarioId = document.getElementById("clienteId").value;
			data.ContratoCode = contratoCode;
			data.Status = "Renovación";
			data.UsuarioId = contratoUsuarioId;
			data.Tipo = "agregar"; //si es agregar a algo a un contrato que ya existe o si es nuevo
			data.ContratoId = document.getElementById("contratoId").value;//si es agregar tienes que tener ContratoId para actualizarle a todos los usuarios
			dataString = JSON.stringify(data)
			
			var dataOda = new Object();
			dataOda.FechaInicio = document.getElementById("inicioAg").value;
			dataOda.FechaVencimiento = document.getElementById("vencimientoAg").value;
			dataOda.Descripcion = document.getElementById("descripcionAg").value;
			dataOda.serviceId = $("#slaAg option:selected").val();
			dataStringOda = JSON.stringify(dataOda);
			
			
			$.ajax({
				type: 'POST',
				url: 'configuracion/contratos/insertContrato.php',
				data: {json: dataString,
					oda: dataStringOda,
					type:'insert'},
				datatype:"json",
				success: function(data)
				{
					getContrato(contratoUsuarioId);
				},
				error: function(xhr, desc, err) {
		    		console.log(xhr);
		    		console.log("Desc: " + desc + "\nErr:" + err);
		    	}
			});	
		}/*end if*/	
		else
		{
			alert("El número de contrato no puede ser igual.");
		}
	});
	
	
	
/*CONFIGURACION USUARIOS*/	
	$("#confUsuarios").click(function(){
		getUsuarios();
		$('#main').html("");
	});
	
	$("#overview").on("click", "#agregarUsuarioIcon", function(event){
		$.ajax({
			type: 'GET',
			url: 'configuracion/usuarios/agregar.php',
			success: function(data)
			{
				$('#main').html(data);
			}
		});/*end ajax */
	});
	
	$("#overview").on("click", ".usuariosView", function(event){
		usuarioId = "";
		usuarioId = $(this).val();
		getUsuario(usuarioId);
		console.log("UsuarioId :" + usuarioId);
	});
	
	$("#main").on("click", "#agregarUsuario", function(event){
		var data = new Object();
			//data.usuarioId = usuarioId;
			data.NombreUsuario = document.getElementById("nombre").value;
			data.PermisosId =  $("#permisosId option:selected").val();
			console.log(data.PermisosId);
			data.Email = document.getElementById("email").value;
			data.Contrasena = document.getElementById("contrasena").value;
			dataString = JSON.stringify(data);
		
			$.ajax({
				type: 'POST',
				url: 'configuracion/usuarios/insertarUsuario.php',
				data: {json: dataString,
					type:'insert'},
				datatype:"json",
				success: function(data)
				{
					console.log("success");
					usuarioId = data;
					getUsuario(usuarioId);
					getUsuarios();
					
				},
					error: function(xhr, desc, err) {
	        		console.log(xhr);
	        		console.log("Desc: " + desc + "\nErr:" + err);
	        	}
			});	
	});
	
	$("#main").on("click", "#editarUsuario", function(event){
		if ($(".hidden").is(":hidden"))
		{
			$('.show').hide();
			$('#actualizarUsuario').show();
			$('.hidden').slideDown('slow');
			$(this).attr('value', 'Cancelar');
		}
		else
		{
			$('#actualizarUsuario').hide();
			$('.hidden').slideUp('slow', function(){
				$('.show').fadeIn();
			});
			$(this).attr('value','Editar');
		}
	});
	
	$("#main").on("click", "#actualizarUsuario", function(event){
		
		var data = new Object();
		data.UsuarioId =  $("#usuarioId").val();
		data.NombreUsuario = document.getElementById("nombre").value;
		data.Email = document.getElementById("email").value;
		data.PermisosId = $("#permisosId option:selected").val();
		data.Contrasena = document.getElementById("contrasena").value;
		
		dataString = JSON.stringify(data);
		console.log(dataString);
		$.ajax({
				type: 'POST',
				url: 'configuracion/usuarios/insertarUsuario.php',
				data: {json: dataString,
					type:'update'},
				datatype:"json",
				success: function(data)
				{
					getUsuarios();
					getUsuario(data);
					console.log("success");
				},
				
					error: function(xhr, desc, err) {
	        		console.log(xhr);
	        		console.log("Desc: " + desc + "\nErr:" + err);
	        	}
			});	
	});
	
	$("#main").on("click", "#deleteUsuario", function(event){
		var usuarioId = $("#usuarioId").val();		
		var activo = $(this).val();
		console.log(activo);
		if (activo == "Desactivar Usuario")
		{
			activo = '0';
		}
		else
		{
			activo = "";
		}
			$.ajax({
				type: 'POST',
				url: 'configuracion/usuarios/deleteUsuario.php',
				data: {usuarioId : usuarioId,
				activo: activo},
				success: function(data)
				{
					console.log(data);
					getUsuarios();
					getUsuario(usuarioId);				
				},
				error: function(xhr, desc, err) {
	        		console.log(xhr);
	        		console.log("Desc: " + desc + "\nErr:" + err);
	        	}
			});
		
	});
	
	/*Metodo de autocomplete para los Empleados*/
	function autoCompleteEmpleado()
	{
		empleadoId = "";
		$( "#empleado" ).autocomplete({
			source: "includes/autocomplete/empleados.php",
			minLength: 1,
			select: function( event, ui ) {
				if (ui.item){
					empleado = ui.item.value;
					empleadoId = ui.item.id;
					console.log(empleadoId);
				}
			}
		});/*end autocomplete empleados*/
	}
	
	/*autocomplete de empresas, si se selecciona una que no existe se muestra la forma para insertar la empresa,
	si va vacía no se muestra nada y se toma como nulo*/
	function autoCompleteEmpresas()
	{
		empresaId = "";
		$( "#empresa" ).autocomplete({
			source: "includes/autocomplete/empresas.php",
			minLength: 1,
			select: function( event, ui ) {
					empresaId = ui.item.id;
					
					console.log("EmpresaId:" + empresaId);
					cargarSucursal(empresaId);
					cargarContratoCode(empresaId)
					$('.addContrato').hide();
			}, 
			change: function(event, ui)
			{
				$(".addEmpresa").slideUp('slow');
				$(".agTicket .warning").fadeOut('slow');
				if (!ui.item)
				{	
					empresaId = "";
					$("#empresa").focus();
					//console.log("Entra a nulo ui.item: " + ui.item);
					$("#addSucursal").html("");
					$('#numContrato').html('<input type="text" placeholder="Número Contrato" id="contratoCode"/>');
					$('.addContrato').show();
					if ( $("#empresa").val() != ""){
						$(".agTicket .warning").fadeIn();
						$(".addEmpresa").slideDown('200', function(){
							$("#RFC").focus();
						});
						//
					}
					//$('.addContrato').slideDown();
				}
				
			}
		});/*end autocomplete empresas*/
	}
	
	

	/*RELOADS*/
	$("#overview").on("click", "#reloadMisTickets", function(event){
		misTickets();
	});
	
	$("#overview").on("click", "#reloadSinAsignar", function(event){
		var type = 'Sin Asignar';
		getTickets(type);
	});
	
	$("#overview").on("click", "#reloadTodos", function(event){
		var type = 'Todos';
		getTickets(type);
	});
	
	

	
	
	
});//end Function document


