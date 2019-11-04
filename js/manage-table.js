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
