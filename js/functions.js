$(document).ready(function(){
	//default settings
	$('#courseslist').hide();
	//$('#submittedtasks').hide();
	$('.submittedtaskslist').hide();
	
	/*LEFT SIDEBAR*/
	$('#courseslink').click(function(e) {
		e.preventDefault();
		$('#courseslist').slideToggle('fast');
	});
	
	/*COURSE*/
	$('.submittedtaskslink').click(function(e) {
		e.preventDefault();
		$('#submittedtaskslist' + this.id).toggle();
	});
	
	/*ACCOUNT*/


	$('#accemail').focusout(function(e) {
		var error = validateEmail(this);
		if (error)
			$('#emailerror').html(error);
		else
			$('#emailerror').html("");
	});
	
	$('#accphone').focusout(function(e) {
		var error = validatePhone(this);
		if (error)
			$('#phoneerror').html(error);
		else
			$('#phoneerror').html("");
	});
	
	validateEmail = function(inputid) {
		var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		var email = $(inputid).val();
		if (email) {
			if (!pattern.test(email))
				return "E-mail ni v pravilni obliki";
		}		
		//2nd example
		/*
		$('#accemail:text').filter(function() {
			if (!this.value.match(pattern))
				alert('ba');
		});
		*/
	}
	
	validatePhone = function(inputid) {
		var pattern = /^\d{3}\d{3}\d{3}$/;
		///^\d{3} ?\d{3} ?\d{3}$/;
		///^0[3-5]\d{1}\d{3}\d{3}$/;
		var phone = $(inputid).val();
		if (phone) {
			if (!pattern.test(phone))
				return "Telefonska številka ni v pravilni obliki";
		}
	}

    

    var events = {};
    //Calendar
    $.getJSON("_JSONResponse.php?calendar=1", {}, function(data) {
            //var events = {};
            //alert(data);
            for (datum in data) {
                
                //datum je oblike 30.11.2011
                var d = datum.split(".");
                var mojD = d[1]+"/"+d[0]+"/"+d[2];
                events[new Date(mojD)] = data[datum];
            }
             $("#datepicker1").datepicker({
                 beforeShowDay: function(date) {
                    var event = events[date];
                    if (event) {
                        return [true, 'dateRed', ''];
                    }
                    else {
                        return [true, '', ''];
                    }
                }

             });

            $('.dateRed').each(function(index) {
                var mesec = {"January":"01","February":"02","March":"03","April":"04",
                            "May":"05","June":"06","July":"07","August":"08","September":"09",
                            "October":"10","November":"11","December":"12"};
                var d2 = mesec[$('.ui-datepicker-month').text()] + "/" +$(this).text()+"/"+$('.ui-datepicker-year').text();
                d2 = new Date(d2);
                if (d2 in events) {
                    //$(this).attr("onmouseover","return overlib('<a href=\\'http://www.bosrup.com/web/overlib/\\'>Popups by overLIB</a>', STICKY, MOUSEOFF, WRAP, CELLPAD, 5);");
                    var popupHtml = events[d2];
                    $(this).attr("onmouseover","return overlib('"+popupHtml+"', STICKY, MOUSEOFF, WRAP, CELLPAD, 5);");
                    $(this).attr("onmouseout","return nd(300);");
                }
            });
        }
    );

    //set interval za calendar

    setInterval(function() {
        $('.dateRed').each(function(index) {
                var mesec = {"January":"01","February":"02","March":"03","April":"04",
                            "May":"05","June":"06","July":"07","August":"08","September":"09",
                            "October":"10","November":"11","December":"12"};
                var d2 = mesec[$('.ui-datepicker-month').text()] + "/" +$(this).text()+"/"+$('.ui-datepicker-year').text();
                d2 = new Date(d2);
                if (d2 in events) {
                    //$(this).attr("onmouseover","return overlib('<a href=\\'http://www.bosrup.com/web/overlib/\\'>Popups by overLIB</a>', STICKY, MOUSEOFF, WRAP, CELLPAD, 5);");
                    var popupHtml = events[d2];
                    $(this).attr("onmouseover","return overlib('"+popupHtml+"', STICKY, MOUSEOFF, WRAP, CELLPAD, 5);");
                    $(this).attr("onmouseout","return nd(300);");
                }
            });
    }, 400);

    $("#datepickerRokOddaje").datepicker({minDate: new Date(), dateFormat: 'dd.mm.yy'});
    
});

function updateOcenoNaloge(nalogaId, oddanaNalogaId, courseId) {

    var novaOcena = $("#novaOcenaInput_"+oddanaNalogaId).val();
    //alert(novaOcena);

    //izvedi json klic
    $.getJSON("_JSONResponse.php?updateOcenoNaloge=1&nalogaId="+String(nalogaId)+"&oddanaNalogaId="+String(oddanaNalogaId)+"&novaOcena="+novaOcena+"&predmetId="+courseId, {

        }, function(data) {
        //alert("LALA");
        //v div-u z id-jem 'novaOcena_$nalogaId' nastavi vrednost na data.outputHtml
        //alert("h:"+data.outputHtml);
        
        $("#novaOcena_"+String(oddanaNalogaId)).html(data['outputHtml']);
    });
}

function dodajPovezavo() {
    $("#stPovezav").val(Number($("#stPovezav").val())+1);
    var idxPovezave = $("#stPovezav").val();
    $("#povezaveGradiv").append("<div id='pov"+idxPovezave+"'><p><label>Besedilo</label><input type='text' name='povezava"+idxPovezave+"_besedilo' /></p>" +
                                "<p><label>Url</label><input type='text' name='povezava"+idxPovezave+"_url' /></p></div>");
    
}

function odstraniPovezavo() {
    var idxPovezave = $("#stPovezav").val();
    if (idxPovezave == 0) return;
    $("#pov"+idxPovezave).remove();
    $("#stPovezav").val(Number($("#stPovezav").val())-1);

}
function validateRegister() {
        if(!checkName($("#accname").val())) return false;
        if(!checkLastName($("#accsurname").val())) return false;
        if(!checkUsername($("#accusername").val())) return false;
        if(!checkPassword($("#accpassword").val())) return false;
        if($('#emailerror').html() != "") return false;
        return true;
}

function checkName(value) {
var expr=/^[a-zA-Z]+$/
  if (value.search(expr)==-1) //if match failed
  {
    alert("Napacen vnos imena!");
    return false;
  }
  return true;
}

function checkLastName(value) {
var expr=/^[a-zA-Z]+$/
  if (value.search(expr)==-1) //if match failed
  {
    alert("Napacen vnos priimka!");
    return false;
  }
  return true;
}

function checkUsername(value) {
var expr=/^[a-zA-Z]+$/
  if (value.search(expr)==-1) //if match failed
  {
    alert("Napacen vnos uporabniškega imena!");
    return false;
  }
  return true;
}

function checkPassword(value) {
var expr=/^[a-zA-Z0-9]+$/
  if (value.search(expr)==-1) //if match failed
  {
    alert("Napacen vnos gesla!");
    return false;
  }
  return true;
}
