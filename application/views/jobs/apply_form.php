<?php $CI =& get_instance();
$domiciles = $CI->get_domiciles();
$experiences = $CI->get_experiences();
?>
<div id="add_form" class="modal custom-modal fade job-apply" role="dialog">
                <div class="modal-dialog">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-content modal-lg">
        <div class="page-wrapper job-wrapper">
                <div class="content container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h4 class="page-title">Apply Job</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2"> 
                        <form method="POST" action="<?= base_url(); ?>Site_Jobs/apply" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" type="text">
                            </div>
                            <input type="hidden" name="job_id" value="<?= $job['job_id']; ?>">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input class="form-control" name="email" type="text">
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input class="form-control" name="phone_no" type="text">
                            </div>
                            <div class="form-group">
                                            <label>Domicile</label>
                                            <select class="select" name="domicile_id">
                                                <option value="0">Select Domicile</option>
                                            <?php foreach ($domiciles as $domicile) : ?>
                                                <option value="<?= $domicile['id']; ?>"><?= ucfirst($domicile['name']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                            </div>
                            <div class="form-group">
                                            <label>Education</label>
                                            <select class="select" name="education">
                                                <option value="0">Select Education</option>
                                                <option value="bachelor">Bachelor</option>
                                                <option value="master">Master</option>
                                            </select>
                            </div>
                            <div class="form-group">
                                            <label>Experience</label>
                                            <select class="select" name="experience_id">
                                                <option value="0">Select Experience</option>
                                            <?php foreach ($experiences as $experience) : ?>
                                                <option value="<?= $experience['id']; ?>"><?= ucfirst($experience['name']); ?></option>
                                            <?php endforeach; ?>
                                                
                                            </select>
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" name="message"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Upload your CV</label>
                                <input type="file" required name="userfile" class="form-control">
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary btn-lg" type="submit" name="submitUser" value="true">Send Application</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
            </div>
            </div>