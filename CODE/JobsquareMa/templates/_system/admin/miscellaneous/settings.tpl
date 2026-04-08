<div class="page-title">
	<h1 class="title">[[System Settings]]</h1>
</div>
{foreach from=$errors item=error}
	<p class="error">[[{$error}]]</p>
{/foreach}
<form method="post" action="{$GLOBALS.site_url}/settings/" id="settingsPane" class="panel-body">
	<input type="hidden" id="action" name="action" value="apply_settings" />
	<input type="hidden" id="page" name="page" value="#generalTab"/>
	<div id="settingsPane">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#generalTab" data-toggle="tab" aria-expanded="true">[[General Settings]]</a>
			</li>
			<li>
				<a href="#jobboardTab" data-toggle="tab" aria-expanded="false">[[Job Board Settings]]</a>
			</li>
			<li>
				<a href="#ecommerceTab" data-toggle="tab" aria-expanded="false">
					[[Ecommerce Settings]]
				</a>
			</li>
			<li>
				<a href="#seoTab" data-toggle="tab" aria-expanded="false">
					[[SEO]]
				</a>
			</li>
			{if not $isSaas}
				<li>
					<a href="#mailTab" data-toggle="tab" aria-expanded="false">
						[[Mail]]
					</a>
				</li>
			{/if}
		</ul>
		<div class="tab-content">
			<div id="generalTab" class="tab-pane clearfix active">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-md-2 control-label">[[Site Name]]</label>
						<div class="col-md-7">
							<input type="text" name="site_title" value="{$settings.site_title}" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">[[Site Email]]</label>
						<div class="col-md-7 verify-domain">
							<input type="text" name="system_email" value="{$settings.system_email}" />
							{if $isSaas}
								{if $email_domain_verified}
									<div class="verify-domain--active">
										<span class="label label--active">[[Verified]]</span>
									</div>
								{else}
									<span data-toggle="tooltip" data-placement="auto left" title="[[By default all emails to your users will be sent from <strong>{$from_email}</strong>. This is done to eliminate your emails to be treated as spam.<br />
										To make all the emails to be sent from your own email address, you need to verify your email domain.<br/><br/><p><button type='button' class='btn btn--primary btn--verify-domain'>Verify Domain</button></p>]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
									<div class="modal fade" id="verify-domain-modal" role="dialog">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="verify-domain-modal-label">[[Verify Domain]]</h4>
												</div>
												<div class="modal-body">
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn--primary btn--verify-domain-2">[[Verify]]</button>
												</div>
											</div>
										</div>
									</div>
								{/if}
							{/if}
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">[[Custom Domain Name]]</label>
						<div class="col-md-7">
							<input type="text" name="domain" value="{$settings.domain}" autocomplete="off" />
							{if $isSaas}
								<span data-toggle="tooltip" data-placement="auto left" title='[[Please point your A-record to our IP address:]] <strong>{$ip}</strong>&nbsp;<a target="_blank" href="https://help.smartjobboard.com/knowledge_base/topics/connecting-a-custom-domain-name">[[Learn more]]</a>'><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							{/if}
						</div>
					</div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">[[Enable Maintenance Mode]] {if not $isSaas}<a href="{$GLOBALS.site_url}/edit-templates/?module_name=miscellaneous&template_name=maintenance_mode.tpl" target="_blank" title="[[Edit maintenance_mode.tpl]]" class="edit-email-template"></a>{/if}</label>
                        <div class="col-md-7">
							<input type="hidden" name="maintenance_mode" value="0" />
							<label class="cr-styled">
                                <input id="maintenance_mode_" name="maintenance_mode" type="checkbox" value="1"{if $settings.maintenance_mode} checked="checked"{/if} />
                                <i class="fa"></i>
                            </label>
                            <br/>
                            [[enter IP or IP range to access the site]]<br/>
                            <div class="half">
                                <input type="text" value="{$settings.maintenance_mode_ip}" name="maintenance_mode_ip"/>
                            </div>
                            <span style="top: 8px;" data-toggle="tooltip" title="[[Use * for replacing one or several digits use comma (,) to specify two or more IPs]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">[[Timezone]]</label>
                        <div class="col-md-7">
                            <select name="timezone">
                                {foreach from=$timezones item=timezone}
                                    <option value="{$timezone}" {if $settings.timezone == $timezone} selected="selected"{/if}>{$timezone}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">[[Date Format]]</label>
                        <div class="col-md-7">
                            <select name="date_format">
                                {foreach from=$date_formats item=date_format}
                                    <option value="{$date_format|escape}" {if $settings.date_format == $date_format} selected="selected"{/if}>{$smarty.now|date:$date_format@key|escape}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">[[Google Analytics ID]]</label>
                        <div class="col-md-7">
                            <div class="half">
                                <input type="text" name="google_TrackingID" value="{$settings.google_TrackingID}" />
                            </div>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-2 control-label"></label>
						<div class="col-md-7">
							<input type="submit" class="btn btn--primary btn__save" value="[[Save]]" />
						</div>
					</div>
				</div>
			</div>

			<div id="jobboardTab" class="tab-pane clearfix">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-md-2 control-label">[[Enable Public Resume Access]]</label>
						<div class="col-md-7">
							<input type="hidden" name="public_resume_access" value="0" />
							<label class="cr-styled">
								<input type="checkbox" name="public_resume_access" value="1"{if $settings.public_resume_access} checked="checked"{/if} />
								<i class="fa"></i>
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">[[Only registered job seekers can apply]]</label>
						<div class="col-md-7">
							<input type="hidden" name="loggedin_apply" value="0" />
							<label class="cr-styled">
								<input type="checkbox" name="loggedin_apply" value="1"{if $settings.loggedin_apply} checked="checked"{/if} />
								<i class="fa"></i>
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">[[Require Employer Approval]]</label>
						<div class="col-md-7">
							<input type="hidden" name="approve_employers" value="0" />
							<label class="cr-styled">
								<input type="checkbox" name="approve_employers" value="1"{if $settings.approve_employers} checked="checked"{/if} />
								<i class="fa"></i>
							</label>
							<span class="tooltip-checkbox" data-toggle="tooltip" data-placement="auto left" title="[[Checking this box will mean that employer accounts will not be active unless you have approved them in your admin panel.]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">[[Recruiting Pipeline]]</label>
						<div class="col-md-7">
							<input type="hidden" name="application_statuses" value="{$settings.application_statuses|escape}" />
							<div>
								<div class="application-statuses__items" style="display: inline-block">
                                    {foreach from=$recruiting_pipeline item='status'}
										<span class="label label--inactive">{$status.name|escape}</span>
                                    {/foreach}
								</div>
								<button type="button" class="btn btn--secondary edit-pipeline" data-toggle="modal" data-target="#pipeline-modal">[[Edit]]</button>
								<span style="display: inline-block; position: relative; top: 3px;" data-toggle="tooltip" data-placement="auto left" title="[[Recruiting Pipeline defines the stages employers use to organize and manage their candidates. You may add, remove, and change the order of stages using this field.]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
								<div class="modal fade" tabindex="-1" id="pipeline-modal" role="dialog">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title">[[Recruiting Pipeline]]</h4>
											</div>

											<div class="modal-body">
												<div class="table-responsive__list-editing">
													<table class="table table-striped table__fields-list">
														<tbody class="tbody--sort">
														{foreach from=$recruiting_pipeline item=item}
															<tr>
																<td class="sortable-handle">...</td>
																<td class="td-wide">
																	<input type="text" value="{$item|escape}" />
																</td>
																<td>
																	<i class="ion-close-circled"></i>
																</td>
															</tr>
														{/foreach}
														</tbody>
														<tbody>
														<tr>
															<td></td>
															<td>
																<div class="input-group">
																	<input name="list_item_value" class="textField list-item__input" />
																	<input name="list_visible" type="hidden" value="{if $smarty.request.list_visible}visible{/if}" />
																	<span class="input-group-btn">
																		<input type="button" value="[[Add]]" class="btn btn--secondary list-item__add" />
																	</span>
																</div>
															</td>
															<td></td>
														</tr>
														</tbody>
													</table>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn--primary" data-dismiss="modal">[[Close]]</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">[[Require Job Approval]]</label>
						<div class="col-md-7">
							<input type="hidden" name="approve_job" value="0" />
							<label class="cr-styled">
								<input type="checkbox" name="approve_job" value="1"{if $settings.approve_job} checked="checked"{/if} />
								<i class="fa"></i>
							</label>
							<span class="tooltip-checkbox" data-toggle="tooltip" data-placement="auto left" title="[[Enabling this will allow you to review and moderate jobs before they published on your job board.]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">[[Delete Expired Listings]]</label>
						<div class="col-md-7">
							<input type="hidden" name="automatically_delete_expired_listings" value="0" />
							<label class="cr-styled">
								<input type="checkbox" name="automatically_delete_expired_listings" value="1"{if $settings.automatically_delete_expired_listings} checked="checked"{/if} />
								<i class="fa"></i>
							</label>
							[[after]] <input type="text"  style="width:100px" name="period_delete_expired_listings" value="{$settings.period_delete_expired_listings|escape}"/> [[days]]
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">[[Search by location]]</label>
						<div class="col-md-7">
							<input type="hidden" name="search_by_location" value="0" />
							<label class="cr-styled">
								<input type="checkbox" name="search_by_location" value="1"{if $settings.search_by_location} checked="checked"{/if} />
								<i class="fa"></i>
							</label>
						</div>
					</div>
					<div class="form-group location__sub-setting">
						<label class="col-md-2 control-label">[[Display radius in]]</label>
						<div class="col-md-7">
							<select name="radius_search_unit">
								<option value="miles" {if $settings.radius_search_unit == 'miles'} selected="selected"{/if}>[[Miles]]</option>
								<option value="kilometers" {if $settings.radius_search_unit == 'kilometers'} selected="selected"{/if}>[[Kilometers]]</option>
							</select>
						</div>
					</div>
					<div class="form-group location__sub-setting">
						<label class="col-md-2 control-label">[[Limit location selection to]]</label>
						<div class="col-md-7">
							<select name="location_limit">
								<option value="" {if not $settings.location_limit}selected="selected"{/if}>[[Any Country]]</option>
								<option value="AD" {if $settings.location_limit == 'AD'}selected="selected"{/if}>Andorra</option>
								<option value="AE" {if $settings.location_limit == 'AE'}selected="selected"{/if}>United Arab Emirates</option>
								<option value="AF" {if $settings.location_limit == 'AF'}selected="selected"{/if}>Afghanistan</option>
								<option value="AG" {if $settings.location_limit == 'AG'}selected="selected"{/if}>Antigua and Barbuda</option>
								<option value="AI" {if $settings.location_limit == 'AI'}selected="selected"{/if}>Anguilla</option>
								<option value="AL" {if $settings.location_limit == 'AL'}selected="selected"{/if}>Albania</option>
								<option value="AM" {if $settings.location_limit == 'AM'}selected="selected"{/if}>Armenia</option>
								<option value="AO" {if $settings.location_limit == 'AO'}selected="selected"{/if}>Angola</option>
								<option value="AQ" {if $settings.location_limit == 'AQ'}selected="selected"{/if}>Antarctica</option>
								<option value="AR" {if $settings.location_limit == 'AR'}selected="selected"{/if}>Argentina</option>
								<option value="AS" {if $settings.location_limit == 'AS'}selected="selected"{/if}>American Samoa</option>
								<option value="AT" {if $settings.location_limit == 'AT'}selected="selected"{/if}>Austria</option>
								<option value="AU" {if $settings.location_limit == 'AU'}selected="selected"{/if}>Australia</option>
								<option value="AW" {if $settings.location_limit == 'AW'}selected="selected"{/if}>Aruba</option>
								<option value="AX" {if $settings.location_limit == 'AX'}selected="selected"{/if}>Åland Islands</option>
								<option value="AZ" {if $settings.location_limit == 'AZ'}selected="selected"{/if}>Azerbaijan</option>
								<option value="BA" {if $settings.location_limit == 'BA'}selected="selected"{/if}>Bosnia and Herzegovina</option>
								<option value="BB" {if $settings.location_limit == 'BB'}selected="selected"{/if}>Barbados</option>
								<option value="BD" {if $settings.location_limit == 'BD'}selected="selected"{/if}>Bangladesh</option>
								<option value="BE" {if $settings.location_limit == 'BE'}selected="selected"{/if}>Belgium</option>
								<option value="BF" {if $settings.location_limit == 'BF'}selected="selected"{/if}>Burkina Faso</option>
								<option value="BG" {if $settings.location_limit == 'BG'}selected="selected"{/if}>Bulgaria</option>
								<option value="BH" {if $settings.location_limit == 'BH'}selected="selected"{/if}>Bahrain</option>
								<option value="BI" {if $settings.location_limit == 'BI'}selected="selected"{/if}>Burundi</option>
								<option value="BJ" {if $settings.location_limit == 'BJ'}selected="selected"{/if}>Benin</option>
								<option value="BL" {if $settings.location_limit == 'BL'}selected="selected"{/if}>Saint Barthélemy</option>
								<option value="BM" {if $settings.location_limit == 'BM'}selected="selected"{/if}>Bermuda</option>
								<option value="BN" {if $settings.location_limit == 'BN'}selected="selected"{/if}>Brunei Darussalam</option>
								<option value="BO" {if $settings.location_limit == 'BO'}selected="selected"{/if}>Bolivia, Plurinational State of</option>
								<option value="BQ" {if $settings.location_limit == 'BQ'}selected="selected"{/if}>Bonaire, Sint Eustatius and Saba</option>
								<option value="BR" {if $settings.location_limit == 'BR'}selected="selected"{/if}>Brazil</option>
								<option value="BS" {if $settings.location_limit == 'BS'}selected="selected"{/if}>Bahamas</option>
								<option value="BT" {if $settings.location_limit == 'BT'}selected="selected"{/if}>Bhutan</option>
								<option value="BV" {if $settings.location_limit == 'BV'}selected="selected"{/if}>Bouvet Island</option>
								<option value="BW" {if $settings.location_limit == 'BW'}selected="selected"{/if}>Botswana</option>
								<option value="BY" {if $settings.location_limit == 'BY'}selected="selected"{/if}>Belarus</option>
								<option value="BZ" {if $settings.location_limit == 'BZ'}selected="selected"{/if}>Belize</option>
								<option value="CA" {if $settings.location_limit == 'CA'}selected="selected"{/if}>Canada</option>
								<option value="CC" {if $settings.location_limit == 'CC'}selected="selected"{/if}>Cocos (Keeling) Islands</option>
								<option value="CD" {if $settings.location_limit == 'CD'}selected="selected"{/if}>Congo, the Democratic Republic of the</option>
								<option value="CF" {if $settings.location_limit == 'CF'}selected="selected"{/if}>Central African Republic</option>
								<option value="CG" {if $settings.location_limit == 'CG'}selected="selected"{/if}>Congo</option>
								<option value="CH" {if $settings.location_limit == 'CH'}selected="selected"{/if}>Switzerland</option>
								<option value="CI" {if $settings.location_limit == 'CI'}selected="selected"{/if}>Côte d'Ivoire</option>
								<option value="CK" {if $settings.location_limit == 'CK'}selected="selected"{/if}>Cook Islands</option>
								<option value="CL" {if $settings.location_limit == 'CL'}selected="selected"{/if}>Chile</option>
								<option value="CM" {if $settings.location_limit == 'CM'}selected="selected"{/if}>Cameroon</option>
								<option value="CN" {if $settings.location_limit == 'CN'}selected="selected"{/if}>China</option>
								<option value="CO" {if $settings.location_limit == 'CO'}selected="selected"{/if}>Colombia</option>
								<option value="CR" {if $settings.location_limit == 'CR'}selected="selected"{/if}>Costa Rica</option>
								<option value="CU" {if $settings.location_limit == 'CU'}selected="selected"{/if}>Cuba</option>
								<option value="CV" {if $settings.location_limit == 'CV'}selected="selected"{/if}>Cabo Verde</option>
								<option value="CW" {if $settings.location_limit == 'CW'}selected="selected"{/if}>Curaçao</option>
								<option value="CX" {if $settings.location_limit == 'CX'}selected="selected"{/if}>Christmas Island</option>
								<option value="CY" {if $settings.location_limit == 'CY'}selected="selected"{/if}>Cyprus</option>
								<option value="CZ" {if $settings.location_limit == 'CZ'}selected="selected"{/if}>Czech Republic</option>
								<option value="DE" {if $settings.location_limit == 'DE'}selected="selected"{/if}>Germany</option>
								<option value="DJ" {if $settings.location_limit == 'DJ'}selected="selected"{/if}>Djibouti</option>
								<option value="DK" {if $settings.location_limit == 'DK'}selected="selected"{/if}>Denmark</option>
								<option value="DM" {if $settings.location_limit == 'DM'}selected="selected"{/if}>Dominica</option>
								<option value="DO" {if $settings.location_limit == 'DO'}selected="selected"{/if}>Dominican Republic</option>
								<option value="DZ" {if $settings.location_limit == 'DZ'}selected="selected"{/if}>Algeria</option>
								<option value="EC" {if $settings.location_limit == 'EC'}selected="selected"{/if}>Ecuador</option>
								<option value="EE" {if $settings.location_limit == 'EE'}selected="selected"{/if}>Estonia</option>
								<option value="EG" {if $settings.location_limit == 'EG'}selected="selected"{/if}>Egypt</option>
								<option value="EH" {if $settings.location_limit == 'EH'}selected="selected"{/if}>Western Sahara</option>
								<option value="ER" {if $settings.location_limit == 'ER'}selected="selected"{/if}>Eritrea</option>
								<option value="ES" {if $settings.location_limit == 'ES'}selected="selected"{/if}>Spain</option>
								<option value="ET" {if $settings.location_limit == 'ET'}selected="selected"{/if}>Ethiopia</option>
								<option value="FI" {if $settings.location_limit == 'FI'}selected="selected"{/if}>Finland</option>
								<option value="FJ" {if $settings.location_limit == 'FJ'}selected="selected"{/if}>Fiji</option>
								<option value="FK" {if $settings.location_limit == 'FK'}selected="selected"{/if}>Falkland Islands (Malvinas)</option>
								<option value="FM" {if $settings.location_limit == 'FM'}selected="selected"{/if}>Micronesia, Federated States of</option>
								<option value="FO" {if $settings.location_limit == 'FO'}selected="selected"{/if}>Faroe Islands</option>
								<option value="FR" {if $settings.location_limit == 'FR'}selected="selected"{/if}>France</option>
								<option value="GA" {if $settings.location_limit == 'GA'}selected="selected"{/if}>Gabon</option>
								<option value="GB" {if $settings.location_limit == 'GB'}selected="selected"{/if}>United Kingdom of Great Britain and Northern Ireland</option>
								<option value="GD" {if $settings.location_limit == 'GD'}selected="selected"{/if}>Grenada</option>
								<option value="GE" {if $settings.location_limit == 'GE'}selected="selected"{/if}>Georgia</option>
								<option value="GF" {if $settings.location_limit == 'GF'}selected="selected"{/if}>French Guiana</option>
								<option value="GG" {if $settings.location_limit == 'GG'}selected="selected"{/if}>Guernsey</option>
								<option value="GH" {if $settings.location_limit == 'GH'}selected="selected"{/if}>Ghana</option>
								<option value="GI" {if $settings.location_limit == 'GI'}selected="selected"{/if}>Gibraltar</option>
								<option value="GL" {if $settings.location_limit == 'GL'}selected="selected"{/if}>Greenland</option>
								<option value="GM" {if $settings.location_limit == 'GM'}selected="selected"{/if}>Gambia</option>
								<option value="GN" {if $settings.location_limit == 'GN'}selected="selected"{/if}>Guinea</option>
								<option value="GP" {if $settings.location_limit == 'GP'}selected="selected"{/if}>Guadeloupe</option>
								<option value="GQ" {if $settings.location_limit == 'GQ'}selected="selected"{/if}>Equatorial Guinea</option>
								<option value="GR" {if $settings.location_limit == 'GR'}selected="selected"{/if}>Greece</option>
								<option value="GS" {if $settings.location_limit == 'GS'}selected="selected"{/if}>South Georgia and the South Sandwich Islands</option>
								<option value="GT" {if $settings.location_limit == 'GT'}selected="selected"{/if}>Guatemala</option>
								<option value="GU" {if $settings.location_limit == 'GU'}selected="selected"{/if}>Guam</option>
								<option value="GW" {if $settings.location_limit == 'GW'}selected="selected"{/if}>Guinea-Bissau</option>
								<option value="GY" {if $settings.location_limit == 'GY'}selected="selected"{/if}>Guyana</option>
								<option value="HK" {if $settings.location_limit == 'HK'}selected="selected"{/if}>Hong Kong</option>
								<option value="HM" {if $settings.location_limit == 'HM'}selected="selected"{/if}>Heard Island and McDonald Islands</option>
								<option value="HN" {if $settings.location_limit == 'HN'}selected="selected"{/if}>Honduras</option>
								<option value="HR" {if $settings.location_limit == 'HR'}selected="selected"{/if}>Croatia</option>
								<option value="HT" {if $settings.location_limit == 'HT'}selected="selected"{/if}>Haiti</option>
								<option value="HU" {if $settings.location_limit == 'HU'}selected="selected"{/if}>Hungary</option>
								<option value="ID" {if $settings.location_limit == 'ID'}selected="selected"{/if}>Indonesia</option>
								<option value="IE" {if $settings.location_limit == 'IE'}selected="selected"{/if}>Ireland</option>
								<option value="IL" {if $settings.location_limit == 'IL'}selected="selected"{/if}>Israel</option>
								<option value="IM" {if $settings.location_limit == 'IM'}selected="selected"{/if}>Isle of Man</option>
								<option value="IN" {if $settings.location_limit == 'IN'}selected="selected"{/if}>India</option>
								<option value="IO" {if $settings.location_limit == 'IO'}selected="selected"{/if}>British Indian Ocean Territory</option>
								<option value="IQ" {if $settings.location_limit == 'IQ'}selected="selected"{/if}>Iraq</option>
								<option value="IR" {if $settings.location_limit == 'IR'}selected="selected"{/if}>Iran, Islamic Republic of</option>
								<option value="IS" {if $settings.location_limit == 'IS'}selected="selected"{/if}>Iceland</option>
								<option value="IT" {if $settings.location_limit == 'IT'}selected="selected"{/if}>Italy</option>
								<option value="JE" {if $settings.location_limit == 'JE'}selected="selected"{/if}>Jersey</option>
								<option value="JM" {if $settings.location_limit == 'JM'}selected="selected"{/if}>Jamaica</option>
								<option value="JO" {if $settings.location_limit == 'JO'}selected="selected"{/if}>Jordan</option>
								<option value="JP" {if $settings.location_limit == 'JP'}selected="selected"{/if}>Japan</option>
								<option value="KE" {if $settings.location_limit == 'KE'}selected="selected"{/if}>Kenya</option>
								<option value="KG" {if $settings.location_limit == 'KG'}selected="selected"{/if}>Kyrgyzstan</option>
								<option value="KH" {if $settings.location_limit == 'KH'}selected="selected"{/if}>Cambodia</option>
								<option value="KI" {if $settings.location_limit == 'KI'}selected="selected"{/if}>Kiribati</option>
								<option value="KM" {if $settings.location_limit == 'KM'}selected="selected"{/if}>Comoros</option>
								<option value="KN" {if $settings.location_limit == 'KN'}selected="selected"{/if}>Saint Kitts and Nevis</option>
								<option value="KP" {if $settings.location_limit == 'KP'}selected="selected"{/if}>Korea, Democratic People's Republic of</option>
								<option value="KR" {if $settings.location_limit == 'KR'}selected="selected"{/if}>Korea, Republic of</option>
								<option value="KW" {if $settings.location_limit == 'KW'}selected="selected"{/if}>Kuwait</option>
								<option value="KY" {if $settings.location_limit == 'KY'}selected="selected"{/if}>Cayman Islands</option>
								<option value="KZ" {if $settings.location_limit == 'KZ'}selected="selected"{/if}>Kazakhstan</option>
								<option value="LA" {if $settings.location_limit == 'LA'}selected="selected"{/if}>Lao People's Democratic Republic</option>
								<option value="LB" {if $settings.location_limit == 'LB'}selected="selected"{/if}>Lebanon</option>
								<option value="LC" {if $settings.location_limit == 'LC'}selected="selected"{/if}>Saint Lucia</option>
								<option value="LI" {if $settings.location_limit == 'LI'}selected="selected"{/if}>Liechtenstein</option>
								<option value="LK" {if $settings.location_limit == 'LK'}selected="selected"{/if}>Sri Lanka</option>
								<option value="LR" {if $settings.location_limit == 'LR'}selected="selected"{/if}>Liberia</option>
								<option value="LS" {if $settings.location_limit == 'LS'}selected="selected"{/if}>Lesotho</option>
								<option value="LT" {if $settings.location_limit == 'LT'}selected="selected"{/if}>Lithuania</option>
								<option value="LU" {if $settings.location_limit == 'LU'}selected="selected"{/if}>Luxembourg</option>
								<option value="LV" {if $settings.location_limit == 'LV'}selected="selected"{/if}>Latvia</option>
								<option value="LY" {if $settings.location_limit == 'LY'}selected="selected"{/if}>Libya</option>
								<option value="MA" {if $settings.location_limit == 'MA'}selected="selected"{/if}>Morocco</option>
								<option value="MC" {if $settings.location_limit == 'MC'}selected="selected"{/if}>Monaco</option>
								<option value="MD" {if $settings.location_limit == 'MD'}selected="selected"{/if}>Moldova, Republic of</option>
								<option value="ME" {if $settings.location_limit == 'ME'}selected="selected"{/if}>Montenegro</option>
								<option value="MF" {if $settings.location_limit == 'MF'}selected="selected"{/if}>Saint Martin (French part)</option>
								<option value="MG" {if $settings.location_limit == 'MG'}selected="selected"{/if}>Madagascar</option>
								<option value="MH" {if $settings.location_limit == 'MH'}selected="selected"{/if}>Marshall Islands</option>
								<option value="MK" {if $settings.location_limit == 'MK'}selected="selected"{/if}>Macedonia, the former Yugoslav Republic of</option>
								<option value="ML" {if $settings.location_limit == 'ML'}selected="selected"{/if}>Mali</option>
								<option value="MM" {if $settings.location_limit == 'MM'}selected="selected"{/if}>Myanmar</option>
								<option value="MN" {if $settings.location_limit == 'MN'}selected="selected"{/if}>Mongolia</option>
								<option value="MO" {if $settings.location_limit == 'MO'}selected="selected"{/if}>Macao</option>
								<option value="MP" {if $settings.location_limit == 'MP'}selected="selected"{/if}>Northern Mariana Islands</option>
								<option value="MQ" {if $settings.location_limit == 'MQ'}selected="selected"{/if}>Martinique</option>
								<option value="MR" {if $settings.location_limit == 'MR'}selected="selected"{/if}>Mauritania</option>
								<option value="MS" {if $settings.location_limit == 'MS'}selected="selected"{/if}>Montserrat</option>
								<option value="MT" {if $settings.location_limit == 'MT'}selected="selected"{/if}>Malta</option>
								<option value="MU" {if $settings.location_limit == 'MU'}selected="selected"{/if}>Mauritius</option>
								<option value="MV" {if $settings.location_limit == 'MV'}selected="selected"{/if}>Maldives</option>
								<option value="MW" {if $settings.location_limit == 'MW'}selected="selected"{/if}>Malawi</option>
								<option value="MX" {if $settings.location_limit == 'MX'}selected="selected"{/if}>Mexico</option>
								<option value="MY" {if $settings.location_limit == 'MY'}selected="selected"{/if}>Malaysia</option>
								<option value="MZ" {if $settings.location_limit == 'MZ'}selected="selected"{/if}>Mozambique</option>
								<option value="NA" {if $settings.location_limit == 'NA'}selected="selected"{/if}>Namibia</option>
								<option value="NC" {if $settings.location_limit == 'NC'}selected="selected"{/if}>New Caledonia</option>
								<option value="NE" {if $settings.location_limit == 'NE'}selected="selected"{/if}>Niger</option>
								<option value="NF" {if $settings.location_limit == 'NF'}selected="selected"{/if}>Norfolk Island</option>
								<option value="NG" {if $settings.location_limit == 'NG'}selected="selected"{/if}>Nigeria</option>
								<option value="NI" {if $settings.location_limit == 'NI'}selected="selected"{/if}>Nicaragua</option>
								<option value="NL" {if $settings.location_limit == 'NL'}selected="selected"{/if}>Netherlands</option>
								<option value="NO" {if $settings.location_limit == 'NO'}selected="selected"{/if}>Norway</option>
								<option value="NP" {if $settings.location_limit == 'NP'}selected="selected"{/if}>Nepal</option>
								<option value="NR" {if $settings.location_limit == 'NR'}selected="selected"{/if}>Nauru</option>
								<option value="NU" {if $settings.location_limit == 'NU'}selected="selected"{/if}>Niue</option>
								<option value="NZ" {if $settings.location_limit == 'NZ'}selected="selected"{/if}>New Zealand</option>
								<option value="OM" {if $settings.location_limit == 'OM'}selected="selected"{/if}>Oman</option>
								<option value="PA" {if $settings.location_limit == 'PA'}selected="selected"{/if}>Panama</option>
								<option value="PE" {if $settings.location_limit == 'PE'}selected="selected"{/if}>Peru</option>
								<option value="PF" {if $settings.location_limit == 'PF'}selected="selected"{/if}>French Polynesia</option>
								<option value="PG" {if $settings.location_limit == 'PG'}selected="selected"{/if}>Papua New Guinea</option>
								<option value="PH" {if $settings.location_limit == 'PH'}selected="selected"{/if}>Philippines</option>
								<option value="PK" {if $settings.location_limit == 'PK'}selected="selected"{/if}>Pakistan</option>
								<option value="PL" {if $settings.location_limit == 'PL'}selected="selected"{/if}>Poland</option>
								<option value="PM" {if $settings.location_limit == 'PM'}selected="selected"{/if}>Saint Pierre and Miquelon</option>
								<option value="PN" {if $settings.location_limit == 'PN'}selected="selected"{/if}>Pitcairn</option>
								<option value="PR" {if $settings.location_limit == 'PR'}selected="selected"{/if}>Puerto Rico</option>
								<option value="PS" {if $settings.location_limit == 'PS'}selected="selected"{/if}>Palestine, State of</option>
								<option value="PT" {if $settings.location_limit == 'PT'}selected="selected"{/if}>Portugal</option>
								<option value="PW" {if $settings.location_limit == 'PW'}selected="selected"{/if}>Palau</option>
								<option value="PY" {if $settings.location_limit == 'PY'}selected="selected"{/if}>Paraguay</option>
								<option value="QA" {if $settings.location_limit == 'QA'}selected="selected"{/if}>Qatar</option>
								<option value="RE" {if $settings.location_limit == 'RE'}selected="selected"{/if}>Réunion</option>
								<option value="RO" {if $settings.location_limit == 'RO'}selected="selected"{/if}>Romania</option>
								<option value="RS" {if $settings.location_limit == 'RS'}selected="selected"{/if}>Serbia</option>
								<option value="RU" {if $settings.location_limit == 'RU'}selected="selected"{/if}>Russian Federation</option>
								<option value="RW" {if $settings.location_limit == 'RW'}selected="selected"{/if}>Rwanda</option>
								<option value="SA" {if $settings.location_limit == 'SA'}selected="selected"{/if}>Saudi Arabia</option>
								<option value="SB" {if $settings.location_limit == 'SB'}selected="selected"{/if}>Solomon Islands</option>
								<option value="SC" {if $settings.location_limit == 'SC'}selected="selected"{/if}>Seychelles</option>
								<option value="SD" {if $settings.location_limit == 'SD'}selected="selected"{/if}>Sudan</option>
								<option value="SE" {if $settings.location_limit == 'SE'}selected="selected"{/if}>Sweden</option>
								<option value="SG" {if $settings.location_limit == 'SG'}selected="selected"{/if}>Singapore</option>
								<option value="SH" {if $settings.location_limit == 'SH'}selected="selected"{/if}>Saint Helena, Ascension and Tristan da Cunha</option>
								<option value="SI" {if $settings.location_limit == 'SI'}selected="selected"{/if}>Slovenia</option>
								<option value="SJ" {if $settings.location_limit == 'SJ'}selected="selected"{/if}>Svalbard and Jan Mayen</option>
								<option value="SK" {if $settings.location_limit == 'SK'}selected="selected"{/if}>Slovakia</option>
								<option value="SL" {if $settings.location_limit == 'SL'}selected="selected"{/if}>Sierra Leone</option>
								<option value="SM" {if $settings.location_limit == 'SM'}selected="selected"{/if}>San Marino</option>
								<option value="SN" {if $settings.location_limit == 'SN'}selected="selected"{/if}>Senegal</option>
								<option value="SO" {if $settings.location_limit == 'SO'}selected="selected"{/if}>Somalia</option>
								<option value="SR" {if $settings.location_limit == 'SR'}selected="selected"{/if}>Suriname</option>
								<option value="SS" {if $settings.location_limit == 'SS'}selected="selected"{/if}>South Sudan</option>
								<option value="ST" {if $settings.location_limit == 'ST'}selected="selected"{/if}>Sao Tome and Principe</option>
								<option value="SV" {if $settings.location_limit == 'SV'}selected="selected"{/if}>El Salvador</option>
								<option value="SX" {if $settings.location_limit == 'SX'}selected="selected"{/if}>Sint Maarten (Dutch part)</option>
								<option value="SY" {if $settings.location_limit == 'SY'}selected="selected"{/if}>Syrian Arab Republic</option>
								<option value="SZ" {if $settings.location_limit == 'SZ'}selected="selected"{/if}>Swaziland</option>
								<option value="TC" {if $settings.location_limit == 'TC'}selected="selected"{/if}>Turks and Caicos Islands</option>
								<option value="TD" {if $settings.location_limit == 'TD'}selected="selected"{/if}>Chad</option>
								<option value="TF" {if $settings.location_limit == 'TF'}selected="selected"{/if}>French Southern Territories</option>
								<option value="TG" {if $settings.location_limit == 'TG'}selected="selected"{/if}>Togo</option>
								<option value="TH" {if $settings.location_limit == 'TH'}selected="selected"{/if}>Thailand</option>
								<option value="TJ" {if $settings.location_limit == 'TJ'}selected="selected"{/if}>Tajikistan</option>
								<option value="TK" {if $settings.location_limit == 'TK'}selected="selected"{/if}>Tokelau</option>
								<option value="TL" {if $settings.location_limit == 'TL'}selected="selected"{/if}>Timor-Leste</option>
								<option value="TM" {if $settings.location_limit == 'TM'}selected="selected"{/if}>Turkmenistan</option>
								<option value="TN" {if $settings.location_limit == 'TN'}selected="selected"{/if}>Tunisia</option>
								<option value="TO" {if $settings.location_limit == 'TO'}selected="selected"{/if}>Tonga</option>
								<option value="TR" {if $settings.location_limit == 'TR'}selected="selected"{/if}>Turkey</option>
								<option value="TT" {if $settings.location_limit == 'TT'}selected="selected"{/if}>Trinidad and Tobago</option>
								<option value="TV" {if $settings.location_limit == 'TV'}selected="selected"{/if}>Tuvalu</option>
								<option value="TW" {if $settings.location_limit == 'TW'}selected="selected"{/if}>Taiwan, Province of China</option>
								<option value="TZ" {if $settings.location_limit == 'TZ'}selected="selected"{/if}>Tanzania, United Republic of</option>
								<option value="UA" {if $settings.location_limit == 'UA'}selected="selected"{/if}>Ukraine</option>
								<option value="UG" {if $settings.location_limit == 'UG'}selected="selected"{/if}>Uganda</option>
								<option value="UM" {if $settings.location_limit == 'UM'}selected="selected"{/if}>United States Minor Outlying Islands</option>
								<option value="US" {if $settings.location_limit == 'US'}selected="selected"{/if}>United States of America</option>
								<option value="UY" {if $settings.location_limit == 'UY'}selected="selected"{/if}>Uruguay</option>
								<option value="UZ" {if $settings.location_limit == 'UZ'}selected="selected"{/if}>Uzbekistan</option>
								<option value="VA" {if $settings.location_limit == 'VA'}selected="selected"{/if}>Holy See</option>
								<option value="VC" {if $settings.location_limit == 'VC'}selected="selected"{/if}>Saint Vincent and the Grenadines</option>
								<option value="VE" {if $settings.location_limit == 'VE'}selected="selected"{/if}>Venezuela, Bolivarian Republic of</option>
								<option value="VG" {if $settings.location_limit == 'VG'}selected="selected"{/if}>Virgin Islands, British</option>
								<option value="VI" {if $settings.location_limit == 'VI'}selected="selected"{/if}>Virgin Islands, U.S.</option>
								<option value="VN" {if $settings.location_limit == 'VN'}selected="selected"{/if}>Viet Nam</option>
								<option value="VU" {if $settings.location_limit == 'VU'}selected="selected"{/if}>Vanuatu</option>
								<option value="WF" {if $settings.location_limit == 'WF'}selected="selected"{/if}>Wallis and Futuna</option>
								<option value="WS" {if $settings.location_limit == 'WS'}selected="selected"{/if}>Samoa</option>
								<option value="YE" {if $settings.location_limit == 'YE'}selected="selected"{/if}>Yemen</option>
								<option value="YT" {if $settings.location_limit == 'YT'}selected="selected"{/if}>Mayotte</option>
								<option value="ZA" {if $settings.location_limit == 'ZA'}selected="selected"{/if}>South Africa</option>
								<option value="ZM" {if $settings.location_limit == 'ZM'}selected="selected"{/if}>Zambia</option>
								<option value="ZW" {if $settings.location_limit == 'ZW'}selected="selected"{/if}>Zimbabwe</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label"></label>
						<div class="col-md-7">
							<input type="submit" class="btn btn--primary btn__save" value="[[Save]]" />
						</div>
					</div>
				</div>
			</div>

			<div id="ecommerceTab" class="tab-pane clearfix">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-md-2 control-label">[[Currency]]</label>
						<div class="col-md-7">
							<select name="transaction_currency">
								{foreach from=$currencies key=code item=currency}
									<option value="{$code}" {if $settings.transaction_currency == $code}selected="selected"{/if}>{$code} - {$currency.caption}</option>
								{/foreach}
							</select>
							<span data-toggle="tooltip" data-placement="auto left" title="[[This currency will be used for displaying your site services prices]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">[[Tax]]</label>
						<div class="col-md-7">
							<div class="numerical-block">
								<div class="input-group">
									<input type="text" name="tax" value="{$settings.tax|escape}" />
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">[[Billing Address]]</label>
						<div class="col-md-7">
							<textarea name="send_payment_to" cols="50" rows="6">{$settings.send_payment_to}</textarea>
							<span data-toggle="tooltip" data-placement="auto left" title="[[This text will be displayed in invoices]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-7 col-md-offset-2">
							<input type="submit" class="btn btn--primary btn__save" value="[[Save]]"/>
						</div>
					</div>
				</div>
			</div>

			<div id="seoTab" class="tab-pane clearfix">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-md-2 control-label">[[Homepage Title]]</label>
						<div class="col-md-7">
							<input type="text" name="home_page_title" value="{$settings.home_page_title|escape}" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2 control-label">[[Meta Description]]</label>
						<div class="col-md-7">
							<textarea name="home_page_description" cols="50" rows="6">{$settings.home_page_description|escape}</textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2 control-label">[[Meta Keywords]]</label>
						<div class="col-md-7">
							<input type="text" name="home_page_keywords" value="{$settings.home_page_keywords|escape}" />
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-7 col-md-offset-2">
							<input type="submit" class="btn btn--primary btn__save" value="[[Save]]"/>
						</div>
					</div>
				</div>

			</div>

			{if not $isSaas}
				<div id="mailTab" class="tab-pane clearfix">
					<div class="form-horizontal">
						<div class="form-group">
							<div class="col-md-7 col-md-offset-2">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="smtp" value="1" {if $settings.smtp == 1}checked="checked"{/if} />
									<i class="fa"></i>
									[[SMTP]]
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">[[SMTP Sender Mail]]</label>
							<div class="col-md-7"><input type="text" name="smtp_sender" value="{$settings.smtp_sender}" /></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">[[SMTP Port]]</label>
							<div class="col-md-7">
								<div class="numerical-block">
									<input type="text" name="smtp_port" value="{$settings.smtp_port}" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">[[SMTP Host]]</label>
							<div class="col-md-7">
								<div class="numerical-block">
									<input type="text" name="smtp_host" value="{$settings.smtp_host}" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">[[SMTP Security]]</label>
							<div class="col-md-7">
								<div class="radio-inline">
									<label class="cr-styled cr-styled__radio">
										<input type="radio" name="smtp_security" value="none" {if $settings.smtp_security != 'ssl' && $settings.smtp_security != 'tls'}checked="checked"{/if} />
										<i class="fa"></i>
										[[None]]
									</label>
								</div>
								<div class="radio-inline">
									<label class="cr-styled cr-styled__radio">
										<input type="radio" name="smtp_security" value="ssl" {if $settings.smtp_security == 'ssl'}checked="checked"{/if} />
										<i class="fa"></i>
										[[SSL]]
									</label>
								</div>
								<div class="radio-inline">
									<label class="cr-styled cr-styled__radio">
										<input type="radio" name="smtp_security" value="tls" {if $settings.smtp_security == 'tls'}checked="checked"{/if} />
										<i class="fa"></i>
										[[TLS]]
									</label>
								</div>
								<span data-toggle="tooltip" data-placement="auto left" title="[[Look for your SMTP mail host requirements]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">[[Username]]</label>
							<div class="col-md-7"><input type="text" name="smtp_username" value="{$settings.smtp_username}" /></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">[[Password]]</label>
							<div class="col-md-7"><input type="password" name="smtp_password" value="{$settings.smtp_password}" /></div>
						</div>
						<div class="form-group">
							<div class="col-md-7 col-md-offset-2">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="smtp" value="0"  {if $settings.smtp == 0}checked="checked"{/if} />
									<i class="fa"></i>
									[[Sendmail]]
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">[[Path to sendmail]]</label>
							<div class="col-md-7"><input type="text" name="sendmail_path" value="{$settings.sendmail_path}" /></div>
						</div>
						<div class="form-group">
							<div class="col-md-7 col-md-offset-2">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="smtp" value="3"  {if $settings.smtp == 3}checked="checked"{/if} />
									<i class="fa"></i>
									[[PHP Mail Function]]
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">[[Check mail set up]]</label>
							<div class="col-md-7"><input id="checkMail" type="submit" value="[[Check]]" class="btn btn--secondary"/></div>
						</div>
						<div class="form-group">
							<div class="col-md-7 col-md-offset-2">
								<input type="submit" class="btn btn--primary btn__save" value="[[Save]]"/>
							</div>
						</div>
					</div>
				</div>
			{/if}
		</div>
	</div>
</form>
{javascript}
	<script type="text/javascript">
		$(document).ready(function() {
			checkUncheckIPBlock();

			$("#maintenance_mode_").click(function() {
				checkUncheckIPBlock();
			});

			$('.btn__save').on('click', function() {
				$('#page').val('#' + $(this).parents('.tab-pane').attr('id'));
			});

			$("#checkMail").click(function () {

				var preloader = $(this).after(getPreloaderCodeForFieldId("checkMailLoader"));
				$("#checkMail").prop('disabled', true);

				$.ajax({
					type: "POST",
					url: window.SJB_GlobalSiteUrl + "/system/miscellaneous/mail_check/",
					data: $("#settingsPane").serialize(),
					complete: function() {
						$("#checkMail").prop('disabled', false);
					},
					success:function (html) {
						$(preloader).next("span").remove();
						var result = JSON.parse(html);
						$(".message").remove();
						$(".error").remove();
						if (result["status"] == true) {
							$("#settingsPane").before('<p class="' + result["type"] + '">[[Your mail is set up correctly and functions fine.]]</p>');
						}
						if (result["status"] == false) {
							$("#settingsPane").before('<p class="' + result["type"] + '">[[Your mail is not functioning. Please check Admin Panel and server settings.]]</p>');
						}
						if (result["status"] == "fieldError") {
							var fieldCaption = {
								"smtp_host" : "[[SMTP Host]]",
								"smtp_port" : "[[SMTP Port]]",
								"smtp_sender" : "[[SMTP Sender Mail]]",
								"smtp_username" : "[[Username]]",
								"smtp_password" : "[[Password]]",
								"sendmail_path" : "[[Path to sendmail]]",
								"system_email" : "[[System email]]"
							};
							var messages = result["message"];
							$.each(messages, function(key) {
								if (key == "EMPTY_VALUE") {
									$.each(messages[key], function(key, value) {
										$("#settingsPane").before('<p class="' + result["type"] + '">"' + fieldCaption[value] + '" [[field is empty.]]</p>');
									});
								}

								if (key == "NOT_VALID") {
									$.each(messages[key], function(key, value) {
										$("#settingsPane").before('<p class="' + result["type"] + '">"' + fieldCaption[value] + '" [[field is not valid.]]</p>');
									});
								}
							});
						}
						$(window).scrollTop(0);
					}
				});
				return false;
			});

			$('[name="search_by_location"]').change(function() {
				$('.location__sub-setting').toggle($('[name="search_by_location"]:checked').length > 0);
			}).change();

			$(document).on('click', '.btn--verify-domain', function() {
				$('.tooltip.in').tooltip('hide');
				var modal = $('#verify-domain-modal');
				modal.find('.modal-body')
						.addClass('loading')
						.empty();
				modal.modal('show');
				$.get(
					SJB_AdminSiteUrl + '/system/miscellaneous/domain_verification/',
					{
						email: $('[name="system_email"]').val()
					},
					function(data) {
						modal.find('.modal-body')
								.html(data)
								.removeClass('loading');
					}
				);
			});
			$('.btn--verify-domain-2').click(function() {
				$.get(
						SJB_AdminSiteUrl + '/system/miscellaneous/domain_verification/',
						{
							email: $('[name="system_email"]').val(),
							action: 'verify',
						},
						function(data) {
							$('.error, .message').remove();
							$('#verify-domain-modal').modal('hide');
							$(data).insertAfter('.page-title');
							if ($(data).hasClass('message')) {
								$('.verify-domain .label').removeClass('.label--pending').addClass('label--active').text('Verified');
								$('.btn--verify-domain').remove();
							}
						}
				);
			});

			function updateRecruitingPipeline() {
                var pipeline = [];
                var countLabels = 0;
                var labels = $('.application-statuses__items').empty().removeClass('empty');
                $('.tbody--sort input').each(function() {
                    countLabels++;
                    pipeline.push({
						'id': $(this).data('id'),
						'name': $(this).val()
					});
                    labels.append('<span class="label label--inactive">' + $(this).val() + '</span> ');
                }).promise().done(function(){
                    if (countLabels == '0') {
                        $('.application-statuses__items').addClass('empty')
                    }
                });
                $('input[name="application_statuses"]').val(JSON.stringify(pipeline));
            }

            $('.tbody--sort input').change(function() {
                updateRecruitingPipeline();
            });

            $('.tbody--sort').sortable({
                helper: function(e, ui) {
                    ui.children().each(function() {
                        $(this).width($(this).width());
                    });
                    return ui;
                },
                handle: '.sortable-handle',
				stop: function() {
                    updateRecruitingPipeline();
                }
            });
            $(document).on('click', '.ion-close-circled', function() {
                var row = $(this).closest('tr');
                row.hide();
                row.find('input').val('');
                updateRecruitingPipeline();
            });

            var addNewItem = function() {
                var input = $('.list-item__input');
                if (input.val()) {
                    var row = $('<tr><td class="sortable-handle">...</td><td><input type="text" value="" /></td><td><i class="ion-close-circled"></i></td></tr>');
                    row.find('input[type="text"]').val(input.val());
                    row.appendTo('.tbody--sort');
                    input.val('');
                    updateRecruitingPipeline();
                }
            };
            $('.list-item__add').on('click', addNewItem);
            $('.list-item__input').on('keypress', function(e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    addNewItem();
                }
            });
		});

		function checkUncheckIPBlock() {
			$("input[name='maintenance_mode_ip']").prop("disabled", !$("#maintenance_mode_").prop("checked"));
		}

		var page = '{$page}';

		if (page) {
			$('.nav-tabs').find('li.active a').attr('aria-expanded', 'false');
			$('.nav-tabs').find('li.active').removeClass('active');
			$('.nav-tabs a[href="' + page + '"]').attr('aria-expanded', 'true');
			$('.nav-tabs a[href="' + page + '"]').closest('li').addClass('active');
			$('.tab-content .tab-pane.active').removeClass('active');
			$('.tab-content ' + page).addClass('active');
		}
	</script>
{/javascript}

