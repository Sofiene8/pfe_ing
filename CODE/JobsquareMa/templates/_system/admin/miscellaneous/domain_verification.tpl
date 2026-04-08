{module name='flash_messages' function='display'}

{if $action == 'records'}
    [[Please create these DNS records for your domain. Once you're finished click verify.]]
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>[[Name]]</th>
                <th>[[Type]]</th>
                <th>[[Value]]</th>
            </tr>
            </thead>
            <tbody>
                {foreach item='record' from=$records}
                    <tr>
                        <td>{$record.name}</td>
                        <td style="vertical-align: top">{$record.type}</td>
                        <td>{$record.value}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
{/if}
