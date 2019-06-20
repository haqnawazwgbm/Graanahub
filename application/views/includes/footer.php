<div class="sidebar-overlay" data-reff="#sidebar"></div>
<span class="edit-form-container"></span>
<?php include_once('request_form.php'); ?>
<?php include_once('delete_form.php'); ?>
<?php include_once('js.php'); ?>
<script type="text/javascript">
	function readURL(input) {
			        if (input.files && input.files[0]) {
			            var reader = new FileReader();
			            
			            reader.onload = function (e) {
			                $('#user-img').attr('src', e.target.result);
			            }
			            reader.readAsDataURL(input.files[0]);
			        }
			    }
			    $("#userpicture").change(function(){
			        readURL(this);
			    });
			    $(document).ready(function() {
			    	$('.paging_simple_numbers').css('text-align', 'left');
			    })

			    

			    
</script>
</div>
</body>
</html>