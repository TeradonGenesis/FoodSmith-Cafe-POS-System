$(document).ready(function () {

    $('.modalButton').on('click', function () {
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



function updateStatus($status, $id) {
    //get the input value
    $.ajax({
        //type. for eg: GET, POST
        type: "POST",
        //the url to send the data to
        url: "manage-menu.php",
        //the data to send to
        data: {
            status: $status,
            id: $id
        },
        //on success
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

//Delete food item
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

    $('#searchSubmitID').on('click', function () {
        $name = $('#searchNameID').val();
        $type = $('#searchTypeID').val();
        alert("Hi")
        if ($name == '' && $type == '') {
            alert("Enter a value in either day or month field to conduct search!");
        } else {
            $('#foodTableID tbody').empty();
            $.ajax({
                type: 'POST',
                url: '../connection/retrieveFoodMenu.php',
                data: {
                    name: $name,
                    type: $type
                },
                dataType: 'html',
                success: function (data) {
                    var result = data
                    $('#foodTableID tbody').append(result);

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

                }
            });
        }
    })



}
