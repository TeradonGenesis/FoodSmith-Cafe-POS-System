$('#search').on('click', function() {
    $day = $('#day').val();
    $month = $('#month').val()
    if($day=='' && $month==''){
        alert("Enter a value in either day or month field to conduct search!");
    }else{
        $('#transactionTable tbody').empty();
        $.ajax({
            type: 'POST',
            url: '../connection/retrieve.php',
            data: {
                day: $day,
                month: $month
            },
            dataType: 'html',
            success: function(data) {
                var result = data
                $('#transactionTable tbody').append(result);
            }
        });
    }
})

$('#reset').on('click', function() {
    $('#day').val('');
    $('#month').val('');
    $('#transactionTable tbody').empty();
    $.ajax({
        url: '../connection/reset.php',
        dataType: 'html',
        success: function(data) {
            var result = data
            $('#transactionTable tbody').append(result);
        }
    })
})
$('#newest').on('click',function(){
    $('#transactionTable tbody').empty();
    $.ajax({
        url:'../connection/newest.php',
        dataType:'html',
        success: function(data){
            var result =  data
            $('#transactionTable tbody').append(result);
        }
    });
})