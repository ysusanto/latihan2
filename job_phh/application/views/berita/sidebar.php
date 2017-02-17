<!-- sidebar menu -->
					<div class="span2">
						<ul class="nav nav-list"><!-- menu with icon -->
							<li class="nav-header">
								Menu Template Admin
							</li>
							<?php if($this->uri->segment(2) == "berita" || $this->uri->segment(2) == "tambah_berita" || $this->uri->segment(2) == "submit_tambah_berita" || $this->uri->segment(2) == "edit_berita" || $this->uri->segment(2) == "kategori_berita" || $this->uri->segment(2) == "submit_edit_berita" || $this->uri->segment(2) == "edit_kategori_berita" || $this->uri->segment(2) == "submit_edit_kategori_berita" || $this->uri->segment(2) == "submit_tambah_kategori" ) { ?>
							<li class="active">
							<?php }else{ ?>
							<li >
							<?php } ?>
								<a href="<?php echo base_url(); ?>administrator/berita">
									<i class="icon-list-alt"></i> Berita
								</a>
							</li>
							<?php if($this->uri->segment(2) == "banner" || $this->uri->segment(2) == "submit_tambah_banner") {?>
								<li class="active">
							<?php }else{ ?>
								<li >
							<?php } ?> 
								<a href="<?php echo base_url(); ?>administrator/banner">
									<i class="icon-picture"></i> Banner
								</a>
							</li>
							<?php if($this->uri->segment(2) == "profil" || $this->uri->segment(2) == "submit_edit_profil") {?>
								<li class="active">
							<?php }else{ ?>
								<li >
							<?php } ?> 
								<a href="<?php echo base_url(); ?>administrator/profil/profil">
									<i class="icon-globe"></i> Profil
								</a>
							</li>
							<?php if($this->uri->segment(2) == "contact_us") {?>
								<li class="active">
							<?php }else{ ?>
								<li >
							<?php } ?>
								<a href="<?php echo base_url(); ?>administrator/contact_us/">
									<i class="icon-comment"></i> Contact Us
								</a>
							</li>
							
						</ul><!-- end menu with icon -->
						<hr />
					</div>
					<!-- sidebar menu -->