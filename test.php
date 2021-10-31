<?php
function add_feedback ($key,$value,$f_id){
		$s_id = wp_insert_post(array(
			'post_status' => 'publish',
			'post_type' => 'feed-skill',
			'post_title' => $_POST[$key.'-name'],
			'post_parent' => $f_id
		));
		update_post_meta($s_id,'skill-name',$key);
		update_post_meta($s_id,'level',$_POST['level'][$key]);
		foreach($value as $ak => $args)
		{
			
			$a_id = wp_insert_post(array(
				'post_status' => 'publish',
				'post_type' => 'feed-argument',
				'post_title' => $_POST[$key.'-argument'][$ak],
				'post_parent' => $s_id
			));
			foreach($args as $secs)
			{
				$se_id = wp_insert_post(array(
					'post_status' => 'publish',
					'post_type' => 'feed-section',
					'post_parent' => $a_id
				));
				
				foreach($secs as $q => $ans)
				{
					$an_id = wp_insert_post(array(
						'post_status' => 'publish',
						'post_type' => 'feed-answer',
						'post_parent' => $se_id
					));
					
					update_post_meta($an_id,'question_id', $q);
					update_post_meta($an_id,'option_id', $ans);
				}
			}
		}
	}
if(isset($_POST['submit']))
{
	
	$student_id = isset($_POST['student_id'])?$_POST['student_id']:'';
	$course_id = isset($_POST['course_id'])?$_POST['course_id']:'';
	$feedback_id = isset($_POST['feed_id'])?$_POST['feed_id']:'';
	$feedData['course_meta'] = isset($_POST['course_meta'])?$_POST['course_meta']:'';
	$instructor_id = isset($_POST['instructor_id'])?$_POST['instructor_id']:'';
	$feedData['feedback_date'] = isset($_POST['feedback_date'])?$_POST['feedback_date']:'';

	$feedData['name'] = isset($_POST['name'])?$_POST['name']:'';
	$grade = isset($_POST['grade'])?$_POST['grade']:'';
	$feedData['assessment_name'] = isset($_POST['assessment_name'])?$_POST['assessment_name']:'';
// 	echo '<pre>';
// 		print_r($_POST);
// 	echo '</pre>';
// 	die;
	$f_id = wp_insert_post(array(
		'post_type' => 'feedbacks',
		'post_status' => 'publish',
		'post_title' => $_POST['assessment_name'],
	));
	update_post_meta($f_id,'student_id',$student_id);
	update_post_meta($f_id,'course_id',$course_id);
	update_post_meta($f_id,'feedback_id',$feedback_id);
	update_post_meta($f_id,'grade',$grade);
	update_post_meta($f_id,'instructor_id',$instructor_id);
	
	if(isset($_POST['claim-warrant-impact']) && isset($_POST['claim-warrant-impact-checkbox']))
	{
		add_feedback ('claim-warrant-impact', $_POST['claim-warrant-impact'],$f_id);
	}
	if(isset($_POST['consequentialist-weighing']) && isset($_POST['consequentialist-weighing-checkbox']))
	{
		add_feedback ('consequentialist-weighing', $_POST['consequentialist-weighing'],$f_id);
	}
	if(isset($_POST['resolution-burdens']) && isset($_POST['resolution-burdens-checkbox']))
	{
		add_feedback ('resolution-burdens', $_POST['resolution-burdens'],$f_id);
	}
	
	
	if(isset($_POST['collapsing']) && isset($_POST['collapsing-checkbox']))
	{
		add_feedback ('collapsing', $_POST['collapsing'],$f_id);
	}
	if(isset($_POST['critical-reading']) && isset($_POST['critical-reading-checkbox']))
	{
		add_feedback ('critical-reading', $_POST['critical-reading'],$f_id);
	}
	if(isset($_POST['defense']) && isset($_POST['defense-checkbox']))
	{
		add_feedback ('defense', $_POST['defense'],$f_id);
	}
	
	if(isset($_POST['dismantling']) && isset($_POST['dismantling-checkbox']))
	{
		add_feedback ('dismantling', $_POST['dismantling'],$f_id);
	}
	if(isset($_POST['hijacking']) && isset($_POST['hijacking-checkbox']))
	{
		add_feedback ('hijacking', $_POST['hijacking'],$f_id);
	}
	if(isset($_POST['layering']) && isset($_POST['layering-checkbox']))
	{
		add_feedback ('layering', $_POST['layering'],$f_id);
	}
	
	if(isset($_POST['offense']) && isset($_POST['offense-checkbox']))
	{
		add_feedback ('offense', $_POST['offense'],$f_id);
	}
	if(isset($_POST['research']) && isset($_POST['research-checkbox']))
	{
		add_feedback ('research', $_POST['research'],$f_id);
	}
	if(isset($_POST['signposting']) && isset($_POST['signposting-checkbox']))
	{
		add_feedback ('signposting', $_POST['signposting'],$f_id);
	}
	if(isset($_POST['warrant-comparison']) && isset($_POST['warrant-comparison-checkbox']))
	{
		add_feedback ('warrant-comparison', $_POST['warrant-comparison'],$f_id);
	}
	
	if(isset($_POST['old-feed']))
	{
		$wpdb->update( 'wp_posts', array( 'post_status' => 'update' ), array( 'post_parent' => $_POST['old-feed'] ) );
		$wpdb->update( 'wp_posts', array( 'post_status' => 'update' ), array( 'ID' => $_POST['old-feed'] ) );
	}
	

	echo 'Submited';
	?>
	<script>
		location.href = 'https://dialectree.com/wp-admin/edit.php?post_type=sfwd-assignment';
	</script>
	<?php
	exit();
// 	die;
}
$user = get_userdata($user_id)->data;
// $_SESSION['feed_submited'] = 'true';
?>
<style>
      body{
        font-size:13px
      }
      .subelements{
        background:#fff !important;
		  border-bottom:1px solid #ccc;
      }
	  .sub-elements:nth-child(even){
        background:#f8f8f8 !important;
      }
    </style>
<h2 class="font-weight-bold mb-3">
	Debate Feedback Form
</h2>

<?php 
$grade = '';
if(isset($_GET['action']) && $_GET['action'] == 'edit') { 
	$feed = isset($_GET['feed'])?$_GET['feed']:0;
	$grade = get_post_meta($feed,'grade',1);
 } ?>

<style>
      body{
        font-size:13px
      }
      .subelements{
        background:#fff;
		border-bottom:1px solid #ccc;
      }
	  .sub-elements:nth-child(even){
        background:#f8f8f8 !important;
      }
    </style>
<form action="" method="POST">
	<input type="hidden" name="student_id" value="<?php echo $user_id ?>">
	<input type="hidden" name="course_id" value="<?php echo $course_id ?>">
	<input type="hidden" name="course_meta" value="<?php echo 'course_completed_'.$course_id ?>">
	<input type="hidden" name="instructor_id" value="<?php echo get_current_user_id() ?>">
	<input type="hidden" name="feed_id" value="<?php echo $course_id ?>">
	<div class="cmf-row">

		<div class="cmf-col-lg-12">
			<div class="border shadow p-4">
				<div class="cmf-row">
					<div class="cmf-col-sm-6">
						<div class="form-group">
							<label><b>Student's Name</b></label>
							<input type="text" readonly name="name" class="form-control" placeholder="First" required value="<?=$user->display_name?>">
						</div>
					</div>
					<div class="cmf-col-sm-6">
						<div class="form-group">
							<label><b>Feedback Date</b></label>
							<input type="date" name="feedback_date" class="form-control" value="<?php echo date('Y-m-d')?>" required>
						</div>
					</div>
					<div class="cmf-col-sm-6">
						<div class="form-group">
							<label><b>Assessment Title</b></label>
							<input type="text" name="assessment_name" value="<?php echo get_the_title($feed)?>" class="form-control" placeholder="Assessment Title" required>
						</div>
					</div>
					<div class="cmf-col-sm-6">
						<div class="form-group">
							<label for=""><b>Assessment Grade</b></label><br>
							<input type="text" name="grade" value="<?php echo $grade?>">
						</div>
					</div>
					
					<div class="cmf-col-sm-12">
						<label ><b>Which Rubric do you want to apply?</b></label><br>
						
<!-- 						<input type="checkbox" data-type="claim-warrant-impact" name="claim-warrant" data-has="subelement" id="claim-warrant" class="apply-rubric">
						<label for="claim-warrant"> Claim-Warrant-Impact</label>
						
						<input type="checkbox" data-type="warrant-comparison" name="warrant-comparison" data-has="subelement" id="warrant-comparison" class="apply-rubric">
						<label for="warrant-comparison"> Warrant Comparison</label>
						
						<input type="checkbox" data-type="consequentialist-weighing"name="consequentialist-weighing" data-has="subelement" id="consequentialist" class="apply-rubric">
						<label for="consequentialist"> Consequentialist Weighing</label>
						
						<input type="checkbox" data-type="topicality"name="topicality" data-has="" id="topicality" class="apply-rubric">
						<label for="topicality"> Topicality - Writing &amp; Reading</label>
						
						<input type="checkbox" data-type="resolution-burdens"name="resolution-burdens" data-has="" id="resolution-burdens" class="apply-rubric">
						<label for="resolution-burdens"> Resolution Burderns</label> -->
						
						<?php 
						
	$skills = get_categories(array('taxonomy'=> 'assigned-section','hide_empty'      => false));
		   foreach($skills as $k => $v)
		   {
			   $args = array(
				   'post_type' => 'feed-skill',
				   'post_status' => 'publish',
				   'author'	=> array('1,'.get_current_user_id()),
				   'post_parent' => $feed,
				   'posts_per_page' => 1,
				   'meta_key' => 'skill-name',
				   'meta_value' => $v->slug,
				   'order' =>'DESC'
			   );
			   $skill = get_posts($args)[0];
			   if($skill && $feed)
			   {
				   $checked = 'checked';
			   }
			   else{
				   $checked = '';
			   }
			   ?>
						<input type="checkbox" <?php echo $checked?> data-type="<?php echo $v->slug?>" data-id="<?php echo $v->term_id?>" name="<?php echo $v->slug?>-checkbox" data-has="subelement" id="<?php echo $v->slug?>_field" class="apply-rubric">
						<label for="<?php echo $v->slug?>_field"><?php echo $v->name?></label>
						<?php
		   }
						
						?>
					</div>
				</div>

				<!-- Argument section -->


				<?php 

// 				$skills = array('claim-warrant-impact','warrant-comparison','consequentialist-weighing','topicality','resolution-burdens');
		   		foreach($skills as $skil){
					$skill_name = $skil->slug;

			   // 						$skill_name = get_post_meta($skill->ID,'skill-name',1);
				?>
				<section id="<?php echo $skill_name ?>-section" class="skill-section" data-type="<?php echo $skill_name ?>" style="display:none">
					<hr style="border:1px solid #000">
					<div class="">
						<h3>SKILL: <?php echo ucwords(str_replace('-',' ',$skill_name))?></h3>
						<div class="<?php echo $skill_name ?>-argument">
							<?php
							 if($feed)
							 {
								 echo '<input type="hidden" name="old-feed" value="'.$feed.'">';
								 $args = array(
									'post_type' => 'feed-skill',
									'post_status' => 'publish',
									'author'	=> array('1,'.get_current_user_id()),
									'post_parent' => $feed,
									'posts_per_page' => 1,
									'meta_key' => 'skill-name',
									'meta_value' => $skill_name,
									'order' =>'DESC'
								);
								$skill = get_posts($args)[0];
							 
							$args = array(
								'post_type' => 'feed-argument',
								'post_status' => 'publish',
								'post_parent' => $skill->ID,
								'order'	=> 'ASC'
							);
							
							$arguments = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type = 'feed-argument' AND post_status = 'publish' AND post_parent = $skill->ID");
							foreach($arguments as $ak => $arg){ ?>
								
								<div class="p-3 subelements " id="arg-<?=$ak?>">
								  	<h4 class="mt-1 mb-3">This is applying <input type="text" readonly value="<?=ucwords(str_replace('-',' ',$skill_name))?>" data-argument="<?=$ak?>" id="argument_name-<?=$ak?>" name="<?=$skill_name?>-name" > to <input type="text" data-argument="<?=$ak?>" value="<?php echo get_the_title($arg->ID)?>" name="<?=$skill_name?>-argument[]" id="assignment_name-<?=$ak?>"></h4>
									<hr>
									<div class="cmf-row">
										<?php 
									$args = array(
										'post_type' => 'feed-section',
										'post_status' => 'publish',
										'post_parent' => $arg->ID
									);
									$sections = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type = 'feed-section' AND post_status = 'publish' AND post_parent = $arg->ID");
									foreach($sections as $sk => $sec){ ?>
										<div class="sub-elements cmf-col-12">	
										<?php 
										$args = array(
											'post_type' => 'feed-answer',
											'post_status' => 'publish',
											'post_parent' => $sec->ID
										);
										$answers = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type = 'feed-answer' AND post_status = 'publish' AND post_parent = $sec->ID");
										foreach($answers as $k => $ans){
											$total = sizeof($answers);
											$ans_id = get_post_meta($ans->ID,'question_id',1);?>	
											<div class="cmf-col-12 question" data-old="0">
												<h4 class="">Q.: <?php echo get_the_title($ans_id)?></h4>
												<div class="cmf-row mx-4">
													<?php 
													$o_args = array(
														'post_type' => 'fd-questions-options',
														'meta_query' => array(
															'relation' => 'AND',
																array(
																	'key'       => 'assigned-question',
																	'value'     => $ans_id,
																	'compare'   => '=',
																),
															),
															'post_status' => 'publish',
															'orderby' 	=> 'post_date',
															'order' 	=> 'ASC'
														);

														$options = $wpdb->get_results("SELECT * FROM wp_posts as p INNER JOIN wp_postmeta as m ON (m.post_id = p.ID) WHERE p.post_type = 'fd-questions-options' AND p.post_status = 'publish' AND m.meta_key = 'assigned-question' AND m.meta_value = $ans_id");
														$output ='';
														foreach($options as $option)
														{
															
															$checked = '';
															if($option->ID == get_post_meta($ans->ID,'option_id',1))
															{
																$checked = 'checked';
															}
															$minus = false;
															$o_level =0;
															$level = get_post_meta($option->ID,'level',1);
															if($level == 1)
															{
																$o_level = $level/$total;
															}
															else{
																$minus = true;
															}
															$output .= '<div class="cmf-col-sm-6 mb-1">';
															$output .= '<input required type="radio" value="'.$option->ID.'" data-skill="'.$skill_name.'" data-que="'.$ans_id.'-'.$ak.'" class="option radio-input '.(($minus)?'minus':'').'" data-argument="'.$ak.'" name="'.$skill_name.'['.$ak.']['.+$sk.']['.$ans_id.']" data-level="'.$o_level.'" '.$checked.' data-feedback="'.$option->post_content.'">';
															$output .= '<label for="option-'.$option->ID.'">'.$option->post_title.'</label>';
															$output .= '</div>';					
														}
													echo $output;
													?>
												</div>
											</div>
										<?php }?>
										</div>
									<?php } ?>
								</div>
							</div>
							<?php } }?>				   
						</div>
							
						<button type="button" data-type="<?php echo $skill_name ?>" data-id="<?php echo $skil->term_id ?>" id="add-claim-warrant" data-arg="1" class="button-primary my-3 add-arguments">
							Add Argument
						</button>
						
						<hr>
						<!--CWI -->
						<div class="my-2">
							<div class="cmf-row">
								<div class="cmf-col-12">
									<label for=""><b>Feedback for Student</b></label><br>
									<div class="form-group"><textarea rows="5" id="<?php echo $skill_name ?>-feedback" name="argument[0][critical]" id="" class="form-control"></textarea></div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for=""><b><?php echo ucwords(str_replace('-',' ',$skill_name))?> Level</b></label><br>
							<input type="text" name="level[<?php echo $skill_name ?>]" value="" id="<?php echo $skill_name ?>-overall-level">
						</div>
					</div>
				</section>
				<?php } ?>
					

				

				<script>
					var ajax_object = {"ajax_url":"https:\/\/dialectree.com\/wp-admin\/admin-ajax.php"};
					function get_feeds(skill='claim-warrant-impact')
					{
// 						console.log(skill);
						var feeds = [];
						var opt_feed ="";
						var sub_ele = jQuery("#"+skill+"-section .subelements");
						var level = 0.0;
						sub_ele.each(function(i){

							var arg = jQuery(this);
							var argument_name = arg.find("#argument_name-"+i).val();
							var assignment_name = arg.find("#assignment_name-"+i).val();
							var arg_value = "This is applying "+argument_name+" to "+assignment_name+"\n\n";
							var valuess = "";
							arg.find("input:checked" ).each(function( index ) {
								
								if(jQuery(this).data("feedback").length >1)
								{
									valuess += jQuery(this).data("feedback")+"\n\n";
								}
								level = level + parseFloat(jQuery(this).data('level'));
							});
							
							feeds[i] = arg_value + valuess;
						})
// 								console.log(feeds)
						jQuery("#"+skill+"-feedback").val(feeds);
						if(level>0)
						{
							level = level / (sub_ele.length);
						}
						jQuery('#'+skill+'-overall-level').val(level.toFixed(1));
					}
					var overall = 0;
					function fetch_questions(id,skill,arg)
					{
						var data = {
							'action'  : 'get_feedback_questions',
							'id'      : id,
							'skill'		: skill,
							'arg'		: arg,
						};
// 						console.log(data);
						jQuery.ajax({
							type: 'POST',
							url: ajax_object.ajax_url,
							data: data,
							success: function(res) {
								console.log(res);
								jQuery('.'+skill+'-argument').append(res)
								// 									jQuery('#'+skill+'-section').slideToggle('fast');
							}
						});
					}
				</script>
				<script>
					var out = {};
					var claim_warrant_impact_total = 5;
					jQuery(document).on('change', '.option', function(e){
						var skill = jQuery(this).data('skill');
// 						var total = parseInt(jQuery('#'+skill+'-overall-level').val());
						get_feeds(skill);
						
						
// 						out[jQuery(this).data('que')]	= jQuery(this).data('level');
						
// 						jQuery.each(out, function(k,v){
// 							total = total + v;
// 						})
						
// 						jQuery('#'+skill+'-overall-level').val(total.toFixed(1));
					})
					jQuery(document).ready(function(){
						
						
// 						get_feeds();
						jQuery('.apply-rubric').each(function(){
							var skill = jQuery(this).data('type');
							var id = jQuery(this).attr('id');
							if(jQuery(this).prop("checked") == true)
							{
								get_feeds(skill);
								jQuery('#'+skill+'-section').slideDown('fast');
								if(jQuery('#'+skill+'-section .subelements').length == 0)
								{
									fetch_questions(jQuery(this).data('id'),skill,0);
								}
							}
							else
							{
								jQuery('#'+skill+'-section').slideUp('fast');
							}
						})
						

						jQuery('.apply-rubric').change(function(){
							var id = jQuery(this).attr('id');
							var skill = jQuery(this).data('type');
							if(jQuery(this).prop("checked") == true)
							{
								jQuery('#'+skill+'-section').slideDown('fast');
								if(jQuery('#'+skill+'-section .subelements').length == 0)
								{
									fetch_questions(jQuery(this).data('id'),skill,0);
								}
							}
							else
							{
								jQuery('#'+skill+'-section').slideUp('fast');
							}
							 
						});

						jQuery('.add-arguments').click(function(){
							var id = jQuery(this).attr('id');
							var skill = jQuery(this).data('type');
							var elements = jQuery('#'+skill+'-section .subelements').size();
							fetch_questions(jQuery(this).data('id'),skill,elements)
						})
					})
					
					
					
					
					
					// $('#claim-warrant-section').hide();
					// 					jQuery('.apply-rubric').on('change', function(){
					// 						const section = jQuery(this).attr('id');
					// 						jQuery('#'+section+'-section').slideToggle();
					// 					});
					jQuery(document).ready(function(){
// 						jQuery('#add-claim-warrant').click();
						jQuery('#add-warrant-comparison').click();
						jQuery('#add-consequentialist-argument').click();
						jQuery('.apply-rubric').click(function(){
							var id = jQuery(this).attr('id')
							jQuery('#'+id+'-section').slideToggle();
						})
					})

// 					jQuery('#add-claim-warrant').on('click', function()
// 													{
// 						const subelements = $('#claim-warrant-section .claim-warrant-remove-subelements').length;
// 						jQuery.ajax({
// 							type: "post",
// 							url: "<?php echo plugins_url()?>/my-custom-feedback/includes/fechting-multiple.php",
// 							data: {'element_type':'claim_warrant', 'claim_warrant_argument_no' : subelements},
// 							success: function (response) {
// 								console.log(response);
// 								$('.claim-warrant-argument').append(response);

// 							}
// 						});
// 					});


// 					jQuery('#add-warrant-comparison').on('click', function()
// 														 {
// 						const subelements = jQuery('#warrant-comparison-section .warrant-comparison-remove-subelements').length;
// 						jQuery.ajax({
// 							type: "post",
// 							url: "<?php echo plugins_url()?>/my-custom-feedback/includes/fechting-multiple.php",
// 							data: {'element_type':'warrant_comparison', 'warrant_comparison_argument_no' : subelements},
// 							success: function (response) {
// 								jQuery('.warrant-comparison-argument').append(response);
// 								// console.log(response);
// 							}
// 						});
// 					});


// 					jQuery('#add-consequentialist-argument').on('click', function()
// 																{
// 						const subelements = jQuery('#consequentialist-section .consequentialist-remove-subelements').length;
// 						jQuery.ajax({
// 							type: "post",
// 							url: "<?php echo plugins_url()?>/my-custom-feedback/includes/fechting-multiple.php",
// 							data: {'element_type':'weighing_argument', 'weighing_argument_argument_no' : subelements},
// 							success: function (response) {
// 								jQuery('.consequentialist-argument').append(response);
// 								// console.log(response);
// 							}
// 						});
// 					});
				</script>
			</div>
		</div>

		<div class="my-3 cmf-col-12">
			<input name="submit" type="submit" class="button-primary" value="Submit">
		</div>

	</div>
</form>