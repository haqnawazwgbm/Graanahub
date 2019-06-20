<?php $CI =& get_instance(); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/fullcalendar.min.css">
<div id="calendar_modal" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<div class="row">
								<div class="col-xs-8">
									<h4 class="page-title">Calendar</h4>
								</div>
								
							</div>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<div id="calendar"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/moment.min.js"></script>
<script type="text/javascript">
	 $(document).ready(function() {
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: '<?= date('Y-m-d'); ?>',
      navLinks: true, // can click day/week names to navigate view1s
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
      <?php foreach ($users as $user) : ?>
        {
          	id: "<?= $user['start_date']; ?>",
          title: '<?= ucfirst($user['name']); ?>',
          start: "<?= $user['start_date']; ?>",
          end: "<?= $user['end_date']; ?>"
        },
       <?php endforeach; ?>
        
      ]
    });

  });
</script>