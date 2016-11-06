<script type="text/template" id="tab-label-preprocessor-template">
  <% if ( preprocessor.length && preprocessor != "none") { %>
  	(<%= preprocessor %>)
  <% } %>
</script>
<div class="wp-ace-bootstrap">
	<div>
	  <!-- Nav tabs -->
	  <ul id="wp-ace__tabs" class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="<?php if ($last_active_tab_id == 'html-edit' || $last_active_tab_id == 'html-compiled' ) { echo 'active'; } ?>  dropdown">
	    	<a href="#" aria-controls="html"  class="dropdown-toggle <?php if ($html_php_editor->get_code_compile_status() == 'error') { echo 'bg-danger wp-ace__error-tab'; } ?> " data-toggle="dropdown" >
	    		HTML
			    <span id="html-php-tab-label-preprocessor" class="text-muted" ></span>

			    <span class="caret"></span></a>
			    <ul class="dropdown-menu">
			      <li><a href="#html-edit" role="tab" id="" data-toggle="tab" class="<?php if ($last_active_tab_id == 'html-edit' ) { echo 'active'; } ?>" >Edit</a></li>
			      <li><a href="#html-compiled" role="tab" id="" data-toggle="tab" class="<?php if ($last_active_tab_id == 'html-compiled' ) { echo 'active'; } ?>"  >View Compiled</a></li>
			    </ul>
	    	</a>
	    </li>
	    <li role="presentation" class="<?php if ($last_active_tab_id == 'css-edit' || $last_active_tab_id == 'css-compiled' ) { echo 'active'; } ?> dropdown">
	    	<a href="#" aria-controls="css" class="dropdown-toggle <?php if ($css_editor->get_code_compile_status() == 'error') { echo 'bg-danger wp-ace__error-tab'; } ?>" data-toggle="dropdown" >
	    		CSS
	    		<span id="css-tab-label-preprocessor" class="text-muted" ></span>

			    <span class="caret"></span></a>
			    <ul class="dropdown-menu">
			      <li><a href="#css-edit" role="tab" id="" data-toggle="tab" class="<?php if ($last_active_tab_id == 'css-edit' ) { echo 'active'; } ?>" >Edit</a></li>
			      <li><a href="#css-compiled" role="tab" id="" data-toggle="tab" class="<?php if ($last_active_tab_id == 'css-compiled' ) { echo 'active'; } ?>"  >View Compiled</a></li>
			    </ul>
	    	</a>
	    </li>
	    <li role="presentation" class="<?php if ($last_active_tab_id == 'javascript-edit' || $last_active_tab_id == 'javascript-compiled' ) { echo 'active'; } ?> dropdown">
	    	<a href="#" aria-controls="javascript" class="dropdown-toggle <?php if ($js_editor->get_code_compile_status() == 'error') { echo 'bg-danger  wp-ace__error-tab'; } ?>" data-toggle="dropdown" >
	    		Javascript
	    		<span id="js-tab-label-preprocessor" class="text-muted" ></span>

			    <span class="caret"></span></a>
			    <ul class="dropdown-menu">
			      <li><a href="#javascript-edit" role="tab" id="" data-toggle="tab" class="<?php if ($last_active_tab_id == 'javascript-edit' ) { echo 'active'; } ?>"  >Edit</a></li>
			      <li><a href="#javascript-compiled"  role="tab" id="" data-toggle="tab" class="<?php if ($last_active_tab_id == 'javascript-compiled' ) { echo 'active'; } ?>"  >View Compiled</a></li>
			    </ul>
	    	</a>
	    </li>

	    <li id="wp-ace__settings-tab" role="" >
	    	<a href='#change-settings-modal' role="button" data-toggle="modal" data-backdrop="true" aria-expanded="false"  data-active-modal-tab="wp-ace-general-tab-link"  >
	    		<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings
	    	</a>
	    </li>
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content">
	    <div role="tabpanel" class="tab-pane <?php if ($last_active_tab_id == 'html-edit' ) { echo 'active'; } ?>" id="html-edit">
				<div class="wp-ace__tab-panel-inner" >

					<?php if ($html_php_editor->get_code_compile_status() == 'error') { ?>
					<p class="wp-ace__notice wp-ace__notice--info text-error" >
	    			<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
	    			<span class="wp-ace__notice__text" ><?php echo $html_php_editor->get_code_compile_error_msg() ?></span>
	    		</p>
					<?php } else { ?>
						<p class="wp-ace__notice wp-ace__notice--info text-error" >&nbsp;</p>
					<?php } ?>

					<div class="wp-ace-editor">
						<pre id="wp-ace-html-php-pre-code-editor" style="height:<?php echo $html_php_editor->get_editor_height(); ?>px" class="code-content" ><?php echo htmlentities($html_php_editor->get_pre_code()); ?></pre>
						
						<input type="hidden" id="wp-ace-html-php-pre-code" name="wp-ace-html-php-pre-code" value="<?php echo htmlentities($html_php_editor->get_pre_code()); ?>" >
						
						<input type="hidden" id="wp-ace-html-php-field-height" name="wp-ace-html-php-field-height" class="field-height" value="<?php echo $html_php_editor->get_editor_height(); ?>" >

					</div>

		    	<div class="clearfix" >
					  <div class="" >
					  	
					  	<p class="text-muted" ><span class="glyphicon glyphicon glyphicon glyphicon-cog" aria-hidden="true"></span><span id="wp-ace-html-php-status" ></span> <a href='#change-settings-modal' role="button" data-toggle="modal" data-backdrop="true" aria-expanded="false" data-active-modal-tab="wp-ace-html-tab-link" aria-controls="change-settings-modal">Change HTML Settings</a></p>
						 	
						 	<script type="text/template" id="tmpl-wp-ace-html-php-status-template">
							  <% if (preprocessor == 'none') { %>
							  	No HTML Preprocessor selected.
							  <% } else { %>
									Preprocessing with <strong><%= preprocessor %></strong>.
							  <% } %>
							  
							  Positioned <strong>
							  	<% if (output_position == 'before') { %>	
							  		before post content
							  	<% } else if (output_position == 'after') { %>
										after post content
							  	<% } %>
							  
							  </strong>.
							  wpautop <strong>
							  <% if (wpautop_status) { %>
							  	enabled
							  <% } else { %>
									disabled
							  <% } %>
								</strong>.
							  
							</script>

					  </div>

					</div>

				</div>


	    </div>
	    <div role="tabpanel" class="tab-pane <?php if ($last_active_tab_id == 'css-edit' ) { echo 'active'; } ?>" id="css-edit">
	    	<div class="wp-ace__tab-panel-inner" >

					<?php if ($css_editor->get_code_compile_status() == 'error') { ?>
					<p class="wp-ace__notice wp-ace__notice--info text-error" >
	    			<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
	    			<span class="wp-ace__notice__text" ><?php echo $css_editor->get_code_compile_error_msg() ?></span>
	    		</p>
					<?php } else { ?>
						<p class="wp-ace__notice wp-ace__notice--info text-error" >&nbsp;</p>
					<?php } ?>

					<div class="wp-ace-editor">
						<pre id="wp-ace-css-pre-code-editor" style="height:<?php echo $css_editor->get_editor_height(); ?>px" class="code-content" ><?php echo htmlentities($css_editor->get_pre_code()); ?></pre>
						
						<input type="hidden" id="wp-ace-css-pre-code" name="wp-ace-css-pre-code" value="<?php echo htmlentities($css_editor->get_pre_code()); ?>" >
						
						<input type="hidden" id="wp-ace-css-field-height" name="wp-ace-css-field-height" class="field-height" value="<?php echo $css_editor->get_editor_height(); ?>" >

					</div>

		    	<div class="clearfix" >
					  <div class="" >
						  
					  	<p class="text-muted" ><span class="glyphicon glyphicon glyphicon glyphicon-cog" aria-hidden="true"></span> <span id="wp-ace-css-status" ></span> <a href='#change-settings-modal' role="button" data-toggle="modal" data-backdrop="true" aria-expanded="false" aria-controls="change-settings-modal" data-active-modal-tab="wp-ace-css-tab-link"  >Change CSS Settings</a></p>
						 	<script type="text/template" id="tmpl-wp-ace-css-status-template">
							  <% if (preprocessor == 'none') { %>
							  	No CSS Preprocessor selected.
							  <% } else { %>
									Preprocessing with <strong><%= preprocessor %></strong>.
							  <% } %>
							  
							</script>
					  </div>

					</div>
				</div>
	    </div>
	    <div role="tabpanel" class="tab-pane <?php if ($last_active_tab_id == 'javascript-edit' ) { echo 'active'; } ?>" id="javascript-edit">
				<div class="wp-ace__tab-panel-inner" >	
					
					<?php if ($js_editor->get_code_compile_status() == 'error') { ?>
					<p class="wp-ace__notice wp-ace__notice--info text-error" >
	    			<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
	    			<span class="wp-ace__notice__text" ><?php echo $js_editor->get_code_compile_error_msg() ?></span>
	    		</p>
					<?php } else { ?>
						<p class="wp-ace__notice wp-ace__notice--info text-error" >&nbsp;</p>
					<?php } ?>

					<div class="wp-ace-editor">
						<pre id="wp-ace-js-pre-code-editor" style="height:<?php echo $js_editor->get_editor_height(); ?>px" class="code-content" ><?php echo htmlentities($js_editor->get_pre_code()); ?></pre>
						
						<input type="hidden" id="wp-ace-js-pre-code" name="wp-ace-js-pre-code" value="<?php echo htmlentities($js_editor->get_pre_code()); ?>" >
						
						<input type="hidden" id="wp-ace-js-field-height" name="wp-ace-js-field-height" class="field-height" value="<?php echo $js_editor->get_editor_height(); ?>" >

					</div>

		    	<div class="clearfix" >
					  <div class="" >
						  
						  <p class="text-muted" ><span class="glyphicon glyphicon glyphicon glyphicon-cog" aria-hidden="true"></span><span id="wp-ace-js-status" ></span>  <a href='#change-settings-modal' role="button" data-toggle="modal" data-backdrop="true" aria-expanded="false" aria-controls="change-settings-modal"  data-active-modal-tab="wp-ace-javascript-tab-link" >Change Javascript Settings</a></p>
						 	
						 	<script type="text/template" id="tmpl-wp-ace-js-status-template">
							  
							  <% if (preprocessor == 'none') { %>
							  	No JavaScript Preprocessor selected.
							  <% } else { %>
									Preprocessing with <strong><%= preprocessor %></strong>.
							  <% } %>
							  
							  <% if (jquery_enqueued_status) { %>
							  	jQuery <strong>enqueued</strong>.
							  <% } else { %>
									jQuery <strong>not enqueued</strong>. 
							  <% } %>

							</script>

					  </div>
					</div>

				</div>
	    </div>
	    <div role="tabpanel" class="tab-pane <?php if ($last_active_tab_id == 'html-compiled' ) { echo 'active'; } ?>" id="html-compiled">
	    		<h5>Compiled HTML <span class="text-muted" >(Read Only)</span></h5>
	    		<p class="wp-ace__notice wp-ace__notice--info text-warning" >
	    			<span class="fa fa-info-circle" aria-hidden="true"></span>
	    			<span class="wp-ace__notice__text" >Code has changed. Publish/Update post to view latest compiled code.</span>
	    		</p>
	    		<div class="wp-ace-editor">
						<pre id="wp-ace-html-compiled-code-display" class="wp-ace-compiled-code-display" style="height:400px" ><?php echo htmlentities($html_php_editor->get_compiled_code()); ?></pre>
						
					</div>
	    </div>
	    <div role="tabpanel" class="tab-pane <?php if ($last_active_tab_id == 'css-compiled' ) { echo 'active'; } ?>" id="css-compiled">
	    		<h5>Compiled CSS <span class="text-muted" >(Read Only)</span></h5>
	    		<p class="wp-ace__notice wp-ace__notice--info text-warning" >
	    			<span class="fa fa-info-circle" aria-hidden="true"></span>
	    			<span class="wp-ace__notice__text" >Code has changed. Publish/Update post to view latest compiled code.</span>
	    		</p>
	    		<div class="wp-ace-editor">
						<pre id="wp-ace-css-compiled-code-display" class="wp-ace-compiled-code-display" style="height:400px"  ><?php echo htmlentities($css_editor->get_compiled_code()); ?></pre>
						
					</div>	    	
	    </div>
	    <div role="tabpanel" class="tab-pane <?php if ($last_active_tab_id == 'javascript-compiled' ) { echo 'active'; } ?>" id="javascript-compiled">
	    		<h5>Compiled Javascript <span class="text-muted" >(Read Only)</span></h5>
	    		<p class="wp-ace__notice wp-ace__notice--info text-warning" >
	    			<span class="fa fa-info-circle" aria-hidden="true"></span>
	    			<span class="wp-ace__notice__text" >Code has changed. Publish/Update post to view latest compiled code.</span>
	    		</p>
	    		<div class="wp-ace-editor">
						<pre id="wp-ace-js-compiled-code-display" class="wp-ace-compiled-code-display" style="height:400px"  ><?php echo htmlentities($js_editor->get_compiled_code()); ?></pre>
						
					</div>	    	
	    </div>
	  </div>

	  <!-- Settings Modal -->
		<div class="modal fade" tabindex="-1" role="dialog" id="change-settings-modal" >
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">WP ACE Settings</h4>
		      </div>
		      <div class="modal-body">
  					
						<div>

						  <!-- Nav tabs -->
						  <ul class="nav nav-tabs" role="tablist">
						    <li role="presentation" class="active"><a href="#wp-ace-general" id="wp-ace-general-tab-link" aria-controls="wp-ace-general" role="tab" data-toggle="tab">General</a></li>
						    <li role="presentation"><a href="#wp-ace-html" id="wp-ace-html-tab-link"  aria-controls="wp-ace-html" role="tab" data-toggle="tab">HTML</a></li>
						    <li role="presentation"><a href="#wp-ace-css" id="wp-ace-css-tab-link"  aria-controls="wp-ace-css" role="tab" data-toggle="tab">CSS</a></li>
						    <li role="presentation"><a href="#wp-ace-javascript" id="wp-ace-javascript-tab-link"  aria-controls="wp-ace-javascript" role="tab" data-toggle="tab">Javascript</a></li>
						  </ul>

						  <!-- Tab panes -->
						  <div class="tab-content">
						    <div role="tabpanel" class="tab-pane active" id="wp-ace-general">

						    	<div class="form-group">
										<h5>Do not display WP ACE code on the following templates: </h5>
										<div class="checkbox">
											<label><input type="checkbox" name="wp-ace-disabled-templates[]" <?php if (in_array("front-page", $disabled_templates)) { echo 'checked'; } ?> value="front-page" >Front Page</label>
										</div>

										<div class="checkbox">
											<label ><input type="checkbox" name="wp-ace-disabled-templates[]" <?php if (in_array("home", $disabled_templates)) { echo 'checked'; }?> value="home" >Home</label>
										</div>
										
										<div class="checkbox">
											<label><input type="checkbox" name="wp-ace-disabled-templates[]" <?php if (in_array("archives", $disabled_templates)) { echo 'checked'; }?> value="archives" >Archives</label>	
										</div>
										
										<div class="checkbox">
											<label><input type="checkbox" name="wp-ace-disabled-templates[]" <?php if (in_array("search-results", $disabled_templates)) { echo 'checked'; }?> value="search-results" >Search Results</label>
										</div>
						    	</div>

						    	<div class="form-group">
										<h5>Only display WP ACE code when: </h5>
										<div class="checkbox">
											<label>
												<input type="checkbox" id="wp-ace-only-display-in-loop" name="wp-ace-only-display-in-loop" class="" value="1" <?php  checked($only_display_in_loop , '1') ?> >
												inside the loop
												<span class="glyphicon glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Inside the loop description https://codex.wordpress.org/Function_Reference/in_the_loop" aria-hidden="true"  ></span>									    	
											</label>	
										</div>
										
										<div class="checkbox">
											<label>
												<input type="checkbox"  id="wp-ace-only-display-in-main-query" name="wp-ace-only-display-in-main-query" class="" value="1" <?php  checked($only_display_in_main_query, '1') ?> >
												in main query
												<span class="glyphicon glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Inside main query description https://codex.wordpress.org/Function_Reference/is_main_query " aria-hidden="true"  ></span>									    	
											</label>	
										</div>
										<input type="hidden" name="wp-ace-last-active-tab" id="wp-ace-last-active-tab" value="<?php echo $last_active_tab_id; ?>" />									    	
									</div>
									
						    </div>
						    <div role="tabpanel" class="tab-pane" id="wp-ace-html">
	      					<div id="wp-ace-tab-content-html"></div>
	      					<script type="text/template" id="tmpl-wp-ace-html">
		      					<div>
											<h5>Automatic Paragraphs</h5>
											<div class="checkbox">
												<label>
													<input type="checkbox"  id="wp-ace-html-php-disable-wpautop" name="wp-ace-html-php-disable-wpautop" class="field-editor-disable-wpautop" value="1" <?php checked($html_php_editor->get_disable_wpautop_status(), '1'); ?> >
													Disable wpautop 
													<span class="glyphicon glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Automatically wraps in paragraph tag" aria-hidden="true"  ></span>									    	
												</label>	
											</div>
																							
											
											<h5>Position</h5>
											<div class="radio">
												<label class="radio"><input type="radio" name="wp-ace-html-php-code-position" value="before" <?php checked($html_php_editor->get_code_output_position(), 'before'); ?> >before post content </label>
											</div>
											<div class="radio">
												<label class="radio"><input type="radio" name="wp-ace-html-php-code-position" value="after" <?php checked($html_php_editor->get_code_output_position(), 'after'); ?> >after post content</label>
											</div>
											
											
											<h5>Pre Processor</h5>
											<div class="radio">
												<label class="radio"><input type="radio" <?php checked($html_php_editor->get_preprocessor(), 'none'); ?> value="none" name="wp-ace-html-php-preprocessor" >None</label>
											</div>
											
											<?php
												foreach($preprocessor_options['html'] as $preprocessor_slug => $preprocessor_name) {
													?>
														<div class="radio">
															<label class="radio"><input type="radio" <?php checked($html_php_editor->get_preprocessor(), $preprocessor_slug); ?> value="<?php echo $preprocessor_slug; ?>"  name="wp-ace-html-php-preprocessor" ><?php echo $preprocessor_name; ?></label>
														</div>
													<?php
												}

											?>					
										</div>	
	      					</script>

						    </div>
						    <div role="tabpanel" class="tab-pane" id="wp-ace-css">
									<div id="wp-ace-tab-content-css"></div>
									<script type="text/template" id="tmpl-wp-ace-css">
										<h5>Pre Processor</h5>
		
										<div class="radio">
											<label class="radio"><input type="radio" <?php checked($css_editor->get_preprocessor(), 'none'); ?> value="none" name="wp-ace-css-preprocessor" >None</label>
										</div>
										
										<?php
											foreach($preprocessor_options['css'] as $preprocessor_slug => $preprocessor_name) {
												?>
													<div class="radio">
														<label class="radio"><input type="radio" <?php checked($css_editor->get_preprocessor(), $preprocessor_slug); ?> value="<?php echo $preprocessor_slug; ?>" name="wp-ace-css-preprocessor" ><?php echo $preprocessor_name; ?></label>
													</div>
												<?php
											}

										?>	
									</script>
						    </div>
						    <div role="tabpanel" class="tab-pane" id="wp-ace-javascript">
									<div id="wp-ace-tab-content-js"></div>
									<script type="text/template" id="tmpl-wp-ace-js">
										<h5>Include Libraries</h5>
										<div class="checkbox">
											<label>
												<input type="checkbox"  id="wp-ace-css-include-jquery" name="wp-ace-css-include-jquery" value="1" <?php checked($js_editor->get_include_jquery_status(), '1'); ?> >
												Include jQuery
											</label>	
										</div>

										<h5>Pre Processor</h5>

										<div class="radio">
											<label class="radio"><input type="radio" <?php checked($js_editor->get_preprocessor(), 'none'); ?> value="none" name="wp-ace-js-preprocessor" >None</label>
										</div>
										
										<?php
											foreach($preprocessor_options['js'] as $preprocessor_slug => $preprocessor_name) {
												?>
													<div class="radio">
														<label class="radio"><input type="radio" <?php checked($js_editor->get_preprocessor(), $preprocessor_slug); ?> value="<?php echo $preprocessor_slug; ?>"  name="wp-ace-js-preprocessor" ><?php echo $preprocessor_name; ?></label>
													</div>
												<?php
											}

										?>	
									</script>

						    </div>
						  </div>

						</div>



		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
</div>