<!DCOCTYPE html>
<html lang="en">
    <head>
        <title>Food Order Cart</title>
        <!--Required meta tags-->
        <meta charset="utf-8"/>
        <meta name="viewport" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
        
        
        
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 bg-info">
                    Aldalton's place
                </div>
                <div class="col-md-3 ml-auto">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="sel1">Select table:</label>
                              <select class="form-control" id="sel1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!--Autoincremented based on Order ID in database-->
                            Order ID autogenerated?
                        </div>
                        <div class="col-md-12">
                            <table id="table" class="table">
                                <thead>
                                    <th scope="col">Delete</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                </thead>
                                <tbody>
                                    <!--Stand in data, hardcoded-->
                                    <tr class="deleteRow">
                                        <th scope="row">
                                            <button type="button" class="btn btn-danger btn-sm">
                                                DELETE
                                            </button>
                                        </th> <!--Work on deletion-->
                                        <td>Item 1</td>
                                        <td>
                                            <input class="form-control" type="number" value="1"/>
                                        </td>
                                        <td>RM 50.00</td>
                                    </tr>
                                    
                                    <tr class="deleteRow">
                                        <th scope="row">
                                            <button type="button" class="btn btn-danger btn-sm">
                                                DELETE
                                            </button>
                                        </th> <!--Work on deletion-->
                                        <td>Item 1</td>
                                        <td>
                                            <input class="form-control" type="number" value="1"/>
                                        </td>
                                        <td>RM 50.00</td>
                                    </tr>
                                    <tr class="deleteRow">
                                        <th scope="row">
                                            <button type="button" class="btn btn-danger btn-sm">
                                                DELETE
                                            </button>
                                        </th> <!--Work on deletion-->
                                        <td>Item 1</td>
                                        <td>
                                            <input class="form-control" type="number" value="1"/>
                                        </td>
                                        <td>RM 50.00</td>
                                    </tr>
                                    <tr class="deleteRow">
                                        <th scope="row">
                                            <button type="button" class="btn btn-danger btn-sm">
                                                DELETE
                                            </button>
                                        </th> <!--Work on deletion-->
                                        <td>Item 1</td>
                                        <td>
                                            <input class="form-control" type="number" value="1"/>
                                        </td>
                                        <td>RM 50.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <p class="text-center">TOTAL PRICE:</p>
                        </div>
                        <div class="col-md-6">
                            <p id="totalAmt" class="text-center">RM 9000</p>
                        </div>
                        <div class="col-md-12">
                            <p class="text-center">
                                <button type="button" id="submitBtn"class="btn btn-primary">Submit</button>
                                <button type="button" id="resetBtn" class="btn btn-danger">Reset</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
        <!--Bootstrap JS-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script>
            $('.table tbody').on('click','.btn',function(){
                $(this).closest('tr').remove(); //removes the closest table row, in this case, the table row where the delete button is pressed
            });
            
            $('#resetBtn').on('click',function(){
               $('#table tbody').empty(); //empties the table
                $('#totalAmt').text("RM 0");
            });
        </script>
    </body>
</html>