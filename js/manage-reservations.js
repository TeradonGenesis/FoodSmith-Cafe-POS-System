$(document).ready(function () {

    $('.modalButton').on("click", function (e) {
        e.preventDefault();
        $('#editableModal').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        var category = $(this).closest('tr').find('#editCategory').attr('value');

        var numID = data[0];

        $("#editID").html(numID);
        $("#getID").val(numID);
        $("#editReserve_name").val(data[1]);
        $("#editReserve_mobile").val(data[2]);
        $("#editReserve_date").val(data[3]);
        $("#editReserve_customers").val(data[4]);

        $cat = data[5];
        console.log(data)

        $("#editReserve_table option").filter(function () {
            return $(this).val() == $cat;
        }).prop("selected", true);
    });


});



function up() {
    $("#anchorUp").animate({
        backgroundColor: "rgb( 160, 160, 160)"
    }, 200);
    $("html, body").delay(300).animate({
        scrollTop: 0
    }, "fast");
}

function editable(id) {
    var modal = document.getElementById(id);
    modal.style.display = "block";
}




// Add the following code if you want the name of the file appear on select
$(".file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(".file-label").html(fileName);
});


function deleteReserve($id) {
    //get the input value
    $.ajax({
        //type. for eg: GET, POST
        type: "POST",
        //on success     
        //the url to send the data to
        url: "manage-reservations.php",
        //the data to send to
        data: {
            deleteid: $id
        },
        success: function () {
            $(".table-container").load("manage-reservations.php .table-container ", function () {

                $('.modalButton').on("click", function (e) {
                    e.preventDefault();
                    $('#editableModal').modal('show');
                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();
                    var category = $(this).closest('tr').find('#editCategory').attr('value');

                    var numID = data[0];

                    $("#editID").html(numID);
                    $("#getID").val(numID);
                    $("#editReserve_name").val(data[1]);
                    $("#editReserve_mobile").val(data[2]);
                    $("#editReserve_date").val(data[3]);
                    $("#editReserve_customers").val(data[4]);

                    $cat = data[5];
                    console.log(data)

                    $("#editReserve_table option").filter(function () {
                        return $(this).val() == $cat;
                    }).prop("selected", true);
                });
            });
        }

    });



}

function sortTable(columnName) {

    var sort = $("#sort").val();
    $.ajax({
        url: '../connection/sortReservation.php',
        type: 'post',
        data: {
            columnName: columnName,
            sort: sort
        },
        success: function (response) {

            $("#reservation_table tr:not(:first)").remove();

            $("#reservation_table").append(response);
            if (sort == "asc") {
                $("#sort").val("desc");
            } else {
                $("#sort").val("asc");
            }

            $('.modalButton').on("click", function (e) {
                e.preventDefault();
                $('#editableModal').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
                var category = $(this).closest('tr').find('#editCategory').attr('value');

                var numID = data[0];

                $("#editID").html(numID);
                $("#getID").val(numID);
                $("#editReserve_name").val(data[1]);
                $("#editReserve_mobile").val(data[2]);
                $("#editReserve_date").val(data[3]);
                $("#editReserve_customers").val(data[4]);

                $cat = data[5];
                console.log(data)

                $("#editReserve_table option").filter(function () {
                    return $(this).val() == $cat;
                }).prop("selected", true);
            });



        }
    });
}

$('#editCategoryForm').submit(function (e) {

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
        success: function () {
            alert("Data sent"),
                $(".table-container").load("manage-food-category.php .table-container");

        }
    });
});

$('#updateReserve_form').submit(function (e) {

            e.preventDefault;

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                //type. for eg: GET, POST
                type: "POST",
                //the url to send the data to
                url: "../cms/update-service.php",
                //the data to send to
                data: form.serialize(),
                //on success
                success: function () {
                    alert("Data sent"),
                        $(".table-container").load(".table-container");

                }
            });
    });


function updateStatus($reserve_id) {
        //get the input value
        $.ajax({
            //type. for eg: GET, POST
            type: "POST",
            //the url to send the data to
            url: "manage-reservations.php",
            //the data to send to
            data: {
                update_reserve_id: $reserve_id,
            },
            //on success
            success: function() {
                alert("Data sent"),
                 $(".table-container").load("manage-reservations.php .table-container");

            }
        });
    }
