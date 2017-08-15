/*
 * Main JS
 * Theme Name   : Persona
 * Author       : MD. Abu Ahsan Basir
 * Description  : Persona Multi purpose theme
 * Version      : 1.0
 */

 function setAddress(id)
{

    validateField();

    $.ajax({

        url         : 'App/public/assets/ajax/get_company.php',
        type        : 'post',
        dataType    : 'json',
        data        : {

                    company_id : id
        },

        success : function(data){

            if (data.exists !== undefined) {

                if (data.exists===true) {

                    $('#company_name').val(data.company_name);
                    $('#address').val(data.company_address);

                    $('.company_list_container').css({display : 'none'});                 

                }else if (data.exists===false){

                }


            }
            
        },
        error   : function(data){

            console.log(data);

        }
    });
}

function checkItem(name)
{
    validateField();

    var flag = false;
    $('.add_item').each(function(){

        var check_name = $(this).find('#item_name').val();

        if (check_name == name) {
            flag = true;
        }
    });

    return flag;
}


 function setItem(id,item,p)
{

    validateField();

    var item = $('#'+item).parent();

    $.ajax({

        url         : 'App/public/assets/ajax/get_item.php',
        type        : 'post',
        dataType    : 'json',
        data        : {

                    item_id : id
        },

        success : function(data){

            if (data.exists !== undefined) {

                if (data.exists===true) {

                    var num =  $('#'+p).find('#item_num'),
                        name = $('#'+p).find('#item_name'),
                        price = $('#'+p).find('#price'),
                        qty = $('#'+p).find('#qty'),
                        total = $('#'+p).find('#total'),
                        tax = $('#tax').val();

                    if(checkItem(data.item_name)){
                        alert("Please Choose One Item for single invoice. You can choose more than on quantity.");
                        num.val("");
                        name.val("");
                        price.val("");
                        qty.val(1);
                        total.val("");
                    }else{
                        num.val(data.id);
                        name.val(data.item_name);
                        price.val(data.price);
                        total.val(data.price * qty.val()),
                        subtotal = $('#sub_total').val();
                        $('#sub_total').val(calculateSubTotal());
                        var tax_amount = (parseFloat(tax) * calculateSubTotal())/100;
                        $('#tax_amount').val(tax_amount);
                        $('#total_amount').val(calculateSubTotal() + tax_amount);
                    }

                    

                    $('.item_list_container').css({display : 'none'});                 

                }else if (data.exists===false){

                }


            }
            
        },
        error   : function(data){

            console.log(data);

        }
    });
}

function removeItem(item){
    $('.'+item).remove();


    var tax = $('#tax').val();

    $('#sub_total').val(calculateSubTotal());

    var tax_amount = (parseFloat(tax) * calculateSubTotal())/100;
    $('#tax_amount').val(tax_amount);
    $('#total_amount').val(calculateSubTotal() + tax_amount);
}

function deleteInvoice(id)
{
    $.ajax({

        url         : 'App/public/assets/ajax/delete_invoice.php',
        type        : 'post',
        dataType    : 'json',
        data        : {

                    id : id
        },

        success : function(data){

            if (data.exists !== undefined) {

                if (data.exists===true) {

                    window.location = data.url;                

                }else if (data.exists===false){

                    console.log(data.diffs);

                    $('#save_errors').html(data.errors);

                }


            }
            
        },
        error   : function(data){

            console.log(data);

        }
    });
}

function calculateTotal(parent){

    validateField();

    var parent = $('#'+parent),
        qty = parent.find('.qty').val(),
        price = parent.find('.price').val(),
        tax = $('#tax').val(),
        total;

    if(price == "" || price == 0)
    {
        total = 0;
    }else{
        total = price * qty;
    }

    parent.find('#total').val(total);
    var total = parent.find('#total').val();
    var subtotal = $('#sub_total').val();
    $('#sub_total').val(calculateSubTotal());

    var tax_amount = (parseFloat(tax) * calculateSubTotal())/100;
    $('#tax_amount').val(tax_amount);
    $('#total_amount').val(calculateSubTotal() + tax_amount);
}

function calculateSubTotal()
{
    var subtotal = 0;
    $(".add_item").each(function(){
        var price = $(this).find('.price').val();
        var qty = $(this).find('.qty').val();

        if(qty === undefined || qty == 0 || qty == "")
        {
             var total = parseFloat(price) * 0;
         }else{
             var total = parseFloat(price) * parseFloat(qty);
         }
       

        subtotal = parseFloat(subtotal) + total;
    });

    return subtotal;
}


function validateField()
{
    $(".add_item").each(function(){
        var company_name = $('#company_name').val();
        var name = $(this).find('.item_name').val();
        var qty = $(this).find('.qty').val();
        
        if(company_name == ""){
           // console.log('item num');
           $('#company_name').css({border : '1px solid red'});
        }else{
             $('#company_name').css({border : '0px'});
        }
        if(name == ""){
            //console.log('name');
            $(this).find('.item_name').css({border : '1px solid red'});
        }else{
             $(this).find('.item_name').css({border : '0px'});
        }
        if(qty == ""){
            //console.log('price');
            $(this).find('.qty').css({border : '1px solid red'});
        }else{
             $(this).find('.qty').css({border : '0px'});
        }
    });
}


function printInvoice(id) {
    
    $.ajax({

        url         : 'App/public/assets/ajax/print_invoice.php',
        type        : 'post',
        dataType    : 'json',
        data        : {

                    invoice_id : id,
        },

        success : function(data){

            if (data.exists !== undefined) {

                if (data.exists===true) {

                    $markup = "<!DOCTYPE html>" +
                                "<html>" +
                                    "<head>" +
                                        "<meta charset=\"utf-8\">" +
                                        "<title>Invoice</title>" +
                                        "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" integrity=\"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u\" crossorigin=\"anonymous\">" +
                                    "</head>" +
                                    "<body onload=\"window.print()\">" +
                                    data.html +
                                    "</body>" +
                                "</html";

                    var divToPrint = document.getElementById('main');
                    var popupWin = window.open('', '_blank', 'width=1000,height=1000');
                    popupWin.document.open();
                    popupWin.document.write($markup);
                    popupWin.document.close();               

                }else if (data.exists===false){

                    console.log(data);

                    //$('#save_errors').html(data.errors);

                }


            }
            
        },
        error   : function(data){

            console.log(data);

        }
    });
}



(function($) {
    "use strict";



    jQuery(document).ready(function($) {

        // $(window).on("click",function(){
        //      $('.company_list_container').css({display : 'none'});
        // });
       
        $('.check-exists').on("click",function(){

            validateField();

            $('.company_list_container').css({display : 'block'});

            $(this).inputExistsChecker({
                action : true
            });
        });

        /*
         * Add New Item field
        */

        $("#add").click(function() {

            validateField();
   
            var id = $(".add_item").length + 1;

            var addWrapper = "<table id='add_item_"+id+"' class='add_item add_item_" + id + " table table-striped table-bordered table-list'>" +
                                "<thead>" +
                                    "<th>Item No</th>" +
                                    "<th>Item Name</th>" +
                                    "<th>Price</th>" +
                                    "<th>Quantity</th>" +
                                    "<th>Total</th>" +
                                    "<th>Action</th>" +
                                "</thead>" +
                                "<tbody>" +
                                    "<tr>" +
                                        "<td><input type='text' name='item_num_" + id + "' id='item_num' data-parent='add_item_"+id+"' class='item_num form-control' readonly></td>" +
                                        "<td class='item_name_container'><input type='text' data-type='item_name' name='item_name_" + id + "' id='item_name' data-parent='add_item_"+id+"' class='item_name form-control'><div class='item_list_container'></div></td>" +
                                        "<td><input type='text' name='price_"+ id + "'id='price' data-parent='add_item_"+id+"' class='price form-control' readonly></td>" +
                                        "<td><input type='number' min='1' name='qty_" + id + "' id='qty' data-parent='add_item_"+id+"' class='qty form-control' value='1' onkeyup=\"return calculateTotal('add_item_"+id+"');\"></td>" +
                                        "<td><input type='text' name='total_" + id + "' id='total' data-parent='add_item_"+id+"' class='total form-control' value='0' readonly></td>" +
                                        "<td class='text-center'><a href='#' onclick=\"return removeItem('add_item_"+id+"')\" class='delete'><i class='fa fa-remove' aria-hidden='true'></i></a></td>" +
                                    "</tr>" +
                                "</tbody>" +
                            "</table>";

            $("#item_container").append(addWrapper);

            /*
             * Search Item
             */

           $('.item_name').each(function(i,item){

                var self = $(this);
                $(item).on("click",function(){

                    // console.log('clicked');
                    $('.item_list_container').css({display : 'none'});

                    $(this).parent().find('.item_list_container').css({display : 'block'});

                    $(this).itemChecker({
                        action : true
                    });
                });
            });
        });

        /*
         * Search Item
         */
        
        $('.item_name').on("focus",function(){

            validateField();
            $('.item_list_container').css({display : 'none'});

            var parent = $(this).parent();
            parent.find('.item_list_container').css({display : 'block'});

            $(this).itemChecker({
                action : true
            });
        });

        /*
         * Save Invoice
         */

        $('#submit').on("click",function(e){
            e.preventDefault();
            var company_name = $('#company_name').val(),
                company_address = $('#address').val(),
                notes = $('#notes').val(),
                tax = $('#tax').val(),
                tax_amount = $('#tax_amount').val(),
                total_amount = $('#total_amount').val(),
                data = [],
                subTotal = 0,
                flag = false;

            $(".add_item").each(function(){
                var company_name = $('#company_name').val();
                var item_num = $(this).find('.item_num').val();
                var name = $(this).find('.item_name').val();
                var price = $(this).find('.price').val();
                var qty = $(this).find('.qty').val();
                var total = $(this).find('#total').val();
                
                if(company_name == ""){
                   // console.log('item num');
                   $('#company_name').css({border : '1px solid red'});
                }else{
                     $('#company_name').css({border : '0px'});
                }
                if(item_num == ""){
                   // console.log('item num');
                    $(this).find('.item_num').css({border : '1px solid red'});
                }else{
                     $(this).find('.item_num').css({border : '0px'});
                }
                if(name == ""){
                    //console.log('name');
                    $(this).find('.item_name').css({border : '1px solid red'});
                }else{
                     $(this).find('.item_name').css({border : '0px'});
                }
                if(price == ""){
                    //console.log('price');
                    $(this).find('.price').css({border : '1px solid red'});
                }else{
                     $(this).find('.price').css({border : '0px'});
                }
                if(qty == ""){
                    //console.log('price');
                    $(this).find('.qty').css({border : '1px solid red'});
                }else{
                     $(this).find('.qty').css({border : '0px'});
                }

                if(company_name != "" && item_num != "" && name != "" && price != "" && total != 0){
                    flag = true;
                    data.push([item_num,name,price,qty,total]);
                    subTotal = parseFloat(subTotal) + parseFloat(total);
                    
                }else{
                    flag = false;
                    return;
                }
            });

            if(flag == true){
                $.ajax({

                    url         : 'App/public/assets/ajax/save_invoice.php',
                    type        : 'post',
                    dataType    : 'json',
                    data        : {

                                items : data,
                                company_name : company_name,
                                company_address : company_address,
                                sub_total : calculateSubTotal(),
                                tax : parseFloat(tax),
                                tax_amount : parseFloat(tax_amount),
                                total : parseFloat(total_amount),
                                notes : notes
                    },

                    success : function(data){

                        if (data.exists !== undefined) {

                            if (data.exists===true) {

                                window.location = data.url;                

                            }else if (data.exists===false){

                                console.log(data.diffs);

                                $('#save_errors').html(data.errors);

                            }


                        }
                        
                    },
                    error   : function(data){

                        console.log(data);

                    }
                });
            }
            
            
        });

        /*
         * Update Invoice
         */
         $('#update').on("click",function(e){
            e.preventDefault();
            var company_name = $('#company_name').val(),
                company_address = $('#address').val(),
                notes = $('#notes').val(),
                tax = $('#tax').val(),
                tax_amount = $('#tax_amount').val(),
                total_amount = $('#total_amount').val(),
                id = $('#invoice_id').val(),
                data = [],
                subTotal = 0,
                flag = false;

            $(".add_item").each(function(){
                var company_name = $('#company_name').val();
                var item_num = $(this).find('.item_num').val();
                var name = $(this).find('.item_name').val();
                var price = $(this).find('.price').val();
                var qty = $(this).find('.qty').val();
                var total = $(this).find('#total').val();
                
                if(company_name == ""){
                   // console.log('item num');
                   $('#company_name').css({border : '1px solid red'});
                }else{
                     $('#company_name').css({border : '0px'});
                }
                if(item_num == ""){
                   // console.log('item num');
                    $(this).find('.item_num').css({border : '1px solid red'});
                }else{
                     $(this).find('.item_num').css({border : '0px'});
                }
                if(name == ""){
                    //console.log('name');
                    $(this).find('.item_name').css({border : '1px solid red'});
                }else{
                     $(this).find('.item_name').css({border : '0px'});
                }
                if(price == ""){
                    //console.log('price');
                    $(this).find('.price').css({border : '1px solid red'});
                }else{
                     $(this).find('.price').css({border : '0px'});
                }
                if(qty == ""){
                    //console.log('price');
                    $(this).find('.qty').css({border : '1px solid red'});
                }else{
                     $(this).find('.qty').css({border : '0px'});
                }

                if(company_name != "" && item_num != "" && name != "" && price != "" && total != 0){
                    flag = true;
                    data.push([item_num,name,price,qty,total]);
                    subTotal = parseFloat(subTotal) + parseFloat(total);
                    
                }else{
                    flag = false;
                    return;
                }
            });

            if(flag == true){

                $.ajax({

                    url         : 'App/public/assets/ajax/update_invoice.php',
                    type        : 'post',
                    dataType    : 'json',
                    data        : {

                                id : id,
                                items : data,
                                company_name : company_name,
                                company_address : company_address,
                                sub_total : calculateSubTotal(),
                                tax : parseFloat(tax),
                                tax_amount : parseFloat(tax_amount),
                                total : parseFloat(total_amount),
                                notes : notes
                    },

                    success : function(data){

                        if (data.exists !== undefined) {

                            if (data.exists===true) {

                                window.location = data.url;               

                            }else if (data.exists===false){

                               $('#save_errors').html(data.errors);

                            }


                        }
                        
                    },
                    error   : function(data){

                        console.log(data);

                    }
                });
            }
            
            
        });
    });

    /*
     * ----------------------------------------------------------------------------------------
     *  PRELOADER JS
     * ----------------------------------------------------------------------------------------
     */

    $(window).on('load', function(event) {
        // setTimeout(function(){ 
        //     $('#preloader').fadeOut();
        //     $('.preloader_spinner').delay(222350).fadeOut('slow');
        //     $("header,main,section,footer").css({
        //         opacity : '',
        //     });
        // }, 3000);
    });


}(jQuery));
