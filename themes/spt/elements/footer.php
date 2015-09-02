<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<footer id="bottom" class="footer">
	<div class="container-fluid">
		<div class="section row">
			<?php
				$a = new GlobalArea('Map Footer');
				$a->display();
			?>
		</div>
		<div class="section row">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2" style="margin-top: 30px; margin-bottom: 15px;">
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-sm-offset-1">
						<?php
							$a = new GlobalArea('Address');
							$a->display();
						?>
						</div>
						<div class="col-xs-12 col-sm-7">
						<?php
							$a = new GlobalArea('Contact Form');
							$a->display();
						?>
						</div>
					</div>
				</div>
			</div>
			<div class="section row conquered_footerwrapper">
				<div class="col-xs-12 col-sm-8 col-sm-offset-2">
					<div class="col-xs-12 col-sm-6">
						<p class="pull-left">Copyright &copy; <?php echo date("Y") ?> Shelbyville Physical Therapy & Spine Care Center, P.S.C.</p>
					</div>
					<div class="col-xs-12 col-sm-6">
						<p class="pull-right">Website Designed by <a href="http://www.dazeysolutions.com">Dazey Solutions</a>.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
