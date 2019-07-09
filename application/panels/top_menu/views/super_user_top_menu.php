        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <!-- <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form> -->
        </div>
            <ul class="nav navbar-top-links navbar-right">
               <li>
               	<a href="<?php echo $this->config->base_url(); ?>home">Back To Home</a>
               </li>
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to Twelve For Twelve <?php echo $this->session->userdata('user_type_front_name'); ?> Dashboard.</span>
                </li>
                


              <!--
                <li>
                                  <a href="<?php echo $this->config->base_url(); ?>login_content/logout">
                                      <i class="fa fa-sign-out"></i> Log out
                                  </a>
                              </li>
              -->
                            </ul>

        </nav>
        </div>