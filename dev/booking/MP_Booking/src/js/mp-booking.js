//Var used for form

var mailRegex=/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i
var states = new Array("Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burma", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo, Democratic Republic", "Congo, Republic of the", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Greenland", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, North", "Korea, South", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Mongolia", "Morocco", "Monaco", "Mozambique", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Norway", "Oman", "Pakistan", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Samoa", "San Marino", " Sao Tome", "Saudi Arabia", "Senegal", "Serbia and Montenegro", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe");
var fieldNeeded=new Array("first_name","name","email","country","date_checkin","date_chekout");

jQuery(document).ready(function($) {

//check fields are not empty and correct
function checkField(field){
  if(jQuery.inArray( field.name, fieldNeeded )>=0){
      if(!checkNotEmpty(field.name, field.value))return false;
  }
  if(field.name=="email"){
    if(!checkRegexp(field.name, field.value, mailRegex))return false;
  }
  return true;
}

//check reg ex pattern
function checkRegexp( name, value, regexp) {
  if ( !( regexp.test( value ) ) ) {
       var label=$("label[for="+name+"]").html();
       updateTips(label + " is incorrect. ");
       return false;
  }
  return true;
}

//check value is not empty
function checkNotEmpty( name, value) {
  if ( value.length < 1 ) {
    var label=$("label[for="+name+"]").html();
    updateTips(label + " is requierd. ");
    return false;
  }
  return true;
}

//update error message
function updateTips( t ) {
			$(".error_form").text(t);
}

//date picker on each component id start by mpb_date
$('input[id*="mpb_date"]').datepicker({minDate: 0});

//feel state select
$.each(states, function(val, text) {
  $('#country').append( $('<option></option>').val(text).html(text) )
});

//destroy previous dialog
$( "#dialog:ui-dialog" ).dialog( "destroy" );

//step (next back button) in form
var step=1;

var tableDetail;

function sendDetail(step1,step2){
        //disable button for wait answer
        $('#continue-button').attr('disabled', true);
        $('#back-button').attr('disabled', true);
        //balue sended by the request
        var values = {'action': 'mp_booking', 'bookcontent' : tableDetail};
        $.each($('#booking-form').serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        //ajax request
        $.ajax({
        url:ajaxurl,
        type: "POST", 
        data: values,
        success: function(data) { //answer
          var answer=jQuery.parseJSON(data);
          if(answer.captcha=="ok"){
            $('#continue-button').html('<span class="ui-button-text">Ok</span>');
            $('#back-button').hide();
            //next div
            $('#step'+step1).slideUp();
            step=step2;
            $('#step'+step2).slideDown();
          }
          else{
            if(mp_no_captcha){
              updateTips("Server error appends try later");
            }
            else{
              updateTips("Please complete captcha");
              $('#captcha').val('');
            }
          }
          //change the captcha picure
          $('#mp_booking_captcha').attr("src",answer.captcha_img_src);
          //enable buttons
          $('#continue-button').attr('disabled', false);
          $('#back-button').attr('disabled', false);
         }  
        });
}

//modal dialog contain the booking form
$( "#dialog-form" ).dialog({
  autoOpen: false,
  height: 500,
  width: 700,
  modal: true,
  buttons: {
    "Continue": function() {    
      $(".error_form").empty();
      //end
      if(step==4){
         $( this ).dialog( "close" );
         return;
      }
      //form -> step 3 : send information to server, wait ajax answer
      if(step==3){
        sendDetail(3,4);
      }
      //when client had verified his information
      if(step==2){
        if(mp_no_captcha){
          sendDetail(2,4);
        }
        else{
          //next div
          $('#step'+step).slideUp();
          step++;
          $('#step'+step).slideDown();
        }
      }
      //verify field and fell next div 
      if(step==1){
        tableDetail="<table>";
        var next=true;
        $.each($('#booking-form').serializeArray(), function(i, field) {
            if(!checkField(field)){
                next=false;
                return next;
            }
            if(field.name==='captcha'||field.name==='mp_from'||field.name==='mp_send_to') return true;
            
            var label=$("label[for="+field.name+"]").html();
            tableDetail+="<tr><td>"+label+" : </td><td>"+field.value+"</td></tr>";
        });
        if(!next)return;
        tableDetail+="</table>";
        $('#mpb_information').html(tableDetail);
        $('#step'+step).slideUp();
        step++;
        $('#step'+step).slideDown();
        $('#continue-button').attr('disabled', false);
        $('#back-button').attr('disabled', false);
      }
    },
    "Back": function() {//on click back
      //close if first pane
      if(step==1){
        $( this ).dialog( "close" );
        return;
      }
      //form previous step
      $('#step'+step).slideUp();
      step--;
      $('#step'+step).slideDown();
      
    }
  },
  close: function() {
  }
});

//add specific id on dialog buttons
$('.ui-dialog-buttonpane button:contains(Continue)').attr("id","continue-button");
$('.ui-dialog-buttonpane button:contains(Back)').attr("id","back-button");

//on a book button click
$( 'button[id*="mpb_book_button"]')
  .button()
  .click(function() {
      //---  reinit
      $(".error_form").empty();
      step=1;
      $('#step1').show();
      $('#step2').hide();
      $('#step3').hide();
      $('#step4').hide();
      $('#continue-button').html('<span class="ui-button-text">Continue</span>');
      $('#back-button').html('<span class="ui-button-text">Back</span>');
      $('#back-button').show();
      $('#guest').empty();//empty a previous nb guest select box
      $('#continue-button').attr('disabled', false);
      $('#back-button').attr('disabled', false);
      //---  specific attribute configuration
      var object=$(this).attr("object");
      $('#mp_booking_object').val(object);
      var mp_mail_to=$(this).attr("sendTo");
      $('#mp_send_to').val(mp_mail_to);
      var mp_from=$(this).attr("from");
      $('#mp_from').val(mp_from);
      mp_no_captcha=false;
      mp_no_captcha=$(this).attr("captcha")=="no";
      
      $("dialog-form").attr("title",object);
      var nbguest=$(this).attr("nummax");//feel the nb guest select box until the max num
      for(var i=1;i<=nbguest;i++){
        $('#guest').append( $('<option></option>').val(i).html(i));
      }
      //
      $("#dialog-form" ).dialog('option', 'title', 'Book - '+object);
      $("#dialog-form" ).dialog("open");
});

});