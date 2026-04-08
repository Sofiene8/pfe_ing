
 {if $GLOBALS.user_page_uri == '/recrutement/'}
{else}
<h1 class="title__primary title__primary-small title__centered static_content ">{$TITLE|escape}</h1>{/if}

 {if $GLOBALS.user_page_uri == '/recrutement/'}<div class="container recrutement_page pt-150 pb-150">{else}<div class="container container--small">{/if}
{if $staticContent}
 {if $GLOBALS.user_page_uri == '/recrutement/'} <div class=" content-text">{else} <div class="static-pages content-text">{/if}


        {$staticContent}
    </div>
{/if}

{javascript}
    <script>
        $(document).ready(function() {
            $('table').each(function() {
                $(this).wrap('<div class="table-responsive"/>')
            });
        });
    </script>
{/javascript}
