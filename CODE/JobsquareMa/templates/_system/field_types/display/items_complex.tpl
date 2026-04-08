{assign var="complexField" value=$id scope=global} {* nwy: Если не очистить переменную то в последующих полях начинаются проблемы (некоторые воспринимаются как комплексные)*}

{foreach from=$complexElements key="complexElementKey" item="complexElementItem"}
    <tr>
        <td>
            {display property='qty' complexParent=$complexField complexStep=$complexElementKey assign="qty"}
            {assign var="qty" value=$qty scope=parent}
            {display property='products' complexParent=$complexField complexStep=$complexElementKey template="items_list.tpl"}
        </td>
        <td class="text-right">
            {capture assign="complexAmount"}{display property='amount' complexParent=$complexField complexStep=$complexElementKey}{/capture}
            {currencyFormat amount=$complexAmount}
        </td>
    </tr>
{/foreach}
<tr class="invoice-amount-total text-right active">
    <td>[[Subtotal]]</td>
    <td>
        {capture assign="complexSubTotal"}{display property="sub_total"}{/capture}
        {currencyFormat amount=$complexSubTotal}
    </td>
</tr>
{if $include_tax}
    <tr class="invoice-amount-total text-right active">
        <td>[[Tax]]</td>
        <td>
            {capture assign="taxAmount"}{tr type="float"}{$tax.tax_amount}{/tr}{/capture}
            {currencyFormat amount=$taxAmount}
        </td>
    </tr>
{/if}
<tr class="invoice-amount-total text-right active">
    <td class="test">[[Total]]</td>
    <td>
        {capture assign="invoiceAmountTotal"}{display property="total"}{/capture}
        {currencyFormat amount=$invoiceAmountTotal}
    </td>
</tr>

{assign var="complexField" value=false scope=global} {* nwy: Если не очистить переменную то в последующих полях начинаются проблемы (некоторые воспринимаются как комплексные)*}