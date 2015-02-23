/*
CURRENCY PAGE FUNCTIONS
 */
// we get the rates from the selected values and we do the conversion
$.getJSON("public/ajax/dispatcher.php", {Function: 'getRates'}, function (data) {
    $(document).on('click', '.convert', function (e) {
      //  e.preventDefault();
        var _value = $('.input1').val();
        var select1 = $('#currency_from').find('option:selected').val() - 1;
        var select2 = $('#currency_to').find('option:selected').val() - 1;

       // console.log(data.rates[ select1 ].value);
        //console.log(data.rates[ select2 ].value);

        var final = _value * (data.rates[ select1 ].value / data.rates[ select2 ].value);
       // console.log(final);

        $('.input2').val(final);
     
    });
});
/*
// we dont allow the users to press character symbols only numbers, "," "." "backspace" and arrows
$(document).on('keydown', '.input1', function (e) {
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
})
*/
// we press the hidden button Convert 
$(document).on('keyup', '.input1', function (e) {
   // e.preventDefault();
    $('.convert').trigger('click')
})


/*
DASHBOARD PAGE FUNCTIONS
 */


// this function calls dispatcher to update the "value" on the record from currencies table 
$(document).on('click', '.upd_currency', function () {
    var _tr = $(this).closest('tr');
    var _val = jQuery('input.newValue', _tr).val();
    var _id = $(_tr).attr('data-id');
    $.post('public/ajax/dispatcher.php', {id: _id, value: _val, Function: 'UpdateCurrencies'}, function (data, success) {
        if (success == 'success') {
            if (data.status == 'ok')
            {
                $.gritter.add({
                    title: '',
                    text: '<center><font color="orange">Value Updated</font></center>',
                    sticky: false,
                    time: '2000'
                });
            }
            //display_message(data.title,data.text);
        }
    }, 'json')
})

// this function calls dispatcher to delete the record from currencies table
$(document).on('click', '.dlt_currency', function () {
    var _tr = $(this).closest('tr');
    var _id = $(_tr).attr('data-id');
    $.post('public/ajax/dispatcher.php', {id: _id, Function: 'DeleteCurrency'}, function (data, success) {
        if (success == 'success') {
            if (data.status == 'ok')
            {  
                $(_tr).fadeOut(1000);
                $.gritter.add({
                    title: '',
                    text: '<center><font color="red">Record Deleted</font></center>',
                    sticky: false,
                    time: '2000'
                });
            }
            //display_message(data.title,data.text);
        }
    }, 'json')
})

// with this function we get at first all shortnames stored in database
// then we get json from google rate api for every shortname witch has the rates to dollar
// then we show the values to the html
$(document).on('click', '.koumpi', function () {
    $('.shortname').each(function (i, e) {
        $.ajax({
            type: "GET",
            dataType: "jsonp",
            url: "http://rate-exchange.appspot.com/currency?from=" + e.innerHTML + "&to=USD",
            success: function (data) {
                $('.newValue', '.table.table-striped tr:eq(' + (i + 1) + ')').val(data.rate);
                // console.log(data.from +' : '+ data.rate);
            },
        });
    })
})

// we check if user gives an existing name when he adds a new record
$(document).on('keyup', '#addname', function () {
//$("#username").keyup(function (e) { //user types username on inputfiled
    var _Item = $(this);
    var thisname = $(this).val(); //get the string typed by user
    var SerializedData = 'Function=CheckCurrencyName&Name=' + thisname;
    $.post('public/ajax/dispatcher.php', SerializedData, function (data, success) {
        if (success == 'success') {
            if (data.Counter == 1)
            {
                $("#name-result").html(data.text); //dump the data received from PHP page
                $(_Item).addClass('parsley-error');
            }
            else if (data.Counter == 0)
            {
                $("#name-result").html('');
                $(_Item).removeClass('parsley-error');
                $(_Item).addClass('parsley-success');
            }

        }
    }, 'json')
})

// we check if user gives an existing shortname when he adds a new record
$(document).on('keyup', '#addshortname', function () {
    var _Item = $(this);
    var thisshortname = $(this).val(); //get the string typed by user
    var SerializedData = 'Function=CheckCurrencyShortName&ShortName=' + thisshortname;
    $.post('public/ajax/dispatcher.php', SerializedData, function (data, success) {
        if (success == 'success') {
            if (data.Counter == 1)
            {
                $("#shortname-result").html(data.text); //dump the data received from PHP page
                $(_Item).addClass('parsley-error');
            }
            else if (data.Counter == 0)
            {
                $("#shortname-result").html('');
                $(_Item).removeClass('parsley-error');
                $(_Item).addClass('parsley-success');
            }

        }
    }, 'json')
})

// function calls ajax to insert the new Currency data
$(document).on('submit', '.addForm', function () {
    event.preventDefault();
    var _form = $('.addform');
    var _name = jQuery('#addname').val();
    var _value = jQuery('#addvalue').val();
    var _shortname = jQuery('#addshortname').val();
    var _symbol = jQuery('#addsymbol').val();
    $.post('public/ajax/dispatcher.php', {name: _name, value: _value, shortname: _shortname, symbol:_symbol,Function: 'addCurrency'}, function (data, success) {
        if (success == 'success') {
            if (data.status == 'ok')
            {
                $.gritter.add({
                    title: '',
                    text: '<center><font color="orange">Currency succesfully Inserted</font></center>',
                    sticky: false,
                    time: '2000'  
                });
                 $('#addModal').modal('toggle');
                 location.reload();
            }
        }
    }, 'json')
});