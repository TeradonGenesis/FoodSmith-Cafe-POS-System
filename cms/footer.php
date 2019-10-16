<!-- jQuery CDN - Slim version (=without AJAX) -->
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->

<script src="../js/jquery.tabledit.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });

        $('.modalButton').on('click', function() {
            $('#editableModal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
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

            $("#editCategory option").filter(function() {
                return $(this).text() == $cat;
            }).prop("selected", true);
        });


    });

</script>
<script language="JavaScript">
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
            success: function() {
                $(".table-container").load("manage-menu.php .table-container ", function() {

                    $('.modalButton').click(function(e) {
                        e.preventDefault();
                        $('#editableModal').modal('show');
                        $tr = $(this).closest('tr');
                        var data = $tr.children("td").map(function() {
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

                        $("#editCategory option").filter(function() {
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

</script>

<script>
    // Add the following code if you want the name of the file appear on select
    $(".file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(".file-label").html(fileName);
    });

</script>
