$(document).ready(function () {

    $('.modalButton').on('click', function () {
        $('#editableModal').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        var numID = data[0];

        $("#editID").html(numID);
        $("#getID").val(numID);
        $("#editName").val(data[1]);
        $("#editCategory").val(data[2]);

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


function deleteTable($id) {
    //get the input value
    $.ajax({
        //type. for eg: GET, POST
        type: "POST",
        //on success     
        //the url to send the data to
        url: "manage-table.php",
        //the data to send to
        data: {
            deleteid: $id
        },
        success: function () {
            $(".table-container").load("manage-table.php .table-container ", function () {

                $('.modalButton').on('click', function () {
                    $('#editableModal').modal('show');
                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();

                    var numID = data[0];

                    $("#editID").html(numID);
                    $("#getID").val(numID);
                    $("#editName").val(data[1]);
                    $("#editCategory").val(data[2]);

                });

            });
        }

    });



}



function sortTable(columnName) {

    var sort = $("#sort").val();
    $.ajax({
        url: '../connection/sortTables.php',
        type: 'post',
        data: {
            columnName: columnName,
            sort: sort
        },
        success: function (response) {

            $("#categoryTable tr:not(:first)").remove();

            $("#categoryTable").append(response);
            if (sort == "asc") {
                $("#sort").val("desc");
            } else {
                $("#sort").val("asc");
            }

            $('.modalButton').on('click', function () {
                $('#editableModal').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                var numID = data[0];

                $("#editID").html(numID);
                $("#getID").val(numID);
                $("#editName").val(data[1]);
                $("#editCategory").val(data[2]);

            });



        }
    });
}
