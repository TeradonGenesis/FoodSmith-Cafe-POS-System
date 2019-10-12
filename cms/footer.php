<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="../js/jquery-3.4.1.slim.min.js"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.tabledit.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/jquery-3.4.1.min.js"></script>

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
    
    function up() {
            $("#anchorUp").animate({
                backgroundColor: "rgb( 160, 160, 160)"
            }, 200);
            $("html, body").delay(300).animate({
                scrollTop: 0
            }, "fast");
        }
    
    function editable(id)
    {
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
