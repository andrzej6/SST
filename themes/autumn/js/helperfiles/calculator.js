$( document ).ready(function() {  $( "#dnumber").change(function() {  if($("#dnumber").is(':checked'))      {      	       $("#prodmultid").prop('disabled', false);       $("#prodmultid").val('20');      }   else {          $("#prodmultid").prop('disabled', true);          $("#prodmultid").val('0');}  }); $("#calc-payback").css({'opacity':'0.5'});if (isPositiveInteger(myfield) && (myfield <=2000)&& (myfield >0))  {    myfield1 = Math.round(myfield/10)*10;   $( "input[name='costexp']" ).val(myfield1);}$('form').submit(function(event){  event.preventDefault();});    $( "#calculate" ).click(function(event) {        workdays = parseInt($( "input[name='workdays']" ).val());   compcount = parseInt($( "input[name='compcount']" ).val());   workhours = parseInt($( "input[name='workhours']" ).val());   compens = parseInt($( "input[name='compens']" ).val());   productivity = parseInt($( "input[name='productivity']" ).val());   productivityd = parseInt($( "input[name='productivityd']" ).val());   costexp = parseInt($( "input[name='costexp']" ).val());      if ( isPositiveInteger(workdays) && isPositiveInteger(compcount) && isPositiveInteger(workhours) && isPositiveInteger(compens) &&         isPositiveInteger(productivity) && isPositiveInteger(productivityd) && isPositiveInteger(costexp))       {            // around how many working days gain for individual       indivdays = (workdays*( productivity + productivityd))/100;              // around how many working days gain for company       companydays = indivdays * compcount;       //compcurr1 = (compcount*compens*(Math.floor(indivdays)))/workdays;       company_gain = (compcount*compens*indivdays)/workdays;              //compcurr = (Math.ceil(compcurr1/10000))*10000;       company_gain_rounded = (Math.round(company_gain/1000))*1000;       compcurr2 = addCommas(company_gain_rounded);              totcost = costexp*compcount;       totcost1 = addCommas(totcost);              //totgain = Math.round(compcurr1 - totcost);       totgain = company_gain_rounded - totcost;       totgain1 = addCommas(totgain);              if (totgain <= totcost)       {       	 alert('In this scenario total cost of equipment: £'+totcost1+'\nis greater than (or equals to) a total gain: £'+totgain1+'.\n Please try again.');          clear_bottom_fields();         $("#calc-payback").css({'opacity':'0.5'});	        }       else       {             // it was too agressive: paybackt = Math.floor((costexp*compcount*workdays)/totgain);       paybackt = Math.round((costexp*compcount*workdays)/totgain);                $( "input[name='indivdays']" ).val(Math.floor(indivdays));       $( "input[name='compdays']" ).val(Math.floor(companydays));       $( "input[name='compcurr']" ).val(compcurr2);       $( "input[name='totcost']" ).val(totcost1);       $( "input[name='totgain']" ).val(totgain1);        $( "input[name='paybackt']" ).val(paybackt);           $("#calc-payback").css({'opacity':'1'});      }     }            });    $("#cur-link1").click(function(e) {       e.preventDefault();       curr = $("[name='our-currency']");               compens = parseInt($( "input[name='compens']" ).val());       costexp = parseInt($( "input[name='costexp']" ).val());              if (!isPositiveInteger(compens) || !isPositiveInteger(costexp))       alert ('Insert only positive integers in currency fields, please');       else               {       $("#calc-payback").css({'opacity':'0.5'});       if (curr.val() == 'pounds')         {                      $("#cur-link1").html('<a href="#">Convert to &pound;</a>');           curr.val('euros');                       $('.pcur').each(function(){            $(this).html('&euro;');                });                                 compens1 = (Math.round(compens*1.26/1000))*1000;           costexp1 = (Math.round(costexp*1.26/10))*10;           $( "input[name='compens']" ).val(compens1);            $( "input[name='costexp']" ).val(costexp1);              clear_bottom_fields();                                                   }        else          {                      $("#cur-link1").html('<a href="#">Convert to &euro;</a>');           curr.val('pounds');                      $('.pcur').each(function(){            $(this).html('&pound;');                });                                 compens1 = (Math.round(compens*0.79/1000))*1000;           costexp1 = (Math.round(costexp*0.79/10))*10;           $( "input[name='compens']" ).val(compens1);            $( "input[name='costexp']" ).val(costexp1);            clear_bottom_fields();                     }                   }                        return false;});        $( "#reset-calc" ).click(function(event) {      $( "input[name='workdays']" ).val('225');    $( "input[name='compcount']" ).val('1');    $( "input[name='workhours']" ).val('8');    $( "input[name='compens']" ).val('25000');    $( "input[name='productivity']" ).val('12');    $( "input[name='productivityd']" ).val('0');    $("#dnumber").prop('checked',false);     $( "input[name='costexp']" ).val('400');                $('.pcur').each(function(){            $(this).html('&pound;');                });       clear_bottom_fields();   $("#calc-payback").css({'opacity':'0.5'}); });      $( ".prodex a" ).click(function(e) {   e.preventDefault();  $( "#prodexplaind" ).css( {'display':'none'});  $( "#costexplain" ).css( {'display':'none'});  $( "#prodexplain" ).slideToggle( "slow" );  return false;});$( ".prodexd a" ).click(function(e) {  e.preventDefault();  $( "#prodexplain" ).css( {'display':'none'});  $( "#costexplain" ).css( {'display':'none'});  $( "#prodexplaind" ).slideToggle( "slow" );  return false;  });$( ".costexp a" ).click(function(e) {  e.preventDefault();  $( "#prodexplain" ).css( {'display':'none'});  $( "#prodexplaind" ).css( {'display':'none'});  $( "#costexplain" ).slideToggle( "slow" );  return false;});$( "#prodexplain a.closebox" ).click(function(e) {  e.preventDefault();  $( "#prodexplain" ).css( {'display':'none'});  return false;});$( "#prodexplaind a.closebox" ).click(function(e) {  e.preventDefault();  $( "#prodexplaind" ).css( {'display':'none'});  return false; });$( "#costexplain a.closebox" ).click(function(e) {  e.preventDefault();  $( "#costexplain" ).css( {'display':'none'});  return false;});function isPositiveInteger(s){    var i = +s; // convert to a number    if (i < 0) return false; // make sure it's positive    if (i != ~~i) return false; // make sure there's no decimal part    return true;}});    function clear_bottom_fields() {           $( "input[name='indivdays']" ).val('');           $( "input[name='compdays']" ).val('');           $( "input[name='compcurr']" ).val('');           $( "input[name='totcost']" ).val('');           $( "input[name='totgain']" ).val('');            $( "input[name='paybackt']" ).val('');   }   function addCommas(nStr){	nStr += '';	x = nStr.split('.');	x1 = x[0];	x2 = x.length > 1 ? '.' + x[1] : '';	var rgx = /(\d+)(\d{3})/;	while (rgx.test(x1)) {		x1 = x1.replace(rgx, '$1' + ',' + '$2');	}	return x1 + x2;}   