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


function deleteFood($id) {
    //get the input value
    $.ajax({
        //type. for eg: GET, POST
        type: "POST",
        //on success     
        //the url to send the data to
        url: "manage-menu.php",
        //the data to send to
        data: {
            deleteid: $id
        },
        success: function () {
            $(".table-container").load("manage-menu.php .table-container ", function () {

                $('.modalButton').click(function (e) {
                    e.preventDefault();
                    $('#editableModal').modal('show');
                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();
                    var url = $(this).closest('tr').find('img').attr('src').replace('../images/', '');
                    var category = $(this).closest('tr').find('#editCategory').attr('value');

                    var numID = data[0];

                    $("#edit-file-label").html(url);
                    $("#editID").html(numID);
                    $("#getID").val(numID);
                    $("#editName").val(data[2]);
                    $("#editPrice").val(data[3]);

                    $cat = data[4];

                    $("#editCategory option").filter(function () {
                        return $(this).text() == $cat;
                    }).prop("selected", true);
                });
            });
        }

    });



}

$('#editCategoryForm').submit(function(e) {
            
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
                 $(".table-container").load("manage-food-category.php .table-container");

            }
        });
});


function sortTable(columnName) {

    var sort = $("#sort").val();
    $.ajax({
        url: '../connection/sortCategory.php',
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

            });


        }
    });
}

