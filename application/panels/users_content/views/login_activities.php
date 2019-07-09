
<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>All Users Record</h5>
                        </div>
                        <div class="ibox-content">
						<form method="post" action="<?php echo $this->config->base_url()?>user/activities/search">
							<div class="col-sm-3">
								<div class="form-group">
									<input type="text" id="login_name_search" value="<?php echo $this->session->userdata('login_name');?>" name="login_name_search" placeholder="Name" class="form-control" >
							
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<select name="status_search" id="status_search" class="form-control">
										<option  selected value="">Select Login Attempt status</option>
										<option value="Success" <?php if($this->session->userdata('login_status')=="Success"){echo "SELECTED";}?>>Success</option>
										<option value="Failure" <?php if($this->session->userdata('login_status')=="Failure"){echo "SELECTED";}?>>Failure</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary"  value="Search"/>
							</div>
						</form>
	
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                <thead>
                                <tr>
                                    <th data-toggle="true">User Name</th>
                                    <th>Login Date And Time</th>
                                    <th data-hide="all">User IP Address</th>
                                    <th data-hide="all">Login Attempt Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($result)){
									foreach ($result as $key) { ?>
                                <tr>
                                    <td><?php echo $key->user_name; ?></td>
                                    <td><?php echo $key->login_activities_loggedin_datetime; ?></td>
                                    <td><?php echo $key->login_activities_ip; ?></td>
                                    <td><?php echo $key->login_attempt_status; ?></td>
                                </tr>
                                <?php }
									}
								else{ ?>
										<tr>
											<td align="center" colspan="4"><b><?php echo "No Record Found"; ?></b></td>
										</tr>
										
								<?php }?>
                                </tbody>
                                <tfoot>
                               <?php if( isset($result) && ($result!='')){ ?>
                             
                                <tr>
                                    <td colspan="5">
                                        <div class="pagination_ci" style="float:right;"> <?php echo $paginglinks; ?></div>
										<div class="pagination_ci" style="float:left;"> <?php echo (!empty($pagermessage) ? $pagermessage : ''); ?></div>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            