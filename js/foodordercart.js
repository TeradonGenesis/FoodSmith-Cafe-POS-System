$('.table tbody').on('click', '.btn', function() {
    $(this).closest('tr').remove(); //removes the closest table row, in this case, the table row where the delete button is pressed
});

$('#resetBtn').on('click', function() {
    $('#table tbody').empty(); //empties the table
    $('#totalAmt').text("RM 0");
});