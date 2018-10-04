<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>ProGPS - report</title>

	<!-- Bootstrap -->
	<link href="<?php echo site_url(); ?>/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="<?php echo site_url(); ?>/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="<?php echo site_url(); ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- Datatables -->
	<link href="<?php echo site_url(); ?>/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo site_url(); ?>/assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo site_url(); ?>/assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo site_url(); ?>/assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo site_url(); ?>/assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
	<!-- Select2 -->
	<link href="<?php echo site_url(); ?>/assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="<?php echo site_url(); ?>/assets/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col menu_fixed">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="index.html" class="site_title"><i class="fa fa-map"></i> <span>G P S |<span style="color:orange"> C A K! </span></span></a>
					</div>

					<div class="clearfix"></div>

					<!-- sidebar menu -->
				<?php include 'v_sidebar_report.php'; ?>
					<!-- /sidebar menu -->

				</div>
			</div>

			<!-- top navigation -->
			<?php include 'v_topnav_home.php';?>
			<!-- /top navigation -->

			<?php if($sess_position == "admin") : ?>
				<!-- page content -->
				<div class="right_col" role="main" style="min-height:690px;">
					<div class="">
						<div class="row">
							<div class="col-md-12">
								<div class="x_panel">
									<div class="x_title">
										<h2><i class="fa fa-bars"></i> <b>AUDIT PLAN</b></h2>
										<div class="clearfix"></div>
									</div>
									<div class="x_content">
										<?php echo $this->session->flashdata('notif'); ?>
										<div class="" role="tabpanel" data-example-id="togglable-tabs">
											<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
												<?php if(isset($revisi_data)):?>
													<li role="presentation" class="active"><a href="#tab_content4" id="revisi-tab" role="tab" data-toggle="tab"><i class="fa fa-th"></i> <b>REVISI AUDIT PLAN</b></a>
													</li>
												<?php endif;?>
												<?php if(isset($edit_data)):?>
													<li role="presentation" class="active"><a href="#tab_content3" id="edit-tab" role="tab" data-toggle="tab"><i class="fa fa-pencil"></i> <b>EDIT AUDIT PLAN</b></a>
													</li>
												<?php endif;?>
												<li role="presentation" class="<?php if(!isset($edit_data) AND !isset($revisi_data)) echo 'active';?>"><a href="#tab_content1" id="list-tab" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i> <b>LIST DATA REPORT</b></a>
												</li>
												<li role="presentation" class=""><a href="#tab_content2" role="tab" id="add-tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-circle"></i> <b>ADD NEW DATA</b></a>
												</li>
											</ul>
											<div id="myTabContent" class="tab-content">

												<!-- REVISI TAB -->
												<?php if(isset($revisi_data)):?>
													<div role="tabpanel" class="tab-pane fade active in" id="tab_content4" aria-labelledby="revisi-tab">
														<?php
														$form_class = array('id' => 'demo-form2', 'class' => 'form-horizontal form-label-left', 'data-parsley-validate');
														echo form_open('report/manage_audit_plan/revisi/do_update/'.$revisi_data->no, $form_class);
														?>
														<div class="col-md-8 col-xs-12">
															<div class="x_panel">
																<div class="x_content">

																	<input type="hidden" value="<?php echo $no ?>" name="no">
																	<input type="hidden" value="<?php echo $revisi_data->group_rev ?>" name="group_rev">
																	<input type="hidden" value="<?php echo $revisi_data->kunjungan ?>" name="kunjungan">
																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="control-label col-md-4">Year</label>
																			<div class="col-md-8 col-xs-12">
																				<input type="number" class="form-control" placeholder="e.g. 2016, 2017"value="<?php echo $revisi_data->year ?>" name="year" required>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-4">Auditee Unit</label>
																			<div class="col-md-8 col-xs-12">
																				<select class="form-control" name="auditee_unit" required>
																					<option value="" disabled selected>Select your option</option>
																					<?php foreach ($auditee_unit as $row):?>
																						<?php if($row->unit == $revisi_data->auditee_unit){ ?>
																						<option selected><?php echo $row->unit ?></option>
																						<?php } else{ ?>
																						<option><?php echo $row->unit ?></option>
																						<?php } ?>
																					<?php endforeach; ?>
																				</select>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-4">Audit Code</label>
																			<div class="col-md-8 col-xs-12">
																				<select class="form-control" name="audit_code" required>
																					<option value="" disabled selected>Select your option</option>
																					<?php foreach ($code as $row): ?>
																						<?php if($row->order == "Internal") : ?>
																							<?php if($row->code == $revisi_data->audit_code){ ?>
																							<option selected><?php echo $row->code." (".$row->type." Audit)" ?></option>
																							<?php } else{ ?>
																							<option><?php echo $row->code ?></option>
																							<?php } ?>
																						<?php endif; ?>
																					<?php endforeach; ?>
																				</select>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-4">Visit Date</label>
																			<div class="col-md-8 col-xs-12">
																				<?php $temp_date_approved_revisi = date("d-m-Y", strtotime($revisi_data->date_approved)); ?>
																				<?php $temp_date_approved_up_to_revisi = date("d-m-Y", strtotime($revisi_data->date_approved_up_to)); ?>
																				<input type="text" name="visit_date" id="visit_date_revisi" class="form-control" placeholder="e.g. <?php echo date("d-m-Y")." - ". date("d-m-Y"); ?>" value="<?php echo $temp_date_approved_revisi." - ".$temp_date_approved_up_to_revisi; ?>" required>
																			</div>
																		</div>
																	</div><!-- DIV COL-MD-6 (1) -->

																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="control-label col-md-5 col-sm-3 col-xs-12">Issue No</label>
																			<div class="col-md-7 col-xs-12">
																				<input type="number" name="issue_no" class="form-control" name="issue_no" placeholder="e.g. 0,1,2" value="<?php echo $revisi_data->issue_no+1; ?>" required>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-5 col-xs-12">Issued Date</label>
																			<div class="col-md-7 col-xs-12">
																				<?php $temp_issued_date_edit = date("d-m-Y", strtotime($revisi_data->issued_date)); ?>
																				<input id="issued-date-revisi" class="date-picker form-control col-md-7" type="text" name="issued_date" placeholder="<?php echo "e.g. ".$temp_issued_date_edit; ?>" value="<?php echo $temp_issued_date_edit; ?>" required>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-5 col-sm-3 col-xs-12">Issued By</label>
																			<div class="col-md-7 col-xs-12">
																				<select class="form-control" name="issued_by" required>
																					<option value="" disabled selected>Select your option</option>
																					<?php foreach ($issued_by as $row): ?>
																						<?php if($row->position == "Quality Manager") : ?>
																							<?php if($row->name == $revisi_data->auditor_name){ ?>
																							<option selected><?php echo $row->name ?></option>
																							<?php } else{ ?>
																							<option><?php echo $row->name ?></option>
																							<?php } ?>
																						<?php endif; ?>
																					<?php endforeach; ?>
																				</select>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-5 col-sm-3 col-xs-12">Approved by</label>
																			<div class="col-md-7 col-xs-12">
																					<input type="text" class="form-control" name="approved_by" placeholder="Name VP Learning Services" value="<?php echo $revisi_data->approved_by?>" required>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-5 col-sm-3 col-xs-12">Auditor</label>
																			<div class="col-md-7 col-xs-12">
																				<select class="form-control" name="auditor_lapangan" required>
																					<option value="" disabled selected>Select your option</option>
																					<?php foreach ($issued_by as $row): ?>
																						<?php if($row->position == "Quality Manager") : ?>
																							<?php if($row->name == $revisi_data->auditor_lapangan){ ?>
																							<option selected><?php echo $row->name ?></option>
																							<?php } else { ?>
																							<option><?php echo $row->name ?></option>
																							<?php } ?>
																						<?php endif; ?>
																					<?php endforeach; ?>
																				</select>
																			</div>
																		</div>

																	</div><!-- /DIV COL-MD-6 (1) -->
																</div><!-- /DIV x_CONTENT -->
															</div><!-- DIV X_PANEL -->
														</div><!-- /DIV COL-MD-8 -->

														<div class="col-md-4 col-xs-12">
															<div class="x_panel">
																<div class="x_content">
																	<div class="form-group">
																		<label class="control-label col-md-4">Revisi No</label>
																		<div class="col-md-7 col-xs-12">
																			<input type="number" class="form-control" readonly="readonly" value="<?php echo $revisi_data->revisi_no+1; ?>" name="revisi_no">
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="control-label col-md-4">TPM Issue</label>
																		<div class="col-md-7">
																			<input type="text" class="form-control" placeholder="e.g. A, B, C" value="<?php echo $revisi_data->tpm_issue; ?>" name="tpm_issue" required>
																		</div>
																	</div>
																	<div class ="form-group">
																		<label class="control-label col-md-4">Description</label>
																		<div class="col-md-7">
																			<textarea class="form-control" rows="4" placeholder="Fill the box with description about this audit" name="desc" required><?php echo $revisi_data->desc; ?></textarea>
																		</div>
																	</div>

																</div><!-- /DIV X_CONTENT -->
															</div><!-- /DIV  X_PANEL-->
														</div><!-- /DIV COL-MD-4-->


														<div class="row">
															<div class="col-md-12">
																<div class="x_panel">
																	<div class="x_content">
																		<div class="form-group">
																			<label class="control-label col-md-2">Audit Requirement</label>
																			<div class="col-md-10">
																				<select class="select2_multiple form-control" multiple="multiple" name="requirement[]" required>
																					<?php $inc=0; ?>
																					<?php foreach ($requirement as $row): ?>
																						<?php if($count_revisi_req->counted>$inc) : ?>
																							<?php if($row->requirement == $revisi_data_req[$inc]->requirement) : ?>
																								<option selected><?php echo $row->requirement ?></option>
																								<?php $inc++; ?>
																							<?php else : ?>
																								<option><?php echo $row->requirement ?></option>
																							<?php endif?>
																						<?php else : ?>
																							<option><?php echo $row->requirement ?></option>
																						<?php endif;?>
																					<?php endforeach; ?>
																				</select>
																				<p class="control-label"><small>Need help for selecting audit requirement? <a href=<?php echo site_url('help')?> target="_blank"><b>Click here...</b></a></small></p>
																			</div>
																		</div><br><br><br>

																		<div class="ln_solid"></div>
																		<div class="form-group">
																			<div class="col-md-8 col-md-offset-4">
																				<button type="reset" class="btn btn-default">Reset all data</button>
																				<button type="submmit" class="btn btn-dark">Revisi Audit Plan</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div><!-- /DIV COL-MD-12 -->
														</div><!-- /DIV ROW -->
														<?php echo form_close(); ?>
													</div>
												<?php endif;?>

												<!-- EDIT TAB -->
												<?php if(isset($edit_data)):?>
													<div role="tabpanel" class="tab-pane fade active in" id="tab_content3" aria-labelledby="edit-tab">
														<?php
														$form_class = array('id' => 'demo-form2', 'class' => 'form-horizontal form-label-left', 'novalidate');
														echo form_open('report/manage_audit_plan/edit/do_update/'.$edit_data->no, $form_class);
														?>
														<div class="col-md-8 col-xs-12">
															<div class="x_panel">
																<div class="x_content">

																	<div class="col-md-6">
																		<input type="hidden" value="<?php echo $edit_data->no ?>" name="no">
																		<input type="hidden" value="<?php echo $edit_data->group_rev ?>" name="group_rev">
																		<input type="hidden" value="<?php echo $edit_data->kunjungan ?>" name="kunjungan">
																		<div class="form-group">
																			<label class="control-label col-md-4">Year</label>
																			<div class="col-md-8 col-xs-12">
																				<input type="number" class="form-control" placeholder="e.g. 2016, 2017" value="<?php echo $edit_data->year ?>" name="year" required>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-4">Auditee Unit</label>
																			<div class="col-md-8 col-xs-12">
																				<select class="form-control" name="auditee_unit" required>
																					<option value="" disabled>Select your option</option>
																					<?php foreach ($auditee_unit as $row):?>
																						<?php if($row->unit == $edit_data->auditee_unit){ ?>
																						<option selected><?php echo $row->unit ?></option>
																						<?php } else{ ?>
																						<option><?php echo $row->unit ?></option>
																						<?php } ?>
																					<?php endforeach; ?>
																				</select>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-4">Audit Code</label>
																			<div class="col-md-8 col-xs-12">
																				<select class="form-control" name="audit_code" required>
																					<option value="" disabled>Select your option</option>
																					<?php foreach ($code as $row): ?>
																						<?php if($row->order == "Internal") : ?>
																							<?php if($row->code == $edit_data->audit_code){ ?>
																							<option selected><?php echo $row->code." (".$row->type." Audit)" ?></option>
																							<?php } else{ ?>
																							<option><?php echo $row->code ?></option>
																							<?php } ?>
																						<?php endif; ?>
																					<?php endforeach; ?>
																				</select>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-4">Appendix Code</label>
																			<div class="col-md-8 col-xs-12">
																				<input type="number" class="form-control" placeholder="eg. 1" name="appendix" required>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-4">Visit Date</label>
																			<div class="col-md-8 col-xs-12">
																				<?php $temp_date_approved_edit = date("d-m-Y", strtotime($edit_data->date_approved)); ?>
																				<?php $temp_date_approved_up_to_edit = date("d-m-Y", strtotime($edit_data->date_approved_up_to)); ?>
																				<input type="text" name="visit_date" id="visit_date_edit" class="form-control" placeholder="e.g. <?php echo date("d-m-Y")." - ". date("d-m-Y"); ?>" value="<?php echo $temp_date_approved_edit." - ".$temp_date_approved_up_to_edit; ?>" required>
																			</div>
																		</div>
																	</div><!-- DIV COL-MD-6 (1) -->

																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="control-label col-md-5 col-sm-3 col-xs-12">Issue No</label>
																			<div class="col-md-7 col-xs-12">
																				<input type="number" name="issue_no" class="form-control" name="issue_no" placeholder="e.g. 0, 1, 2" value="<?php echo $edit_data->issue_no; ?>" required>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-5 col-xs-12">Issued Date</label>
																			<div class="col-md-7 col-xs-12">
																				<?php $temp_issued_date_edit = date("d-m-Y", strtotime($edit_data->issued_date)); ?>
																				<input id="issued-date-edit" class="date-picker form-control col-md-7" type="text" name="issued_date" placeholder="<?php echo $temp_issued_date_edit; ?>" value="<?php echo $temp_issued_date_edit; ?>" required>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-5 col-sm-3 col-xs-12">Issued By</label>
																			<div class="col-md-7 col-xs-12">
																				<select class="form-control" name="issued_by" required>
																					<option value="" disabled>Select your option</option>
																					<?php foreach ($issued_by as $row): ?>
																						<?php if($row->position == "Quality Manager") : ?>
																							<option><?php echo $row->name ?></option>
																						<?php endif; ?>
																					<?php endforeach; ?>
																				</select>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-5 col-sm-3 col-xs-12">Approved by</label>
																			<div class="col-md-7 col-xs-12">
																				<input type="text" class="form-control" name="approved_by" placeholder="Name VP Learning Services" value="<?php echo $edit_data->approved_by?>" required>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-5 col-sm-3 col-xs-12">Auditor</label>
																			<div class="col-md-7 col-xs-12">
																				<select class="form-control" name="auditor_lapangan" required>
																					<option value="" disabled selected>Select your option</option>
																					<?php foreach ($issued_by as $row): ?>
																						<?php if($row->position == "Quality Manager") : ?>
																							<?php if($row->name == $edit_data->auditor_lapangan){ ?>
																							<option selected><?php echo $row->name ?></option>
																							<?php } else { ?>
																							<option><?php echo $row->name ?></option>
																							<?php } ?>
																						<?php endif; ?>
																					<?php endforeach; ?>
																				</select>
																			</div>
																		</div>


																	</div><!-- /DIV COL-MD-6 (1) -->
																</div><!-- /DIV x_CONTENT -->
															</div><!-- DIV X_PANEL -->
														</div><!-- /DIV COL-MD-8 -->

														<div class="col-md-4 col-xs-12">
															<div class="x_panel">
																<div class="x_content">

																	<div class="form-group">
																		<label class="control-label col-md-4">Revisi No</label>
																		<div class="col-md-7 col-xs-12">
																			<input type="number" class="form-control" readonly="readonly" value="<?php echo $edit_data->revisi_no; ?>" name="revisi_no">
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="control-label col-md-4">TPM Issue</label>
																		<div class="col-md-7">
																			<input type="text" class="form-control" placeholder="e.g. A, B, C" value="<?php echo $edit_data->tpm_issue; ?>" name="tpm_issue" required>
																		</div>
																	</div>
																	<div class ="form-group">
																		<label class="control-label col-md-4">Description</label>
																		<div class="col-md-7">
																			<textarea class="form-control" rows="4" placeholder="Fill the box with description about this audit" name="desc" required><?php echo $edit_data->desc; ?></textarea>
																		</div>
																	</div>

																</div><!-- /DIV X_CONTENT -->
															</div><!-- /DIV  X_PANEL-->
														</div><!-- /DIV COL-MD-4-->

														<div class="col-md-12">
															<div class="x_panel">
																<div class="x_content">
																	<div class="form-group">
																		<label class="control-label col-md-2">Audit Requirement</label>
																		<div class="col-md-10">
																			<select class="select2_multiple form-control" multiple="multiple" name="requirement[]" required>
																				<?php $inc=0; ?>
																				<?php foreach ($requirement as $row): ?>
																					<?php if($count_edit_req->counted>$inc) : ?>
																						<?php if($row->requirement == $edit_data_req[$inc]->requirement) : ?>
																							<option selected><?php echo $row->requirement ?></option>
																							<?php $inc++; ?>
																						<?php else : ?>
																							<option><?php echo $row->requirement ?></option>
																						<?php endif?>
																					<?php else : ?>
																						<option><?php echo $row->requirement ?></option>
																					<?php endif;?>
																				<?php endforeach; ?>
																			</select>
																			<p class="control-label"><small>Need help for selecting audit requirement? <a href=<?php echo site_url('help')?> target="_blank"><b>Click here...</b></a></small></p>
																		</div>
																	</div>

																	<div class="ln_solid"></div>
																	<div class="form-group">
																		<div class="col-md-8 col-md-offset-4">
																			<button type="reset" class="btn btn-default">Reset all data</button>
																			<button type="submit" class="btn btn-primary">Edit Audit Plan</button>
																		</div>
																	</div>
																</div>
															</div>
														</div><!-- /DIV COL-MD-12 -->
														<?php echo form_close(); ?>
													</div><!-- /TAB PANEL -->
												<?php endif;?>

												<!-- LIST TAB -->
												<div role="tabpanel" class="tab-pane fade <?php if(!isset($edit_data) AND !isset($revisi_data)) echo 'active in';?>" id="tab_content1" aria-labelledby="list-tab">
													<div class="row">
														<div class="x_panel">
															<div class="x_content">
																<div class="col-md-12 col-xs-12">
																	<table id="datatable" class="table table-striped table-bordered">
																		<thead>
																			<tr>
																				<th class="text-center" style="vertical-align: middle;">#</th>
																				<th class="text-center" style="vertical-align: middle;">Audit No</th>
																				<th class="text-center" style="vertical-align: middle;">Planned Week</th>
																				<th class="text-center" style="vertical-align: middle;">Visit Date</th>
																				<th class="text-center" style="vertical-align: middle;">Auditor</th>
																				<th class="text-center" style="vertical-align: middle;">Status</th>
																				<th class="text-center" style="vertical-align: middle; width: 30%;">Action</th>
																			</tr>
																		</thead>


																		<tbody>
																			<?php// $inc = 1; ?>
																			<?php// foreach ($query as $row): ?>
																				<tr>
																					<td class="text-center" style="vertical-align: middle;">-<?php // echo $inc; $inc++ ?></td>
																					<td class="text-center" style="vertical-align: middle;">-<?php  //echo $row->audit_plan_no; ?></td>
																					<td class="text-center" style="vertical-align: middle;">-<?php //echo "Week ".$row->planned_week; ?></td>
																					<td class="text-center" style="vertical-align: middle;">-<?php //echo $temp_date_approved. " - ".$temp_date_approved_up_to; ?></td>
																					<td class="text-center" style="vertical-align: middle;">-<?php //echo $row->auditor_lapangan; ?></td>

																						<td class="text-center" style="vertical-align: middle;"><b>-</b></td>

																						<td class="text-center" style="vertical-align: middle;">-
																							<!-- <a href="<?php// echo base_url()."audit_plan/manage_audit_plan/view/".$row->no; ?>" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-folder"></i> View </a>
																							<a href="<?php// echo base_url()."report/manage_audit_plan/edit/".$row->no; ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit </a>
																							<a class="btn btn-danger btn-xs" data-toggle="modal" data-target=".modal-confirm-delete<?php// echo $row->no?>"><i class="fa fa-trash-o"></i> Delete </a> -->
																							<div class="modal fade modal-confirm-delete<?php// echo $row->no?>" tabindex="-1" role="dialog" aria-hidden="true">
																								<div class="modal-dialog modal-xs">
																									<div class="modal-content">
																										<div class="modal-header">
																											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
																											<center><h4 class="modal-title" id="myModalLabel"><b>device</b></h4></center>
																										</div>
																										<div class="modal-body">
																											<center><h5><i class="fa fa-warning fa-lg"></i> &nbsp;Do you want to delete this audit plan?</h5></center>
																										</div>
																										<div class="modal-footer">
																											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																											<a href="<?php echo base_url()."report/manage_audit_plan/delete/"; ?>" class="btn btn-danger">Delete</a>
																										</div>
																									</div>
																								</div>
																							</div>
																						</td>
																					<?php //else : ?>
																						<td class="text-center" style="vertical-align: middle;"><b>-</b></td>

																						<td class="text-center" style="vertical-align: middle;">-
																							<!-- <a href="<?php// echo base_url()."report/manage_audit_plan/view/"; ?>" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-folder"></i> View </a>
																							<a href="<?php// echo base_url()."report/manage_audit_plan/revisi/"; ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Revisi </a> -->
																						</td>
																					<?php //endif; ?>
																				</tr>
																			<?php// endforeach; ?>

																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div><!-- /TAB PANEL -->

												<!-- ADD TAB -->
												<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="add-tab">
													<?php
													$form_class = array('id' => 'demo-form2', 'class' => 'form-horizontal form-label-left', 'data-parsley-validate');
													echo form_open('audit_plan/manage_audit_plan/create/', $form_class);
													?>
													<div class="col-md-8 col-xs-12">
														<div class="x_panel">
															<div class="x_content">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-4">Year</label>
																		<div class="col-md-8 col-xs-12">
																			<input type="number" class="form-control" placeholder="e.g. 2016, 2017" name="year" required>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="control-label col-md-4">Auditee Unit</label>
																		<div class="col-md-8 col-xs-12">
																			<select class="form-control" name="auditee_unit" required>
																				<option value="" disabled selected>Select your option</option>
																				<?php foreach ($auditee_unit as $row):?>
																					<?php if ($row->role != "TM"): ?>
																						<option><?php echo $row->unit ?></option>
																					<?php endif; ?>
																				<?php endforeach; ?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="control-label col-md-4">Audit Code</label>
																		<div class="col-md-8 col-xs-12">
																			<select class="form-control" name="audit_code" required>
																				<option value="" disabled selected>Select your option</option>
																				<?php foreach ($code as $row):?>
																						<option><?php echo $row->code." (".$row->type." Audit)" ?></option>
																				<?php endforeach; ?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="control-label col-md-4">Appendix Code</label>
																		<div class="col-md-8 col-xs-12">
																			<input type="number" class="form-control" placeholder="eg. 1" name="appendix" required>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="control-label col-md-4">Visit Date</label>
																		<div class="col-md-8 col-xs-12">
																			<input type="text" name="visit_date" id="visit_date_add" class="form-control" placeholder="e.g. <?php echo date("d-m-Y")." - ". date("d-m-Y"); ?>" />
																		</div>
																	</div>
																</div><!-- DIV COL-MD-6 (1) -->


																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-5 col-sm-3 col-xs-12">Issue No</label>
																		<div class="col-md-7 col-xs-12">
																			<input type="number" name="issue_no" class="form-control" name="issue_no" placeholder="e.g.  0, 1, 2" required>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="control-label col-md-5 col-xs-12">Issued Date</label>
																		<div class="col-md-7 col-xs-12">
																			<input id="issued-date-add" class="date-picker form-control col-md-7" type="text" name="issued_date" placeholder="e.g. <?php echo date("d-m-Y"); ?>" type="text" required>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="control-label col-md-5 col-sm-3 col-xs-12">Issued By</label>
																		<div class="col-md-7 col-xs-12">
																			<select class="form-control" name="issued_by" required>
																				<option value="" disabled selected>Select your option</option>
																				<?php foreach ($issued_by as $row): ?>
																					<?php if($row->position == "Quality Manager") : ?>
																						<option><?php echo $row->name ?></option>
																					<?php endif; ?>
																				<?php endforeach; ?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="control-label col-md-5 col-sm-3 col-xs-12">Approved by</label>
																		<div class="col-md-7 col-xs-12">
																			<input type="text" class="form-control" name="approved_by" placeholder="Name VP Learning Services" required>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="control-label col-md-5 col-sm-3 col-xs-12">Auditor</label>
																		<div class="col-md-7 col-xs-12">
																			<select class="form-control" name="auditor_lapangan" required>
																				<option value="" disabled selected>Select your option</option>
																				<?php foreach ($issued_by as $row): ?>
																					<?php if($row->position == "Quality Manager") : ?>
																						<option><?php echo $row->name ?></option>
																					<?php endif; ?>
																				<?php endforeach; ?>
																			</select>
																		</div>
																	</div>

																</div><!-- /DIV COL-MD-6 (1) -->




															</div><!-- /DIV x_CONTENT -->
														</div><!-- DIV X_PANEL -->
													</div><!-- /DIV COL-MD-8 -->

													<div class="col-md-4 col-xs-12">
														<div class="x_panel">
															<div class="x_content">
																<div class="form-group">
																	<label class="control-label col-md-4">Revisi No</label>
																	<div class="col-md-5 col-xs-12">
																		<input type="number" class="form-control" name="revisi_no" value="0">
																	</div>
																</div>
																<div class="form-group">
																	<label class="control-label col-md-4">TPM Issue</label>
																	<div class="col-md-5">
																		<input type="text" class="form-control" placeholder="e.g. A, B, C" name="tpm_issue" required>
																	</div>
																</div>
																<div class ="form-group">
																	<label class="control-label col-md-4">Description</label>
																	<div class="col-md-8">
																		<textarea class="form-control" rows="4" name="desc" placeholder="Rev : (e.g 0,1,2) [ENTER] Date : (e.g dd-mm yy)" required></textarea>
																	</div>
																</div>

															</div><!-- /DIV X_CONTENT -->
														</div><!-- /DIV  X_PANEL-->
													</div><!-- /DIV COL-MD-4-->

													<div class="col-md-12">
														<div class="x_panel">
															<div class="x_content">
																<div class="form-group">
																	<label class="control-label col-md-2">Audit Requirement</label>
																	<div class="col-md-10">
																		<select class="select2_multiple form-control" multiple="multiple" name="requirement[]" required>
																			<?php foreach ($requirement as $row): ?>
																				<option><?php echo $row->requirement ?></option>
																			<?php endforeach; ?>
																		</select>
																		<p class="control-label"><small>Need help for selecting audit requirement? <a href=<?php echo site_url('help')?> target="_blank"><b>Click here...</b></a></small></p>
																	</div>
																</div>

																<div class="ln_solid"></div>
																<div class="form-group">
																	<div class="col-md-8 col-md-offset-4">
																		<button type="reset" class="btn btn-default">Reset all data</button>
																		<button type="submit" class="btn btn-primary">Create New Audit Plan</button>
																	</div>
																</div>
															</div>
														</div>
													</div><!-- /DIV COL-MD-12 -->
													<?php echo form_close(); ?>
												</div><!-- /TAB PANEL -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /page content -->
			<?php else : ?>
				<!-- page content -->
				<div class="right_col" role="main" style="min-height:690px;">
					<div class="">
						<div class="row">
							<div class="col-md-12">
								<div class="x_panel">
									<div class="x_title">
										<h2><i class="fa fa-bars"></i> <b>AUDIT PLAN</b></h2>
										<div class="clearfix"></div>
									</div>
									<div class="x_content">
										<?php echo $this->session->flashdata('notif'); ?>
										<div class="" role="tabpanel" data-example-id="togglable-tabs">
											<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
												<li role="presentation" class="active"><a href="#tab_content1" id="list-tab" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i> <b>LIST DATA OVERVIEW</b></a>
												</li>
											</ul>
											<div id="myTabContent" class="tab-content">


												<!-- LIST TAB -->
												<div role="tabpanel" class="tab-pane fade <?php if(!isset($edit_data) AND !isset($revisi_data)) echo 'active in';?>" id="tab_content1" aria-labelledby="list-tab">
													<div class="row">
														<div class="x_panel">
															<div class="x_content">
																<div class="col-md-12 col-xs-12">

																	<table id="datatable" class="table table-striped table-bordered">
																		<thead>
																			<tr>
																				<th class="text-center" style="vertical-align: middle;">#</th>
																				<th class="text-center" style="vertical-align: middle;">Audit No</th>
																				<th class="text-center" style="vertical-align: middle;">Planned Week</th>
																				<th class="text-center" style="vertical-align: middle;">Visit Date</th>
																				<th class="text-center" style="vertical-align: middle;">Issued by</th>
																				<th class="text-center" style="vertical-align: middle;">Status</th>
																				<th class="text-center" style="vertical-align: middle; width: 30%;">Action</th>
																			</tr>
																		</thead>


																		<tbody>
																			<?php $inc = 1; ?>
																			<?php foreach ($query as $row): ?>
																				<tr>
																					<td class="text-center" style="vertical-align: middle;"><?php echo $inc; $inc++ ?></td>
																					<td class="text-center" style="vertical-align: middle;"><?php echo $row->audit_plan_no; ?></td>
																					<td class="text-center" style="vertical-align: middle;"><?php echo "Week ".$row->planned_week; ?></td>
																					<?php $temp_date_approved = date("d M Y", strtotime($row->date_approved)); ?>
																					<td class="text-center" style="vertical-align: middle;"><?php echo $temp_date_approved; ?></td>
																					<td class="text-center" style="vertical-align: middle;"><?php echo $row->auditor_name; ?></td>
																					<?php if ($row->is_approved == 0 ) : ?>
																						<td class="text-center" style="vertical-align: middle;"><b>WAITING APPROVAL</b></td>

																						<td class="text-center" style="vertical-align: middle;">
																							<?php if ($sess_position == "Vice President"): ?>
																								<a class="btn btn-dark btn-xs" data-toggle="modal" data-target=".modal-confirm-approve<?php echo $row->no?>"><i class="fa fa-check-square-o"></i> Approve </a>
																							<?php endif; ?>
																							<a href="<?php echo base_url()."report/manage_audit_plan/view/".$row->no; ?>" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-folder"></i> View </a>
																							<div class="modal fade modal-confirm-approve<?php echo $row->no?>" tabindex="-1" role="dialog" aria-hidden="true">
																								<div class="modal-dialog modal-xs">
																									<div class="modal-content">
																										<div class="modal-header">
																											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
																											<center><h4 class="modal-title" id="myModalLabel"><b>Internal Audit 147</b></h4></center>
																										</div>
																										<div class="modal-body">
																											<center><h5><i class="fa fa-warning fa-lg"></i> &nbsp;Do you want to approve this audit plan?</h5></center>
																										</div>
																										<div class="modal-footer">
																											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																											<a href="<?php echo base_url()."report/manage_audit_plan/approve/".$row->no; ?>" class="btn btn-dark">Approve</a>
																										</div>

																									</div>
																								</div>
																							</div>
																						</td>
																					<?php else : ?>
																						<td class="text-center" style="vertical-align: middle;"><b>APPROVED</b></td>

																						<td class="text-center" style="vertical-align: middle;">
																							<a href="<?php echo base_url()."report/manage_audit_plan/view/".$row->no; ?>" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-folder"></i> View </a>
																						</td>
																					<?php endif; ?>
																				</tr>
																			<?php endforeach; ?>

																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div><!-- /TAB PANEL -->


											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /page content -->
			<?php endif ?>


			<!-- footer content -->
			<?php include 'v_footer.php';?>
			<!-- /footer content -->
		</div>
	</div>

	<!-- jQuery -->
	<script src="<?php echo site_url(); ?>/assets/vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo site_url(); ?>/assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo site_url(); ?>/assets/vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="<?php echo site_url(); ?>/assets/vendors/nprogress/nprogress.js"></script>

	<!-- Datatables -->
	<script src="<?php echo site_url(); ?>/assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo site_url(); ?>/assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo site_url(); ?>/assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?php echo site_url(); ?>/assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
	<script src="<?php echo site_url(); ?>/assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
	<script src="<?php echo site_url(); ?>/assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="<?php echo site_url(); ?>/assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="<?php echo site_url(); ?>/assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
	<script src="<?php echo site_url(); ?>/assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
	<script src="<?php echo site_url(); ?>/assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo site_url(); ?>/assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
	<script src="<?php echo site_url(); ?>/assets/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
	<script src="<?php echo site_url(); ?>/assets/vendors/jszip/dist/jszip.min.js"></script>
	<script src="<?php echo site_url(); ?>/assets/vendors/pdfmake/build/pdfmake.min.js"></script>
	<script src="<?php echo site_url(); ?>/assets/vendors/pdfmake/build/vfs_fonts.js"></script>

	<!-- bootstrap-daterangepicker -->
	<script src="<?php echo site_url(); ?>/assets/production/js/moment/moment.min.js"></script>
	<script src="<?php echo site_url(); ?>/assets/production/js/datepicker/daterangepicker.js"></script>

	<!-- Select2 -->
	<script src="<?php echo site_url(); ?>/assets/vendors/select2/dist/js/select2.full.min.js"></script>


	<!-- validator -->
	<script src="<?php echo site_url(); ?>/assets/vendors/validator/validator.min.js"></script>

	<!-- Custom Theme Scripts -->
	<script src="<?php echo site_url(); ?>/assets/build/js/custom.min.js"></script>

	<!-- validator -->
	<script>
      // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
      .on('blur', 'input[required], input.optional, select.required', validator.checkField)
      .on('change', 'select.required', validator.checkField)
      .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
      	validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
      	e.preventDefault();
      	var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
        	submit = false;
        }

        if (submit)
        	this.submit();

        return false;
    });
  </script>
  <!-- /validator -->

  <!-- bootstrap-daterangepicker -->
  <script>
  	$(document).ready(function() {
  		$('#issued-date-add').daterangepicker({
  			singleDatePicker: true,
  			calender_style: "picker_5"
  		}, function(start, end, label) {
  			console.log(start.toISOString(), end.toISOString(), label);
  		});
  	});
  	$(document).ready(function() {
  		$('#issued-date-edit').daterangepicker({
  			singleDatePicker: true,
  			calender_style: "picker_5"
  		}, function(start, end, label) {
  			console.log(start.toISOString(), end.toISOString(), label);
  		});
  	});
  	$(document).ready(function() {
  		$('#issued-date-revisi').daterangepicker({
  			singleDatePicker: true,
  			calender_style: "picker_5"
  		}, function(start, end, label) {
  			console.log(start.toISOString(), end.toISOString(), label);
  		});
  	});
  </script>
  <script>
  	$(document).ready(function() {
  		$('#visit_date_add').daterangepicker(null, function(start, end, label) {
  			console.log(start.toISOString(), end.toISOString(), label);
  		});
  	});
  	$(document).ready(function() {
  		$('#visit_date_edit').daterangepicker(null, function(start, end, label) {
  			console.log(start.toISOString(), end.toISOString(), label);
  		});
  	});
  	$(document).ready(function() {
  		$('#visit_date_revisi').daterangepicker(null, function(start, end, label) {
  			console.log(start.toISOString(), end.toISOString(), label);
  		});
  	});
  </script>
  <!-- /bootstrap-daterangepicker -->


  <!-- Select2 -->
  <script>
  	$(document).ready(function() {
  		$(".select2_multiple").select2({
  			maximumSelectionLength: 99,
  			placeholder: " Select audit requrement",
  			allowClear: true
  		});
  	});
  </script>
  <!-- /Select2 -->

  <!-- Datatables -->
  <script>
  	$(document).ready(function() {
  		$('#datatable').dataTable();
  		TableManageButtons.init();
  	});
  </script>
  <!-- /Datatables -->

</body>
</html>
