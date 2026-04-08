<div class="page-title">
	<h1 class="title">[[Dashboard]]</h1>
	<div class="stats page-title__buttons">
		<div class="btn-group">
			<button type="button" class="btn btn-default choose-period active" data-target="#today">
				[[Today]]
			</button>
			<button type="button" class="btn btn-default choose-period" data-target="#this-week" href="#">
				[[Last 7 days]]
			</button>
			<button type="button" class="btn btn-default choose-period" data-target="#this-month" href="#">
				[[Last 30 days]]
			</button>
			<button type="button" class="btn btn-default choose-period" data-target="#total" href="#">
				[[Total]]
			</button>
		</div>
	</div>
</div>

<div id="dashboard" class="dashboard">
	<div class="tab-contents" class="row">
		{foreach from=$applicationsInfo item=item key=i}
			<div id="{if $i == 'Today'}today{elseif $i=='Last 7 days'}this-week{elseif $i == 'Last 30 days'}this-month{elseif $i == 'Total'}total{/if}" class="tab-pane fade in {if $i == 'Today'}active{/if}">
				<div class="row">
				{if {$smarty.session.admin.sid} eq 1}
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="widget-panel widget-style-2 white-bg">
							<i class="fa fa-usd" aria-hidden="true"></i>
							<h2 class="m-0 counter">
								{capture assign="paymentAmount"}{tr type="float"}{$invoicesInfo[$i]}{/tr}{/capture}
								{currencyFormat amount=$paymentAmount}
							</h2>
							<div>[[Sales]]</div>
						</div>
					</div>
					
						{else}
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="widget-panel widget-style-2 white-bg">
							<i class="fa fa-usd" aria-hidden="true"></i>
							<h2 class="m-0 counter">
								0,00 DT
							</h2>
							<div>[[Sales]]</div>
						</div>
					</div>
					
						{/if}	
					
					
					
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="widget-panel widget-style-2 white-bg">
							<i class="fa fa-briefcase" aria-hidden="true"></i>
							<h2 class="m-0 counter">
								{$listingsInfo.Job.periods[$i]}
							</h2>
							<div>[[Jobs Posted]]</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="widget-panel widget-style-2 white-bg">
							<div class="icon-img">
								<img src="{image}employers-icon.svg" border="0" alt=""/>
							</div>
							<h2 class="m-0 counter">
								{$groupsInfo.Employer[$i]}
							</h2>
							<div>[[Employer Profiles Created]]</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="widget-panel widget-style-2 white-bg">
							<i class="fa fa-user" aria-hidden="true"></i>
							<h2 class="m-0 counter">
								[[{$groupsInfo['Job Seeker'][$i]}]]
							</h2>
							<div>[[Job Seeker Profiles Created]]</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="widget-panel widget-style-2 white-bg">
							<i class="fa fa-paper-plane-o" aria-hidden="true"></i>
							<h2 class="m-0 counter">
								{$applicationsInfo[$i]}
							</h2>
							<div>[[Applications Sent]]</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="widget-panel widget-style-2 white-bg">
							<i class="ion-ios7-email"></i>
							<h2 class="m-0 counter">
								{$jobAlertsInfo[$i]}
							</h2>
							<div>[[Job Alerts Created]]</div>
						</div>
					</div>
				</div>
			</div>
		{/foreach}
	</div>
</div>
{javascript}
	<script type="text/javascript">
		$(document).ready(function() {
			$('.choose-period').click(function(e) {
				e.preventDefault();
				$('.choose-period.active').removeClass('active');

				var target = $(this).data('target');
				$('.tab-pane.active').removeClass('active');
				$(this).addClass('active');
				$(target).addClass('active');
			});
		});
	</script>
{/javascript}