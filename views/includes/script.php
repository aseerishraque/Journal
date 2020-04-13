<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.responsive.min.js"></script>

<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="js/toastr.min.js"></script>
<!-- Page level custom scripts -->
<!--  <script src="js/demo/datatables-demo.js"></script>-->
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }


    // toastr.success('Have fun storming the castle!', 'Miracle Max Says');
    <?php
    if (isset($_SESSION['error']))
    {
    ?>

            toastr.error('<?php echo $_SESSION['error'] ?>', "Failed");
    <?php
            unset($_SESSION['error']);
    }
    ?>

    <?php
    if (isset($_SESSION['success']))
    {
    ?>
    toastr.success('<?php echo $_SESSION['success'] ?>', "Success");
    <?php
    unset($_SESSION['success']);
    }
    ?>

    <?php
    if (isset($_SESSION['warning']))
    {
    ?>
    toastr.warning('<?php echo $_SESSION['warning'] ?>', "Warning");
    <?php
    unset($_SESSION['warning']);
    }
    ?>


    <?php
    if (isset($_SESSION['info']))
    {
    ?>
    toastr.info('<?php echo $_SESSION['info'] ?>', "Information");
    <?php
    unset($_SESSION['info']);
    }
    ?>





    $(document).ready(function () {

        $('#item').change(function () {
            var item = $('#item').val();

            generateEntryFormByItem(item);


        });

      function generateEntryFormByItem(item) {
          if(item == 5) // Capital Withdrawn
          {
              // console.log(item);

              $('#disabledAmount').html(``);

              // $('#disabledAmount').html(`
              //                   <label  for="inputAmount"><span id="amount_label" >Amount</span> </label>
              //                   <input type="hidden" value="1" id="amountHidden" name="dr_cr">
              //                   <input disabled type="number" class="form-control" id="amountPerSHare" value="1">`);


          }
          else
          // if (item != 5)
          {
              $("#amount_label").html('Amount');
              $('#disabledAmount').html(`<label  for="inputAmount"><span id="amount_label" >Amount</span> </label>
 <input onkeyup="shareCalculate()" name="dr_cr" type="number" class="form-control" id="dr_cr" value="1">`);
          }

          if(item == 1)
          {
              $("#amount_label").html('Amount per share');
          }


          $.ajax({
              url:'backend/user_form.php',
              method:'GET',
              data: {
                  item: item
              },
              success:function (data) {
                  $('#userForm').html(data);
              }

          });

          $.ajax({
              url:'backend/share_form.php',
              method:'GET',
              data: {
                  item: item
              },
              success:function (data) {
                  $('#shareForm').html(data);
              }

          });
      }

    });

    $(document).ready( function () {
        // Setup - add a text input to each footer cell
        $('#dataTable tfoot th').each( function () {
            var title = $(this).text();
            
            if (title != 'Debit' && title != 'Credit' && title != 'Balance' && title != 'Edit' && title != 'Delete' && title != 'Info' && title != 'Ledger')
            $(this).html( '<input style="width: 150px;" type="text" placeholder="Search '+title+'" />' );
        } );


        var table = $('#dataTable').DataTable({
            "ordering": false,
            "dom": 'Bfrtip',
            "buttons" : [ {
                extend: 'excelHtml5',
                // exportOptions: {
                //     columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                // },
                customize: function ( xlsx ){
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];

                    // jQuery selector to add a border
                    $('row c[r*="10"]', sheet).attr( 's', '25' );
                }
            } ]
           // 'responsive':true
        });

        // new $.fn.dataTable.FixedHeader( table );

        // Apply the search
        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );


    } );

    function shareCalculate() {
        var share = $('#share').val();
        var dr_cr = $('#dr_cr').val();
        var item = $('#item').val();
        var itemType;
        if(item == 5) // Item is Capital Withdrawn
        {
            itemType = "Dedited";
            dr_cr = $('#current_value_per_share').val();
        }
        else
            itemType = "Credited";
        var calc = share*dr_cr;
        calc = calc.toFixed(4);
        $('#shareAmount').html(calc+" will be "+itemType);
        // $('#shareAmount').html(share*dr_cr);
    }




    function getUserInfo(user_id) {
    $.ajax({
        url:'backend/get_name.php',
        method:'GET',
        data: {
            user_id: user_id
        },
        success:function (data) {

            if(data != false){
                var obj = JSON.parse(data);
                // console.log(obj);
                var current_profit = obj.current_profit;
                var current_profit_per_share = obj.current_profit_per_share;
                var current_value_per_share = obj.current_value_per_share;


                $('#user_name').val(obj.name);
                $('#userError').html("<span class=\"alert-success\">User Found</span>");
                $('#balance').val(obj.balance);
                $('#shares').val(obj.shares);
                $('#current_profit').val(current_profit);
                $('#current_profit_per_share').val(current_profit_per_share);
                $('#current_value_per_share').val(current_value_per_share);

            }
            else{
                $('#user_name').val("");
                $('#userError').html("<span class=\"alert-danger\">User Not registered </span>");
                $('#balance').val(00);
                $('#shares').val(00);
                $('#current_profit').val(00);
                $('#current_profit_per_share').val(00);
                $('#current_value_per_share').val(00);
            }


        }

    });
}

    function getUserName() {
        var user_id= $('#user_id').val();
        var item = $('#item').val();

        getUserInfo(user_id);
    }


    function getUserId() {
        var user_name= $('#user_name').val();

        $.ajax({
            url:'backend/get_id.php',
            method:'GET',
            data: {
                user_name: user_name
            },
            success:function (data) {
                if(data != false){
                    $('#user_id').val(data);
                    $('#userError').html("<span class=\"alert-success\">User Found</span>");
                    getUserInfo(data);
                }
                else{
                    $('#user_id').val("");
                    $('#userError').html("<span class=\"alert-danger\">User Not registered </span>");
                    $('#balance').val(00);
                    $('#shares').val(00);
                    $('#amountHidden').val(00);
                    $('#amountPerSHare').val(00);
                }


            }

        });
    }

    function getBuyerInfo(user_id) {
       $.ajax({
           url:'backend/get_name.php',
           method:'GET',
           data: {
               user_id: user_id
           },
           success:function (data) {

               if(data != false){
                   var obj = JSON.parse(data);
                   // console.log(obj);
                   var current_profit_per_share = obj.current_profit_per_share;
                   var current_value_per_share = obj.current_value_per_share;


                   $('#buyer_name').val(obj.name);
                   $('#buyerError').html("<span class=\"alert-success\">User Found</span>");
                   $('#buyer_balance').val(obj.balance);
                   $('#buyer_shares').val(obj.shares);
                   $('#buyers_current_profit_per_share').val(current_profit_per_share);
                   $('#buyers_current_value_per_share').val(current_value_per_share);

               }
               else{
                   $('#buyer_name').val("");
                   $('#buyerError').html("<span class=\"alert-danger\">User Not registered </span>");
                   $('#buyer_balance').val(00);
                   $('#buyer_shares').val(00);
                   $('#buyers_current_profit_per_share').val(00);
                   $('#buyers_current_value_per_share').val(00);
               }


           }

       });
   }


    function getBuyerName() {
        var user_id= $('#buyer_id').val();

        getBuyerInfo(user_id);


    }

    function getBuyerId() {
        var user_name= $('#buyer_name').val();

        $.ajax({
            url:'backend/get_id.php',
            method:'GET',
            data: {
                user_name: user_name
            },
            success:function (data) {
                if(data != false){
                    $('#buyer_id').val(data);
                    $('#buyerError').html("<span class=\"alert-success\">User Found</span>");
                    getBuyerInfo(data);
                }
                else{
                    $('#buyer_id').val("");
                    $('#buyerError').html("<span class=\"alert-danger\">User Not registered </span>");
                }



            }

        });
    }

    function transferShares() {
        var a = $('#transferShare').val();
        $('#transferedShare').val(a);
    }



    function exportTableToExcel(tableID, filename){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    }


</script>



