<input type="text" name="{$id}[like]" {if $url == "/manage-users/employer/" || $url == "/manage-users/jobseeker/"}placeholder="{if $id == 'CompanyName'}[[Company Name]]{elseif $id == 'username'}[[Email]]{/if}"{/if}
        {if $url == "/guest-alerts/"}placeholder="[[Email]]"{/if}
        {if $url == "/manage-invoices/"}{if $id== 'username'}{/if}placeholder="[[Email]]"{/if}
        value="{if is_array($value)}{if $value.like}{$value.like}{elseif $value.equal}{$value.equal}{/if}{else}{$value}{/if}" />