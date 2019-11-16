var _totalPrice = 0.00;
$('#totalAmt').html(_totalPrice.toFixed(2));

$('.table tbody').on('click', '.btn', function() {
    $(this).closest('tr').remove(); //removes the closest table row, in this case, the table row where the delete button is pressed
    updatePrice();
});

$('#resetBtn').on('click', function() {
    $('#table tbody').empty(); //empties the table
    $('#totalAmt').text("0.00");
});

function insertOrder(_id, _food, _table, _qty, _price) {
    $.ajax({
        type: "POST",
        url: "connection/insertOrder.php",
        data: {
            id: _id,
            food: _food,
            table: _table,
            qty: _qty,
            price: _price,
        }

    });
}

$('#submitBtn').on('click', function() {

    var _tableNo;
    var _orderid;
    var _foodname;
    var _foodcode;
    var _qty;
    var _price;
    _length=$('.table tbody tr').length;
    _tableNo = $('#sel1 :selected').text();
    if (_tableNo == "Table No" || _length==0) {
        alert("Error, either table number not chosen or order is empty!");
    } else {
        _price = _totalPrice;
        _orderid = $('#orderID').html();

        $.ajax({
            type: "POST",
            url: "connection/insertID.php",
            data: {
                id: _orderid,
            }
        });

        $('.table tbody tr').each(function(rowIndex) {
            _foodname = $(this).find('.food-item-name').html();
            $('.card-body').each(function(rowIndex){
                if($(this).find('.btnfood1').html()==_foodname){
                    _foodcode=$(this).find('.foodid').val();
                    return false;
                }
            });

            _qty = $(this).find('input[type=number]').val();
            _price = _totalPrice;

            insertOrder(_orderid, _foodcode, _tableNo, _qty, _totalPrice);
        });
        if(alert("Order submitted!")){

        }
        else{
            window.location.reload(true);
        }
    }
});

$('.btnfood1').on('click', function() {
    $getName = $(this).closest('.card-body');
    var getName = $getName.children("a").map(function() {
        return $(this).text();
    }).get();

    $getPrice = $(this).closest('.card-body');
    var getPrice = $getPrice.children("p").map(function() {
        return $(this).text();
    }).get();

    var _name = getName[0];
    var foodprice = getPrice[0];

    var _length=$('.table tbody tr').length;

    if(_length==0){
        var _tr = '<tr class="deleteRow"><th scope="row"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></th><td class="food-item-name">' + _name + '</td><td><input class="form-control" min="1" type="number" value="1"/></td><td class="price">'+ foodprice +'</td></tr>'
        $('tbody').append(_tr);
        updatePrice();
    }else{
        var _found=false;
        $('.table tbody tr').each(function(rowIndex) {
            var _match = $(this).find('.food-item-name').html();
            if (_match == _name) {
                alert("It has already been added to food cart.");
                _found=true;
                return false;
            }
        });
        if(_found==false){
            var _tr = '<tr class="deleteRow"><th scope="row"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></th><td class="food-item-name">' + _name + '</td><td><input class="form-control" min="1" type="number" value="1"/></td><td class="price">'+ foodprice +'</td></tr>'
            $('tbody').append(_tr);
            updatePrice();
        }
    }
});

function updatePrice() {
    _totalPrice = 0.00;
    $('.table tbody tr').each(function(rowIndex) {
        var _qty=$(this).find('input[type=number]').val();
        var _price=parseFloat($(this).find('td.price').html());
        var _increase=_qty*_price;
        _totalPrice+=_increase;
    });

    $('#totalAmt').html(_totalPrice.toFixed(2));
}
$('.table tbody').on('change', 'tr', function() {
    var _qty;
    var _price;
    var _increase;

    $(this).find('input').each(function() {
        _qty = $(this).val();
    });
    $(this).find('td.price').each(function() {
        _price = $(this).html();
    });

    _increase = _qty * _price;



    updatePrice();
});

//for category tabbing
$(function(){
  $('ul li.active2 a').click(function(e){
    e.preventDefault();
    var category = $(this).text().split("&");
    var number = category[0];
    if(category[0].toLowerCase()=="all food")
    {
      $('.customCard').show();
    }
    else
    {
       //hide all categories
       $('.customCard').hide();
       $.each(category, function(i, v){
         $('.'+v.trim()+'-'+v.trim()).show();
       });
    }
  });

});