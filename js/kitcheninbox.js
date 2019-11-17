$(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });


        });

        function deleteFood($order_id, $ordered_food) {
            //get the input value
            $.ajax({
                //type. for eg: GET, POST
                type: "POST",
                //on success     
                //the url to send the data to
                url: "kitcheninbox.php",
                //the data to send to
                data: {
                    deleteorderid: $order_id,
                    deleteorderedfood: $ordered_food
                },
                success: function() {
                    $(".table-container").load("kitcheninbox.php .table-container");
                }

            });

        }


        function updateStatus($order_id, $ordered_food) {
            //get the input value
            $.ajax({
                //type. for eg: GET, POST
                type: "POST",
                //the url to send the data to
                url: "kitcheninbox.php",
                //the data to send to
                data: {
                    update_order_id: $order_id,
                    update_ordered_food: $ordered_food
                },
                //on success
                success: function() {
                    alert("Data sent"),
                        $(".table-container").load("kitcheninbox.php .table-container");

                }
            });
        }

        $('.modalButton').on('click', function() {
            $('#editableModal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            var numID = data[0];

            $("#editID").html(numID);
            $(".quantityOrderID").val(data[0]);
            $(".quantityOrderedFood").val(data[1]);
            $(".editQuantity").val(data[3]);


        });

        $('#qtyUpdateForm').submit(function(e) {

            e.preventDefault;

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                //type. for eg: GET, POST
                type: "POST",
                //the url to send the data to
                url: url,
                //the data to send to
                data: form.serialize(),
                //on success
                success: function() {
                    alert("Data sent"),
                        $(".table-container").load("kitcheninbox.php .table-container");

                }
            });


        });


function sortTable(columnName) {

    var sort = $("#sort").val();
    $.ajax({
        url: 'connection/sortKitchen.php',
        type: 'post',
        data: {
            columnName: columnName,
            sort: sort
        },
        success: function (response) {
            
            $("#kitchen-table tr:not(:first)").remove();

            $("#kitchen-table").append(response);
            if (sort == "asc") {
                $("#sort").val("desc");
            } else {
                $("#sort").val("asc");
            }

            $('.modalButton').on('click', function() {
            $('#editableModal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            var numID = data[0];

            $("#editID").html(numID);
            $(".quantityOrderID").val(data[0]);
            $(".quantityOrderedFood").val(data[1]);
            $(".editQuantity").val(data[3]);


        });

        $('#qtyUpdateForm').submit(function(e) {

            e.preventDefault;

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                //type. for eg: GET, POST
                type: "POST",
                //the url to send the data to
                url: url,
                //the data to send to
                data: form.serialize(),
                //on success
                success: function() {
                    alert("Data sent"),
                        $(".table-container").load("kitcheninbox.php .table-container");

                }
            });


        });


        }
    });
}
