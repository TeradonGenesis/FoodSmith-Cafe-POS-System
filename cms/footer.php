<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="../js/jquery-3.4.1.slim.min.js"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.tabledit.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });


    });

</script>
<script language="JavaScript">
    function updateStatus($status, $id) {
        //get the input value
        $.ajax({
            //the url to send the data to
            url: "manage-menu.php",
            //the data to send to
            data: {
                status: $status,
                id: $id
            },
            //type. for eg: GET, POST
            type: "POST",
            //on success
        });
    }

</script>
