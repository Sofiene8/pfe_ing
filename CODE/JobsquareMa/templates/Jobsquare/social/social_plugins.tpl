{if $networks}
	<div class="social-registration">
		<span class="social-registration__buttons">
			{foreach from=$networks key='network_id' item='network'}
				<a href="{$GLOBALS.site_url}/login/?network={$network_id}{if $user_group_id}&amp;user_group_id={$user_group_id}{/if}" class="social-registration__{$network_id}" title="[[Sign in with {$network->getName()}]]">
					{if $network_id != 'linkedin'}
						[[Sign in with {$network->getName()}]]
                    {/if}
				</a>
            {/foreach}
		</span>
	</div>
{/if}
