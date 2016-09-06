<?php
	$warning = "dd";
	include 'header.php';
	include 'function/project.php';
	if(session_id() == '') {
		session_start();
}
?>
<div class="row">
	<div class="small-12 columns text-center">
		<h2>"Project name" details</h2>
		<br>
	</div>
</div>
<div class="row">
	<div class="small-2 columns">
		<a href="#" class="button">Project Details</a>
		<a href="#" class="button">Volunteers</a>
		<a href="#" class="button">VWOs</a>
	</div>
	<div class="small-10 columns">
		<div class="panel">
			<div class="row">
				<div class="small-12 columns">
					<div class="text-right">
						<p><span class="textunderline textbold">20</span> people applied for this event</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="small-3 columns">
					<p>
						<span>" </span><span class="required">" Denotes mandatory field</span>
					</p>
					<div class="clearfix"></div>
				</div>
				<div class="small-9 columns"></div>
				<div class="clearfix"></div>
				<div class="small-3 columns"><p>Event Name: </p></div>
				<div class="small-9 columns">Lorem ipsum dolor sit amet.</div>
				<div class="clearfix"></div>
				
				<div class="small-3 columns"><p>Start Date: </p></div>
				<div class="small-9 columns">Lorem ipsum dolor sit amet.</div>
				<div class="clearfix"></div>
				
				<div class="small-3 columns"><p>End Date: </p></div>
				<div class="small-9 columns">Lorem ipsum dolor sit amet.</div>
				<div class="clearfix"></div>
				
				<div class="small-3 columns"><p>Project Detail: </p></div>
				<div class="small-9 columns">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, odit mollitia! Corporis repudiandae iste, nam dolorem facilis, in quae fuga culpa accusantium aliquid dolores, optio necessitatibus amet praesentium nostrum nihil libero magni alias reiciendis qui dicta eos, exercitationem quibusdam voluptatum a. At vitae nam iure, sequi et sit, perspiciatis ut quas harum, veniam debitis. Quis dignissimos, possimus sunt. Assumenda reiciendis ab officia atque odio inventore, earum commodi! Veniam odio nulla obcaecati ullam exercitationem. Laborum, accusamus, magni blanditiis fugit hic ducimus doloremque atque, ut voluptate explicabo, esse? Odit saepe unde tempore ad natus culpa, illo rem ut quas animi omnis, ratione.
					</p>
				</div>
				<div class="clearfix"></div>
				
				<div class="small-3 columns"><p>Roles/Skills needed: </p></div>
				<div class="small-9 columns">Lorem ipsum dolor sit amet.</div>
				<div class="clearfix"></div>
				
				<div class="small-3 columns"><p>Manpower needed: </p></div>
				<div class="small-9 columns">Lorem ipsum dolor sit amet.</div>
				<div class="clearfix"></div>
				
				<div class="small-3 columns"><p>Estimated VXP Gain: </p></div>
				<div class="small-9 columns">Lorem ipsum dolor sit amet.</div>
				<div class="clearfix"></div>
				
				<div class="small-3 columns"><p># of CP Awarded: </p></div>
				<div class="small-9 columns">Lorem ipsum dolor sit amet.</div>
			</div>
		</div>
		
		<div class="panel">
			<h3>Application Form</h3>
			<p><label>Desired role/position in project: !DROPDOWN HERE!</label></p>
			<label>
				<textarea name="applicationmsg" placeholder="In a few sentences, let the VWO know why you are right for this job."></textarea>
			</label>
		</div>
	</div>
</div>