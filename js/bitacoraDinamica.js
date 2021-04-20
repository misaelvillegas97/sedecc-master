	$(document).on('click', '#btnGrabar', function (event) {
	    var grabar=true;
	    $('.inputs:visible').each(function() {
	          
            if(jQuery.trim ($(this).val()) == ''){
                $(this).css('border','solid 1px red');
                console.log('dentro');
                grabar=false;
            }
        });
        if(grabar){
            var inputs = $('.inputs').serialize();
            var operacion=ajaxCall(inputs,$('#formulario').attr('action'));
            if(operacion > 0 || operacion == true){
                window.location.replace("index.php?r=site/page&view=bitacora2");
            }
        }
		
	});
	
	/*$('#time').change(function () {
	    //$('#spanOptions').show();
	    $("#spanOptions").css("display", "block");
	});*/
	
	$(document).on('click', '.btnEliminar', function (event) {
	     swal({
  title: 'Estás seguro?',
  text: "Esto no podrá ser revertido!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Sí, Borrar!',
  cancelButtonText: 'Cancelar!'
}).then((result) => {
  if (result.value) {
      if(ajaxCall({'idBitacora':$(this).attr('id')},'bitacoraDinamicaEliminar.php')){
          
            window.location.replace("index.php?r=site/page&view=bitacora2&tipo="+$('#time').val()+" ");
      }else{
          swal(
              'OOPS!',
              'La bitácora no pudo ser borrada.',
              'error'
            );
      }
    
    //var operacion=ajaxCall({'idBitacora':$(this).attr('id')},'bitacoraDinamicaEliminar.php');
  }else{
  }
}).catch(swal.noop)
        
        
        
    });

	function ajaxCall(data, url) {
        var returnData;
        $.ajax({
            //beforeSend: function () { $('#loader').show(); },
            //complete: function () { $('#loader').hide(); },
            type: "POST",
            url: url,
            data: data,
            async: false,
            dataType: 'json',
            success: function (res) {
                //var data = JSON.parse(res.d);
                console.log(res);
                returnData = res;
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                errorFunction(jqXHR, textStatus, errorThrown);

            }

        });
        return returnData;
    }

    function errorFunction(jqXHR, textStatus, errorThrown) {
		if (jqXHR.status === 0) {

		    alert('Not connect: Verify Network.');

		} else if (jqXHR.status == 404) {

		    alert('Requested page not found [404]');

		} else if (jqXHR.status == 500) {
		    console.log(jqXHR);
		    console.log(textStatus);
		    console.log(errorThrown);

		    alert('Internal Server Error [500].');

		} else if (textStatus === 'parsererror') {

		    alert('Requested JSON parse failed.');
		    console.log(errorThrown);
		    console.log(textStatus);
		    console.log(jqXHR);

		} else if (textStatus === 'timeout') {

		    alert('Time out error.');

		} else if (textStatus === 'abort') {

		    alert('Ajax request aborted.');

		} else {

		    alert('Uncaught Error: ' + jqXHR.responseText);

		}
	}