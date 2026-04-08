<div class="profile__info">
    <div class="profile__info__description content-text">{$userInfo.CompanyDescription}</div>
</div>

{javascript}
    <script>
        $(document).on('ready', function() {
            $('#myTabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
        });
    </script>
{/javascript}