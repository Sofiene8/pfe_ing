{literal}
<style>
.contact_page {
    background: #fff !important;
}
.contact_page .page-row-expanded {
    background: #f5f5f5;
    padding-top: 40px;
    padding-bottom: 40px;
}
.contact_page .static-pages {
    max-width: 700px;
    margin: 0 auto;
    padding: 0 15px;
}
</style>
{/literal}
 {if $message_sent == false}
	{foreach key="key" item="value" from=$field_errors}
		{if $key == 'EMAIL'}
    <div class="alert alert-danger">[[Please enter valid email address]]</div>
{elseif $key == 'NAME'}
<div class="alert alert-danger">[[Please provide your full name.]]</div>
{elseif $key == 'COMMENTS'}
<div class="alert alert-danger">[[Please include your comments.]]</div>
{/if}
	{/foreach}
<div class="row static-pages content-text">
  <div class="col-md-8 col-md-offset-2">
    <h1 class="text-center">Contactez-nous</h1>
    <p class="introcontact text-center">
      Que vous soyez à la recherche d’un emploi ou de nouveaux talents,
      remplissez le formulaire pour en savoir plus sur nos solutions
    </p>
    <div class="formcontact">
      <form method="post" action="" onSubmit="disableSubmitButton('submit-contact');" class="form col-xs-12 col-lg-11 col-md-11 col-sm-11">
        <div class="form-group form-group margin">
          <h2> Besoin d’aide ou d’informations ? </h2>
          <p>Remplissez le formulaire et notre équipe vous répondra rapidement.</p>
        </div>
        <input type="hidden" name="action" value="send_message" />
        <div class="form-group form-group margin">
          <input type="text" class="form-control" name="name" value="{$name|escape}" placeholder="[[Full Name]]" />
        </div>
        <div class="form-group form-group margin ">
          <input placeholder="[[Email]]:" type="text" name="email" class="form-control" value="{if $GLOBALS.current_user.logged_in}{$email|default:$GLOBALS.current_user.username|escape}{else}{$email|escape}{/if}" />
        </div>
        <div class="form-group">
          <textarea placeholder="[[Comments]]:" cols="20" rows="5" class="form-control" name="comments">{$comments|escape}</textarea>
        </div>
        <div class="form-group form-group__btns text-center">
          <input class="btn btn__bold btn__orange" type="submit" value="[[Submit]]" id="submit-contact"/>
        </div>
      </form>
      <div class="clear"></div>
    </div>
  </div>
</div>
{else}
<div class="row static-pages content-text">
  <div class="alert alert-success" role="alert">[[Thank you very much for your message. We will respond to you as soon as possible.]]</div>
</div>
{/if} 