<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                    	
                    				<img alt="image" class="img-circle" src="<?php echo $this->config->base_url(); ?>r/images/event.png" style="width:40px;height:50px;"/>

                             </span>
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->session->userdata("username"); ?></strong>
                             </span> 
                             <span class="text-muted text-xs block"><?php echo $this->session->userdata("user_type_front_name");?></span> </span> 
                    </div>
                    <div class="logo-element">
                        <span>Ecommerce</span>
                    </div>
                </li>
                <li class="<?php if($permission=='dashboard')echo 'active'?>">
                <li class="<?php if($name=='view' && $type=='dashboard')echo 'active'?>">
					<a href="<?php echo $this->config->base_url();?>dashboard/view"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
				</li>
				
				<!--
				 <li class="<?php if($permission=='subjects')echo 'active'?>">
									<a href=""><i class="glyphicon glyphicon-heart"></i> <span class="nav-label">shoes </span> <span class="fa arrow"></span></a>
									<ul class="nav nav-second-level">
										<li class="<?php if($name=='view' && $type=='subjects')echo 'active'?>"><a href="<?php echo $this->config->base_url(); ?>subjects/view">View shoes</a></li>
																				 <li class="<?php if($name=='add' && $type=='subjects')echo 'active'?>"><a href="<?php echo $this->config->base_url(); ?>subjects/add">Create shoes</a></li>
																		
				    </ul>
                    
                </li>
                 -->
                <li class="<?php if($permission=='content') {echo "active"; }?>">
                    <a class="lic"><i class="glyphicon glyphicon-list-alt"></i> <span class="nav-label">Vendors</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($type=='vendors' && $name=='view') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>vendors/view">View vendors</a></li>
                        <li class="<?php if($type=='vendors' && $name=='add') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>vendors/add">Create vendors</a></li>
                   
                    </ul>
                </li>      

<!--
					 <li class="<?php if($permission=='vendors') {echo "active"; }?>">
                    <a class="lic"><i class="fa fa-adn"></i> <span class="nav-label">vendors1</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                    <li class="<?php if($type=='vendors' && $name=='view') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>vendors1/view">View vendors1</a></li>
                    <li class="<?php if($type=='vendors' && $name=='add') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>vendors1/add">Create vendors1</a></li>
                   </ul>
                	</li>      

				<li class="<?php if($permission=='diesel') {echo "active"; }?>">
                    <a class="lic"><i class="fa fa-user"></i> <span class="nav-label">Diesel</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($name=='view' && $type=='diesel') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>diesel/view">View Diesel</a></li>
                
                        <li class="<?php if($name=='add' && $type=='diesel') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>diesel/add">Add Diesel</a></li>
                    </ul>
                </li>
				
				<li class="<?php if($permission=='oil') {echo "active"; }?>">
                    <a class="lic"><i class="fa fa-users"></i> <span class="nav-label">Oil</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($name=='view' && $type=='oil') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>oil/view">View Oil</a></li>
                
                        <li class="<?php if($name=='users' && $type=='oil') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>oil/add">Add Oil</a></li>
                  		
               	  
                    </ul>
                </li>
              
               <li class="<?php if($permission=='categories') {echo "active"; }?>">
                    <a class="lic"><i class="glyphicon glyphicon-asterisk"></i> <span class="nav-label">Categories</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($type=='categories' && $name=='view') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>categories/view">View Categories</a></li>
                        <li class="<?php if($type=='categories' && $name=='add') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>categories/add">Create Category</a></li>
                    </ul>
                </li>
                 <li class="<?php if($permission=='Wax') {echo "active"; }?>">
                    <a class="lic"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Wax</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($type=='Wax' && $name=='view') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>wax/view">View Wax</a></li>
                        <li class="<?php if($type=='Wax' && $name=='add') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>wax/add">Create Wax</a></li>
                    </ul>
                </li>
               <li class="<?php if($permission=='napalm') {echo "active"; }?>">
                    <a class="lic"><i class="glyphicon glyphicon-th-list"></i> <span class="nav-label">napalm</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($type=='napalm' && $name=='view') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>napalm/view">View napalm</a></li>
                        <li class="<?php if($type=='napalm' && $name=='add') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>napalm/add">Create napalm</a></li>
                    </ul>
                </li>  
                 <li class="<?php if($permission=='naptha') {echo "active"; }?>">
                    <a class="lic"><i class="glyphicon glyphicon-envelope"></i> <span class="nav-label">naptha</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($type=='naptha' && $name=='view') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>naptha/view">View naptha</a></li>
                        <li class="<?php if($type=='naptha' && $name=='add') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>naptha/add">Create naptha</a></li>
                    </ul>
                </li>
                 <li class="<?php if($permission=='petroleum_jelly') {echo "active"; }?>">
                    <a class="lic"><i class="fa fa-cog"></i> <span class="nav-label">petroleum_jelly</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($type=='petroleum_jelly' && $name=='view') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>petroleum_jelly/view">View petroleum_jelly</a></li>
                        <li class="<?php if($type=='petroleum_jelly' && $name=='add') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>petroleum_jelly/add">Create petroleum_jelly</a></li>
                   
                    </ul>
                </li>  
                 <li class="<?php if($permission=='napthalene') {echo "active"; }?>">
                    <a class="lic"><i class="fa fa-edit"></i> <span class="nav-label">napthalene</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($type=='napthalene' && $name=='view') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>napthalene/view">View napthalene</a></li>
                        <li class="<?php if($type=='napthalene' && $name=='add') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>napthalene/add">Create napthalene</a></li>
                    </ul>
                </li> 
                 <li class="<?php if($permission=='stokiest') {echo "active"; }?>">
                    <a class="lic"><i class="fa fa-chevron-circle-right"></i> <span class="nav-label">stokiest</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($type=='stokiest' && $name=='view') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>stokiest/view">View stokiest</a></li>
                        <li class="<?php if($type=='stokiest' && $name=='add') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>stokiest/add">Create stokiest</a></li>
                    </ul>
                </li> 
                 <li class="<?php if($permission=='consultants') {echo "active"; }?>">
                    <a class="lic"><i class="fa fa-chevron-circle-left"></i> <span class="nav-label">consultants</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($type=='consultants' && $name=='view') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>consultants/view">View consultants</a></li>
                        <li class="<?php if($type=='consultants' && $name=='add') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>consultants/add">Create consultants</a></li>
                    </ul>
                </li> 
                 <li class="<?php if($permission=='manufactures') {echo "active"; }?>">
                    <a class="lic"><i class="fa fa-chevron-circle-down"></i> <span class="nav-label">manufactures</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($type=='manufactures' && $name=='view') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>manufactures/view">View manufactures</a></li>
                        <li class="<?php if($type=='manufactures' && $name=='add') {echo "active"; }?>"><a href="<?php echo $this->config->base_url() ?>manufactures/add">Create manufactures</a></li>
                    </ul>
                </li> 
                -->
                            </ul>

        </div>
    </nav>